<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class MainController extends Controller
{
    public function getCategories()
    {
        $categories = Categories::where('status', 'active')->get(['id', 'name',]);

        //Log::info('Données')
        return response()->json([
            'status' => 'success',
            'message' => 'Catégories récupérées avec succès.',
            'data' => [
                'categories' => $categories,
            ],
        ], 200);
    }

    public function updateLogo(Request $request)
    {
        try {
            $request->validate([
                'logo'        => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
                'boutique_id' => 'nullable|integer',
            ]);

            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Non authentifié.',
                ], 401);
            }


            $boutique = $request->filled('boutique_id')
                ? $user->boutiques()->where('boutiques.id', $request->boutique_id)->first()
                : ($user->boutiqueActive ?? $user->boutiques()->first());

            Log::info('updateLogo', [
                'user_id'     => $user->id,
                'boutique_id' => $request->boutique_id,
                'trouvee'     => (bool) $boutique,
            ]);

            if (!$boutique) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Aucune boutique associée trouvée.',
                ], 404);
            }

            // Supprimer l'ancien logo
            if ($boutique->logo && Storage::disk('public')->exists($boutique->logo)) {
                Storage::disk('public')->delete($boutique->logo);
            }

            $path = $request->file('logo')->store('logos', 'public');

            $boutique->logo = $path;
            $boutique->save();

            return response()->json([
                'status'  => 'success',
                'message' => 'Logo mis à jour avec succès.',
                'data'    => $boutique->fresh(),
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Données invalides.',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Throwable $th) {
            Log::error('Erreur lors de la mise à jour du logo: ' . $th->getMessage());

            return response()->json([
                'status'  => 'error',
                'message' => 'Erreur serveur.',
            ], 500);
        }
    }
    //

}
