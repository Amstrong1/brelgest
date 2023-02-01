<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    public function index()
    {
        $entries = DB::table('t_entréestock')
            ->join('t_produit', 't_entréestock.IDt_ProduitFK', '=', 't_produit.IDt_ProduitPK')
            ->select('t_entréestock.DateEntree', 't_entréestock.LibProd', 't_entréestock.Qtte', 't_entréestock.PrixVenteUnit', 't_entréestock.Pri_AchatTotal', 't_entréestock.Observation', 't_produit.RefCodeBar')
            ->where('t_entréestock.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_produit.effacer', '=', 0)
            ->where('t_entréestock.effacer', '=', 0)
            ->orderByDesc('t_entréestock.DateEntree')
            ->get();
        return view('admin.stock.entries', compact('entries'));
    }
}
