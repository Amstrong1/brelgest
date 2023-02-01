<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CreditController extends Controller
{
    public function index()
    {
        $fa_invoices = DB::table('t_facture')
            ->select('IDt_FacturePK', 'NomClient', 'Montant_TTC', 'NumFacture_FA', 'DateFactureAvoir', 'Observation')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('effacer', '=', 1)
            ->where('NumFacture_FA', '!=', '')
            ->where('DateFactureAvoir', '!=', '')
            ->orderByDesc('DateFactureAvoir')
            ->orderByRaw('abs(NumFacture_FA) desc')
            ->get();

        return view('admin.invoice.credit_note', compact('fa_invoices'));
    }
}
