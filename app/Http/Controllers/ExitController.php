<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExitController extends Controller
{
    public function index()
    {
        $exits = DB::table('t_sortiestock')
            ->join('t_produit', 't_sortiestock.IDt_ProduitFK', '=', 't_produit.IDt_ProduitPK')
            ->select('t_sortiestock.DateSortie', 't_sortiestock.LibProd', 't_sortiestock.Qtte', 't_sortiestock.MontantTotal', 't_sortiestock.Observation', 't_produit.RefProd')
            ->where('t_sortiestock.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_sortiestock.effacer', '=', 0)
            ->orderByDesc('t_sortiestock.DateSortie')
            ->get();
        return view('admin.stock.exits', compact('exits'));
    }
}
