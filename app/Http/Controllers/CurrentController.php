<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CurrentController extends Controller
{
    public function index()
    {
        $currents = DB::table('t_produit')
            ->join('t_entreestock', 't_produit.IDt_ProduitPK', '=', 't_entreestock.IDt_ProduitFK')
            ->join('t_sortiestock', 't_produit.IDt_ProduitPK', '=', 't_sortiestock.IDt_ProduitFK')
            ->select('t_produit.IDt_ProduitPK', 't_produit.LibProd', 't_produit.PrixHT', 't_produit.QtteStock', 't_entreestock.Qtte as qte_entree', 't_sortiestock.Qtte as qte_sortie')
            ->where('t_produit.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_produit.effacer', '=', 0)
            ->get();
        return view('admin.stock.current', compact('currents'));
    }
}
