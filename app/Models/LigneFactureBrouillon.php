<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneFactureBrouillon extends Model
{
    use HasFactory;

    protected $table = 't_lignefact_brouillon';

    protected $fillable = [
        'id_fact_brouillon',
        'AjouterPar',
        'product',
        'Qtte',
        'TypeTaxe',
    ];
}
