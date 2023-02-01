<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvLineController extends Controller
{
    public function index(Request $request)
    {
        $invlines = null;

        if (request()->method() == 'POST') {
            $validate = Validator::make($request->all(), [
                'start' => 'required',
                'end' => 'required'
            ]);
            if (!$validate->fails()) {
                $invlines = DB::table('t_lignefact')
                    ->join('t_facture', 't_lignefact.IDt_FactureFK', '=', 't_facture.IDt_FacturePK')
                    ->join('t_produit', 't_lignefact.IDt_ProduitFK', '=', 't_produit.IDt_ProduitPK')
                    ->select('t_facture.Date', 't_lignefact.RefCodeBar', 't_lignefact.LibProd', 't_lignefact.TypeTaxe', 't_lignefact.Qtte', 't_lignefact.PrixUnitHT', 't_lignefact.PrixUniTTTC', 't_lignefact.SousTotalTTC', 't_lignefact.Remise', 't_facture.NomClient', 't_facture.NumFacture')
                    ->where('t_facture.CodeStruct', '=', Auth::user()->CodeStruct)
                    ->whereBetween('t_facture.Date', [$request->start, $request->end])
                    ->where('t_facture.NatureFacture', '=', 'FT')
                    ->where('t_lignefact.effacer', '=', 0)
                    ->where('t_facture.effacer', '=', 0)
                    ->where('t_produit.effacer', '=', 0)
                    ->orderByDesc('t_facture.Date')
                    ->orderByRaw('abs(t_facture.NumFacture) desc')
                    ->orderBy('t_lignefact.NumOrdre', 'asc')
                    ->get();

                // $rm_total = DB::table('t_lignefact')
                //     ->join('t_facture', 't_lignefact.IDt_FactureFK', '=', 't_facture.IDt_FacturePK')
                //     ->join('t_produit', 't_lignefact.IDt_ProduitFK', '=', 't_produit.IDt_ProduitPK')
                //     ->select(DB::raw('SUM(t_lignefact.Remise) AS rm_total'))
                //     ->where('t_facture.CodeStruct', '=', Auth::user()->CodeStruct)
                //     ->whereBetween('t_facture.Date', [$request->start, $request->end])
                //     ->where('t_facture.NatureFacture', '=', 'FT')
                //     ->where('t_lignefact.effacer', '=', 0)
                //     ->where('t_facture.effacer', '=', 0)
                //     ->where('t_produit.effacer', '=', 0)
                //     ->orderByDesc('t_facture.Date')
                //     ->orderByRaw('abs(t_facture.NumFacture) desc')
                //     ->orderBy('t_lignefact.NumOrdre', 'asc')
                //     ->first();
            }
        }

        return view('admin.statistique.lines', compact('invlines'));
    }
}
