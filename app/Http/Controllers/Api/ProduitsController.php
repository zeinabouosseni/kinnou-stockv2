<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Boutiques;
use App\Models\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProduitsController extends Controller
{
    //
    public function rules(): array
    {
        return [
            'boutique_id'   => ['required', 'exists:boutiques,id'],
            'categorie_id'  => ['required', 'exists:categories,id'],
            'nom'           => ['required', 'string', 'max:255'],
            'prix_achat'    => ['required', 'numeric', 'min:0'],
            'prix_vente'    => ['required', 'numeric', 'min:0'],
            'quantite'      => ['nullable', 'integer', 'min:0'],
            'seuil_alerte'  => ['nullable', 'integer', 'min:0'],
            'unite'         => ['required', 'string', 'max:50'],
            'description'   => ['nullable', 'string'],
            'photo'         => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function storeProduits(Request $request)
    {
        try {
            // Validation des données reçues
            $validatedData = $request->validate($this->rules());

            // Enregistrement de la photo
            $photoPath = $request->hasFile('photo')
                ? $request->file('photo')->store('produits', 'public')
                : null;

            // Création du produit
            $produit = Produits::create([
                ...$validatedData,
                'photo' => $photoPath,
            ]);

            // Log de succès
            Log::info('Produit créé avec succès.', [
                'produit_id' => $produit->id,
                'data' => $validatedData,
            ]);
            $produit = $produit->load('categorie');
            return response()->json([
                'status' => 'success',
                'message' => 'Produit créé avec succès.',
                'data' => [
                    'produit' => $produit,
                ],
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {

            // Log des erreurs de validation
            Log::warning('Erreur de validation lors de la création du produit.', [
                'errors' => $e->errors(),
                'request' => $request->except(['photo']),
            ]);

            throw $e;
        } catch (\Exception $e) {

            // Log de l'erreur générale
            Log::error('Erreur lors de la création du produit.', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->except(['photo']),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la création du produit.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function index(Boutiques $boutique, Request $request)
    {
        try {
            Log::info('Etatt du categorie', [
                'categorieId' => $request->categorieId
            ]);

            $categorieId = $request->categorieId;

            if ($categorieId === 'null' || $categorieId === '') {
                $categorieId = null;
            }

            Log::info('Etat du categorie', [
                'categorieId' => $categorieId,
            ]);

            $produits = Produits::with('categorie')
                ->where('boutique_id', $request->boutiqueId)
                ->when($categorieId !== null, function ($query) use ($categorieId) {
                    $query->where('categorie_id', $categorieId);
                })
                ->latest()
                ->get();

            Log::info('Produits récupérés avec succès.', [
                'boutiqueId' => $request->boutiqueId,
                'categorieId' => $categorieId,
                'nombre_produits' => $produits->count(),
            ]);

            Log::info('Produits récupérés avec succès.', [
                'boutiqueId' => $request->boutiqueId,
                'nombre_produits' => $produits->count(),

            ]);

            return ApiResponse::success(
                'Produits récupérés.',
                $produits
            );
        } catch (\Exception $e) {

            Log::error('Erreur lors de la récupération des produits.', [
                'boutique_id' => $request->boutiqueId ?? null,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Impossible de récupérer les produits.',
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            if (!$request->produitId) {
                //
                return response()->json([
                    'status' => 'error',
                    'message' => 'Impossible de modifier le produit.',
                ], 500);
            }
            $data = $request->validate([
                'nom' => ['required', 'string', 'max:255'],
                'prix_achat' => ['required', 'numeric', 'min:0'],
                'prix_vente' => ['required', 'numeric', 'min:0'],
                'quantite' => ['required', 'integer', 'min:0'],
                'seuil_alerte' => ['required', 'integer', 'min:0'],
                'categorie_id' => ['required', 'integer', 'exists:categories,id'],
                'unite' => ['required', 'string', 'max:100'],
                'description' => ['nullable', 'string'],
                'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            ]);

            $produit = Produits::findOrFail($request->produitId);

            /* Log::info('Data', [
                'photo' => $data['photo']
            ]); */

            // Gestion de la nouvelle photo
            if ($request->hasFile('photo')) {

                // Supprimer l'ancienne photo
                if ($produit->photo) {
                    Storage::disk('public')->delete($produit->photo);
                }

                // Enregistrer la nouvelle photo
                $data['photo'] = $request->file('photo')
                    ->store('produits', 'public');
            }

            // Mise à jour du produit
            $produit->update($data);

            // Recharger la catégorie
            $produit->load('categorie');

            Log::info('Produit modifié avec succès.', [
                'produit_id' => $produit->id,
                'data' => $data,
            ]);

            return ApiResponse::success(
                'Produit modifié avec succès.',
                ['produit' => $produit]
            );
        } catch (\Illuminate\Validation\ValidationException $e) {

            Log::warning('Erreur de validation lors de la modification du produit.', [
                'mesage' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            throw $e;
        } catch (\Exception $e) {

            Log::error('Erreur lors de la modification du produit.', [
                'produit_id' => $produit->id ?? null,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Impossible de modifier le produit.',
            ], 500);
        }
    }
    public function destroy(Produits $produit)
    {
        if ($produit->photo) {
            Storage::disk('public')->delete($produit->photo);
        }
        $produit->delete();
        return ApiResponse::success('Produit supprimé avec succès.');
    }

    public function entreeStock(Request $request)
    {
        try {
            //code...
            $data = $request->validate([
                'quantite' => ['required', 'integer', 'min:1'],
            ]);
            $produit = Produits::findOrFail($request->produitId);
            $produit->increment('quantite', $data['quantite']);
            $produit->load('categorie');

            Log::info('Stock mis à jour avec succès.', [
                'produit' => $produit,
                'quantite_ajoutee' => $data['quantite'],
                'nouvelle_quantite' => $produit->quantite,
            ]);
            return ApiResponse::success('Stock mis à jour.', ['produit' => $produit]);
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Erreur lors de la mise à jour du stock.', [
                'produit_id' => $request->produitId ?? null,
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
            ]);
            return  ApiResponse::error('Une erreur est survenue! Veuilez réssayer', 401);
        }
    }
}
