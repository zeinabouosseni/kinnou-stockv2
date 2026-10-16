<?php

namespace App\Http\Controllers;

use App\Models\Depenses;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    //

    public function index(Request $request)
    {
        $request->validate([
            'boutique_id' => 'required|exists:boutiques,id',
        ]);

        $depenses = Depenses::where('boutique_id', $request->boutique_id)
            ->orderBy('date_depense', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $depenses,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'boutique_id' => 'required|exists:boutiques,id',
            'motif' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'categorie' => 'required|string|max:100',
            'date_depense' => 'nullable|date',
        ]);

        if (empty($validated['date_depense'])) {
            $validated['date_depense'] = now()->toDateString();
        }

        $depense = Depenses::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Dépense enregistrée avec succès',
            'data' => $depense,
        ], 201);
    }
}
