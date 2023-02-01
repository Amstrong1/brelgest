<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProformaController extends Controller
{
    public function index()
    {
        $invoices = DB::table('t_facture')
            ->select('IDt_FacturePK', 'NumFacture', 'Date', 'NomClient', 'Montant_TTC', 'NumFacture_FA', 'Observation')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('NatureFacture', '=', 'FP')
            ->where('effacer', '=', 0)
            ->orderByDesc('Date')
            ->orderByRaw('abs(NumFacture) desc')
            ->get();

        return view('admin.invoice.proforma', compact('invoices'));
    }
}
