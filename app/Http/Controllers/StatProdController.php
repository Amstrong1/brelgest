<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StatProdController extends Controller
{
    public function index(Request $request)
    {
        $consumes = null;

        if (request()->method() == 'POST') {
            $validate = Validator::make($request->all(), [
                'start' => 'required',
                'end' => 'required'
            ]);

            if (!$validate->fails()) {
                $consumes = DB::table('t_lignefact')
                    ->join('t_produit', 't_lignefact.IDt_ProduitFK', '=', 't_produit.IDt_produitPK')
                    ->join('t_facture', 't_lignefact.IDt_FactureFK', '=', 't_facture.IDt_FacturePK')
                    ->select('t_produit.RefProd', 't_produit.LibProd', DB::raw('SUM(t_lignefact.Qtte) as total_sales'), 't_lignefact.SousTotalTTC')
                    ->groupByRaw('t_produit.RefProd, t_produit.LibProd')
                    ->where('t_lignefact.CodeStruct', '=', Auth::user()->CodeStruct)
                    ->where('t_lignefact.effacer', '=', 0)
                    ->where('t_produit.effacer', '=', 0)
                    ->get();
            }
        }

        return view('admin.statistique.consumes', compact('consumes'));
    }
}
