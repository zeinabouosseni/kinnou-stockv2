<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Depenses extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'boutique_id',
        'motif',
        'montant',
        'date_depense',
    ];

    protected $casts = [
        'montant' => 'float',
        'date_depense' => 'date',
    ];

    public function boutique(): BelongsTo
    {
        return $this->belongsTo(Boutiques::class);
    }
}
