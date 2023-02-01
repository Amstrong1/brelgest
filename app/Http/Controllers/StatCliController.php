<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StatCliController extends Controller
{
    public function index(Request $request)
    {
        $consumers = null;

        if (request()->method() == 'POST') {
            $validate = Validator::make($request->all(), [
                'start' => 'required',
                'end' => 'required'
            ]);
            if (!$validate->fails()) {
                $consumers = DB::table('t_facture')
                ->join('t_client', 't_facture.IDClientFK', '=', 't_client.IDt_clientPK')
                ->select('t_facture.IDClientFK', 't_client.NomCli', DB::raw('SUM(t_facture.Montant_HT_AEX) as Montant_HT_AEX'), DB::raw('SUM(t_facture.Montant_HT_B) as Montant_HT_B'), DB::raw('SUM(t_facture.MontantTotal_TVA) as MontantTotal_TVA'), DB::raw('SUM(t_facture.Montant_TVA_B) as Montant_TVA_B'), DB::raw('SUM(t_facture.Montant_TS_B) as Montant_TS_B'), DB::raw('SUM(t_facture.Montant_HT_D) as Montant_HT_D'), DB::raw('SUM(t_facture.Montant_TS_D) as Montant_TS_D'), DB::raw('SUM(t_facture.Montant_TVA_D) as Montant_TVA_D'), DB::raw('SUM(t_facture.Montant_HT_E) as Montant_HT_E'), DB::raw('SUM(t_facture.Montant_AIB) as Montant_AIB'), DB::raw('SUM(t_facture.Montant_TTC) as Montant_TTC'))
                ->where('t_facture.CodeStruct', '=', Auth::user()->CodeStruct)
                ->whereBetween('t_facture.Date', [$request->start, $request->end])
                ->groupByRaw('t_facture.IDClientFK, t_client.IDt_clientPK')
                ->where('t_facture.NatureFacture', '=', 'FT')
                ->where('t_facture.effacer', '=', 0)
                ->where('t_client.effacer', '=', 0)
                ->get();             
            }
        }

        return view('admin.statistique.consumer', compact('consumers'));
    }
}
