<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class Employers extends Model
{

    use HasFactory, HasApiTokens;

    protected $fillable = ['boutique_id', 'nom', 'telephone', 'code', 'pin', 'actif'];
    protected $casts = ['actif' => 'boolean'];
    protected $hidden = ['pin'];

    public function permission(): HasOne
    {
        return $this->hasOne(Permissions::class, 'employe_id');
    }
    //
}
