<?php

namespace App\Http\Controllers;

use App\Models\Depenses;
use App\Models\Produits;
use App\Models\Ventes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StatistiqueController extends Controller
{
    public function index(Request $request)
    {
        try {
            Log::info('========== DEBUT API STATISTIQUES ==========');

            // Paramètres reçus
            $boutiqueId = $request->query('boutique_id');
            $periode = $request->query('periode', '30J');

            Log::info('Paramètres reçus', [
                'boutique_id' => $boutiqueId,
                'periode' => $periode,
            ]);

            // Définition de la date de début
            $dateDebut = match ($periode) {
                '7J' => Carbon::now()->subDays(7),
                '30J' => Carbon::now()->subDays(30),
                '3M' => Carbon::now()->subMonths(3),
                'Année' => Carbon::now()->subYear(),
                default => Carbon::now()->subDays(30),
            };

            Log::info('Date de début calculée', [
                'date_debut' => $dateDebut->toDateTimeString(),
                'date_actuelle' => Carbon::now()->toDateTimeString(),
            ]);

            // 1. Chiffre d'affaires & nombre de ventes
            $ventesQuery = Ventes::where('boutique_id', $boutiqueId)
                ->where('created_at', '>=', $dateDebut);

            $ca = (float) $ventesQuery->sum('total');
            $nbVentes = (int) $ventesQuery->count();

            Log::info('Statistiques ventes', [
                'ca' => $ca,
                'nb_ventes' => $nbVentes,
            ]);

            // 2. Dépenses
            $totalDepenses = (float) Depenses::where('boutique_id', $boutiqueId)
                ->where('date_depense', '>=', $dateDebut)
                ->sum('montant');

            Log::info('Dépenses', [
                'total_depenses' => $totalDepenses,
            ]);

            // 3. Bénéfice net
            $beneficeNet = $ca - $totalDepenses;

            Log::info('Bénéfice net', [
                'benefice_net' => $beneficeNet,
            ]);

            // 4. Produits
            $nbProduits = (int) Produits::where('boutique_id', $boutiqueId)
                ->count();

            $stockFaible = (int) Produits::where('boutique_id', $boutiqueId)
                ->whereRaw('quantite <= seuil_alerte')
                ->count();

            Log::info('Statistiques produits', [
                'nb_produits' => $nbProduits,
                'stock_faible' => $stockFaible,
            ]);

            // 5. Top 5 produits
            $top5 = DB::table('vente_articles')
                ->join(
                    'ventes',
                    'vente_articles.vente_id',
                    '=',
                    'ventes.id'
                )
                ->join(
                    'produits',
                    'vente_articles.produit_id',
                    '=',
                    'produits.id'
                )
                ->where('ventes.boutique_id', $boutiqueId)
                ->where('ventes.created_at', '>=', $dateDebut)
                ->select(
                    'produits.nom',
                    DB::raw('SUM(vente_articles.quantite) as qte'),
                    DB::raw('SUM(vente_articles.sous_total) as ca')
                )
                ->groupBy('produits.id', 'produits.nom')
                ->orderByDesc('ca')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'nom' => (string) $item->nom,
                        'qte' => (int) $item->qte,
                        'ca' => (float) $item->ca,
                    ];
                })
                ->values()
                ->toArray();

            Log::info('Top 5 produits', [
                'top5' => $top5,
            ]);

            // Réponse finale
            $response = [
                'ca' => $ca,
                'totalDepenses' => $totalDepenses,
                'beneficeNet' => $beneficeNet,
                'nbVentes' => $nbVentes,
                'nbProduits' => $nbProduits,
                'stockFaible' => $stockFaible,
                'panierMoyen' => $nbVentes > 0
                    ? $ca / $nbVentes
                    : 0.0,
                'top5' => $top5,
            ];

            // Log EXACT de ce qui sera envoyé à Flutter
            Log::info('========== REPONSE ENVOYEE A FLUTTER ==========');
            Log::info('Response', [
                'response' => $response,
            ]);
            Log::info('================================================');
            return response()->json([
                'success' => true,
                'message' => 'Statistiques récupérées avec succès',
                'data' => $response,
            ], 200);
        } catch (\Throwable $e) {

            Log::error('========== ERREUR API STATISTIQUES ==========');

            Log::error('Message', [
                'message' => $e->getMessage(),
            ]);

            Log::error('Fichier', [
                'file' => $e->getFile(),
            ]);

            Log::error('Ligne', [
                'line' => $e->getLine(),
            ]);

            Log::error('Trace', [
                'trace' => $e->getTraceAsString(),
            ]);

            Log::error('==============================================');

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des statistiques.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
