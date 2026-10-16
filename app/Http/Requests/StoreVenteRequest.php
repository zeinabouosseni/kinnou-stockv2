<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVenteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */


    public function rules(): array
    {
        return [
            'boutique_id'            => ['required', 'exists:boutiques,id'],
            'vendeur_id'             => ['nullable', 'string'],
            'vendeur_nom'            => ['nullable', 'string'],
            'articles'               => ['required', 'array', 'min:1'],
            'articles.*.produit_id'  => ['required', 'exists:produits,id'],
            'articles.*.quantite'    => ['required', 'integer', 'min:1'],
            'articles.*.prix_unitaire' => ['required', 'numeric', 'min:0'],
        ];
    }
}
