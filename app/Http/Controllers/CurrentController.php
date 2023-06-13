<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CurrentController extends Controller
{
    public function index()
    {

        $entry_qty = DB::table('t_entreestock')
            ->select('t_entreestock.IDt_ProduitFK', DB::raw('SUM(t_entreestock.Qtte) as qte_entree'))
            ->where('t_entreestock.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_entreestock.Effacer', '=', 0)
            ->groupBy('t_entreestock.IDt_ProduitFK');

        $exit_qty = DB::table('t_sortiestock')
            ->select('t_sortiestock.IDt_ProduitFK', DB::raw('SUM(t_sortiestock.Qtte) as qte_sortie'))
            ->where('t_sortiestock.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_sortiestock.Effacer', '=', 0)
            ->groupBy('t_sortiestock.IDt_ProduitFK');

        $sold_qty = DB::table('t_lignefact')
            ->join('t_facture', 't_lignefact.IDt_FactureFK', '=', 't_facture.IDt_FacturePK')
            ->select('t_lignefact.IDt_ProduitFK', DB::raw('SUM(t_lignefact.Qtte) as qte_vendu'))
            ->where('t_lignefact.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_lignefact.Effacer', '=', 0)
            ->where('t_facture.Effacer', '=', 0)
            ->where('t_facture.NatureFacture', '=', 'FT')
            ->groupBy('t_lignefact.IDt_ProduitFK');

        $currents = DB::table('t_produit')
            ->leftJoinSub($entry_qty, 'entries', function ($join) {
                $join->on('t_produit.IDt_ProduitPK', '=', 'entries.IDt_ProduitFK');
            })
            
            ->leftJoinSub($exit_qty, 'exits', function ($join) {
                $join->on('t_produit.IDt_ProduitPK', '=', 'exits.IDt_ProduitFK');
            })
            ->leftJoinSub($sold_qty, 'solds', function ($join) {
                $join->on('t_produit.IDt_ProduitPK', '=', 'solds.IDt_ProduitFK');
            })
            ->select(
                't_produit.RefCodeBar',
                't_produit.LibProd',
                't_produit.PrixHT',
                't_produit.QtteStock',
                'entries.qte_entree',
                'exits.qte_sortie',
                'solds.qte_vendu'
            )
            ->where('t_produit.effacer', '=', 0)
            ->where('t_produit.CodeStruct', '=', Auth::user()->CodeStruct)
            ->orderBy('t_produit.LibProd', 'asc')
            ->get();

        return view('admin.stock.current', compact('currents'));
    }
}