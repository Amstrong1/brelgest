<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = DB::table('t_fournisseur')
            ->select('NomFrns', 'Adresse', 'CodePostal', 'Ville', 'Pays', 'Tel_1', 'Email', 'Observation', 'NumIFU')
            ->where('t_fournisseur.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_fournisseur.effacer', '=', 0)
            ->orderBy('NomFrns', 'asc')
            ->get();
        return view('admin.edition.provider', compact('providers'));
    }
}
