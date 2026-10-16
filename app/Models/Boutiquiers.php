<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['nom', 'prenom', 'email', 'telephone', 'ville', 'code_pin', 'status'])]
class Boutiquiers extends Model
{
    use HasApiTokens;

    public function boutiques()
    {
        return $this->hasMany(Boutiques::class, 'boutiquier_id');
    }

    public function employes(): HasManyThrough
    {
        return $this->hasManyThrough(
            Employers::class,
            Boutiques::class,
            'boutiquier_id',
            'boutique_id',
            'id',
            'id'
        );
    }
}
