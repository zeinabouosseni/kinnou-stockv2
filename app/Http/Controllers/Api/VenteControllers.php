<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVenteRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Produits;
use App\Models\Ventes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VenteControllers extends Controller
{
    //
    public function store(StoreVenteRequest $request)
    {
        $data = $request->validated();

        try {
            $vente = DB::transaction(function () use ($data) {
                $total = 0;

                foreach ($data['articles'] as $item) {
                    $produit = Produits::lockForUpdate()->findOrFail($item['produit_id']);
                    if ($produit->quantite < $item['quantite']) {
                        throw new \RuntimeException("Stock insuffisant pour \"{$produit->nom}\".");
                    }
                    $total += $item['quantite'] * $item['prix_unitaire'];
                }

                $vente = Ventes::create([
                    'boutique_id'   => $data['boutique_id'],
                    'vendeur_id'    => $data['vendeur_id'] ?? null,
                    'vendeur_nom'   => $data['vendeur_nom'] ?? null,
                    'total'         => $total,
                ]);

                foreach ($data['articles'] as $item) {
                    $produit = Produits::findOrFail($item['produit_id']);

                    $vente->articles()->create([
                        'produit_id'    => $produit->id,
                        'produit_nom'   => $produit->nom,
                        'quantite'      => $item['quantite'],
                        'prix_unitaire' => $item['prix_unitaire'],
                        'sous_total'    => $item['quantite'] * $item['prix_unitaire'],
                    ]);

                    $produit->decrement('quantite', $item['quantite']);
                }

                return $vente->load('articles');
            });

            return ApiResponse::success('Vente enregistrée avec succès.', ['vente' => $vente], 201);
        } catch (\RuntimeException $e) {
            return ApiResponse::error($e->getMessage(), 422);
        }
    }



    public function index(Request $request)
    {
        try {
            Log::info('========== DEBUT API VENTES ==========');

            $boutiqueId = $request->query('boutique_id');

            Log::info('Boutique ID reçu', ['boutique_id' => $boutiqueId]);

            // Construction de la requête de base
            $query = Ventes::with('articles')
                ->when($boutiqueId, fn($q) => $q->where('boutique_id', $boutiqueId));

            $ventesCollection = (clone $query)
                ->orderBy('created_at', 'desc')
                ->get();

            // Convertir en tableau pur PHP immédiatement
            $ventesArray = $ventesCollection->values()->toArray();

            // Log propre sans la classe Collection
            Log::info('Ventes récupérées', [
                'nombre' => count($ventesArray),
                'ventes' => $ventesArray,
            ]);

            $now = Carbon::now();

            $stats = [
                'jour' => [
                    'total_ventes' => (clone $query)->whereDate('created_at', $now->toDateString())->count(),
                    'montant' => (clone $query)->whereDate('created_at', $now->toDateString())->sum('total'),
                ],
                'semaine' => [
                    'total_ventes' => (clone $query)->whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count(),
                    'montant' => (clone $query)->whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->sum('total'),
                ],
                'mois' => [
                    'total_ventes' => (clone $query)->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count(),
                    'montant' => (clone $query)->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->sum('total'),
                ],
                'annee' => [
                    'total_ventes' => (clone $query)->whereYear('created_at', $now->year)->count(),
                    'montant' => (clone $query)->whereYear('created_at', $now->year)->sum('total'),
                ],
            ];

            $response = [
                'success' => true,
                'kpis' => $stats,
                'data' => $ventesArray,
            ];

            Log::info('Réponse envoyée à Flutter', ['response' => $response]);
            Log::info('========== FIN API VENTES ==========');

            return response()->json($response, 200);
        } catch (\Throwable $e) {
            Log::error('========== ERREUR API VENTES ==========');
            Log::error('Message : ' . $e->getMessage());
            Log::error('Fichier : ' . $e->getFile() . ' à la ligne ' . $e->getLine());
            Log::error('======================================');

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des ventes.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function ventesRecentes(Request $request)
    {
        try {
            $boutiqueId = $request->query('boutique_id');
            $limit = $request->query('limit', 10); // Par défaut 10 ventes récentes

            $ventes = Ventes::with('articles')
                ->when($boutiqueId, fn($q) => $q->where('boutique_id', $boutiqueId))
                ->orderBy('created_at', 'desc')
                ->take($limit)
                ->get();

            Log::info("retour", [
                'success' => 'success',
                'data'    => $ventes->values()->toArray(),
            ]);

            return response()->json([
                'success' => 'success',
                'data'    => $ventes->values()->toArray(),
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des ventes récentes.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
