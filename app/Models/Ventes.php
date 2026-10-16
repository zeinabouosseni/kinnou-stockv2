<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventes extends Model
{
    protected $fillable = ['boutique_id', 'vendeur_id', 'total', 'vendeur_nom'];

    public function articles()
    {
        return $this->hasMany(VenteArticles::class, 'vente_id');
    }
    public function vendeur()
    {
        return $this->belongsTo(Employers::class, 'vendeur_id');
    }
    //
}
