<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'boutique_id',
    'categorie_id',
    'nom',
    'prix_achat',
    'prix_vente',
    'quantite',
    'seuil_alerte',
    'unite',
    'description',
    'photo',
])]
class Produits extends Model
{
    protected $casts = [
        'prix_achat' => 'decimal:2',
        'prix_vente' => 'decimal:2',
        'quantite' => 'integer',
        'seuil_alerte' => 'integer',
    ];

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }

    public function boutique()
    {
        return $this->belongsTo(Boutiques::class, 'boutique_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categories::class, 'categorie_id');
    }
}
