<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenteArticles extends Model
{
    protected $fillable = ['vente_id', 'produit_id', 'produit_nom', 'quantite', 'prix_unitaire', 'sous_total'];

    //
    public function vente()
    {
        return $this->belongsTo(Ventes::class, 'vente_id');
    }
    public function produit()
    {
        return $this->belongsTo(Produits::class, 'produit_id');
    }
}
