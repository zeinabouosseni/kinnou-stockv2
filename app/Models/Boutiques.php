<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nom', 'quartier', 'logo', 'status', 'boutiquier_id'])]
class Boutiques extends Model
{
    //

    public function boutiquier()
    {
        return $this->belongsTo(Boutiquiers::class, 'boutiquier_id');
    }

    public function employes(): HasMany
    {
        return $this->hasMany(Employers::class, 'boutique_id');
    }
}
