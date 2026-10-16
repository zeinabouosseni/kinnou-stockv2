<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employers;
use App\Models\Permissions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EmployeController extends Controller
{

    //
    public function index($boutiqueId)
    {
        try {
            // 1. Récupération des employés avec leur relation "permission"
            $employes = Employers::with('permission')
                ->where('boutique_id', $boutiqueId)
                ->get();

            // 2. Retour de la réponse en cas de succès (HTTP 200)
            return response()->json([
                'status' => 'success',
                'message' => 'Liste des employés récupérée avec succès',
                'data' => $employes,
            ], 200);
        } catch (Exception $e) {
            // 3. Journalisation de l'erreur dans storage/logs/laravel.log
            Log::error('Erreur lors de la récupération des employés :', [
                'boutique_id' => $boutiqueId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // 4. Retour d'une réponse d'erreur propre pour le client/Flutter (HTTP 500)
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors du chargement des employés.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'boutique_id' => 'required|exists:boutiques,id',
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string',
            'pin' => 'required|string|size:4',
        ]);

        return DB::transaction(function () use ($validated) {
            $code = 'EMP-' . strtoupper(Str::random(6));

            $employe = Employers::create([
                'boutique_id' => $validated['boutique_id'],
                'nom' => $validated['nom'],
                'telephone' => $validated['telephone'] ?? null,
                'code' => $code,
                'pin' => Hash::make($validated['pin']),
                'actif' => true,
            ]);

            Permissions::create(['employe_id' => $employe->id]);

            return response()->json([
                'employe' => $employe->load('permission'),
                'code' => $code,
            ], 201);
        });
    }

    public function toggleActif($id)
    {
        $employe = Employers::findOrFail($id);
        $employe->update(['actif' => !$employe->actif]);

        return response()->json($employe);
    }

    public function updatePermissions(Request $request, $id)
    {
        $validated = $request->validate([
            'enregistrer_ventes' => 'required|boolean',
            'voir_stock' => 'required|boolean',
            'gerer_depenses' => 'required|boolean',
        ]);

        $permission = Permissions::updateOrCreate(
            ['employe_id' => $id],
            $validated
        );

        return response()->json($permission);
    }
}
