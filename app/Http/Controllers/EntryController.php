<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    public function index()
    {
        $entries = DB::table('t_entreestock')
            ->join('t_produit', 't_entreestock.IDt_ProduitFK', '=', 't_produit.IDt_ProduitPK')
            ->select('t_entreestock.DateEntree', 't_entreestock.LibProd', 't_entreestock.Qtte', 't_entreestock.PrixVenteUnit', 't_entreestock.Pri_AchatTotal', 't_entreestock.Observation', 't_produit.RefCodeBar')
            ->where('t_entreestock.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_produit.effacer', '=', 0)
            ->where('t_entreestock.effacer', '=', 0)
            ->orderByDesc('t_entreestock.DateEntree')
            ->get();
        return view('admin.stock.entries', compact('entries'));
    }
}
