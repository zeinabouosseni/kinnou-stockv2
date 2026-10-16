<?php

namespace App\Http\Controllers;

use App\Models\Employers;
use App\Models\Produits;
use App\Models\Ventes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    //

    public function index(Request $request)
    {
        $boutiqueId = $request->query('boutique_id');

        if (!$boutiqueId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Le paramètre boutique_id est obligatoire.'
            ], 400);
        }

        // 1. KPIs du jour
        $aujourdhui = now()->startOfDay();

        $revenuJour = Ventes::where('boutique_id', $boutiqueId)
            ->where('created_at', '>=', $aujourdhui)
            ->sum('total');

        $nbVentesJour = Ventes::where('boutique_id', $boutiqueId)
            ->where('created_at', '>=', $aujourdhui)
            ->count();

        $nbProduitsEnStock = Produits::where('boutique_id', $boutiqueId)
            ->count();

        $nbEmployesActifs = Employers::where('boutique_id', $boutiqueId)
            ->where('actif', true) // Ajustez le champ/statut selon votre modèle
            ->count();

        // 2. Alertes de stock (Rupture ou Stock faible <= 5)
        $alertes = Produits::where('boutique_id', $boutiqueId)
            ->where('quantite', '<=', 'seuil_alerte')
            ->select('nom as produitNom', 'quantite')
            ->get()
            ->map(function ($produit) {
                return [
                    'produitNom' => $produit->produitNom,
                    'quantite' => (int) $produit->quantite,
                    'type' => $produit->quantite <= 0 ? 'rupture' : 'stockFaible',
                ];
            });


        // 3. Activités récentes (Dernières ventes)
        $activites = Ventes::with(['vendeur', 'articles.produit'])
            ->where('boutique_id', $boutiqueId)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($vente) {
                // Titre composé des noms des produits vendus
                $titre = $vente->articles
                    ->pluck('produit.nom')
                    ->filter()
                    ->take(2)
                    ->join(', ');

                return [
                    'id' => $vente->id,
                    'titre' => $titre ?: 'Vente',
                    'heure' => $vente->created_at->format('H:i'),
                    'vendeurNom' => $vente->vendeur ? $vente->vendeur->nom : null,
                    'montant' => '+' . number_format($vente->montant_total, 0, ',', ' ') . ' FCFA',
                ];
            });
        Log::info('Alertes de stock récupérées pour la boutique ID: '
            . $boutiqueId . ' - Nombre d\'alertes: ' . $alertes->count(), [
            'alertes' => $alertes->toArray(),
            'activites' => $activites->toArray(),
            'revenuJour' => $revenuJour,
            'nbVentesJour' => $nbVentesJour,
            'nbProduitsEnStock' => $nbProduitsEnStock,
            'nbEmployesActifs' => $nbEmployesActifs
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Données du dashboard récupérées avec succès',
            'data' => [
                'revenuJour' => (float) $revenuJour,
                'nbVentesJour' => (int) $nbVentesJour,
                'nbProduitsEnStock' => (int) $nbProduitsEnStock,
                'nbEmployesActifs' => (int) $nbEmployesActifs,
                'alertes' => $alertes,
                'activites' => $activites,
            ]
        ], 200);
    }
}
