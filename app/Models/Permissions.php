<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{

    protected $fillable = ['employe_id', 'enregistrer_ventes', 'voir_stock', 'gerer_depenses'];
    protected $casts = [
        'enregistrer_ventes' => 'boolean',
        'voir_stock' => 'boolean',
        'gerer_depenses' => 'boolean',
    ];
    //
}
