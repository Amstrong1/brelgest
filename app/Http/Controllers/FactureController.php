<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = DB::table('t_facture')
            ->select('IDt_FacturePK', 'NumFacture', 'Date', 'NomClient', 'Montant_TTC', 'NumFacture_FA', 'Observation')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('NatureFacture', '=', 'FT')
            ->where('effacer', '=', 0)
            ->orderByDesc('Date')
            ->orderByRaw('abs(NumFacture) desc')
            ->get();

        return view('admin.invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->session()->put('facture_session_id', Auth::user()->CodeStruct . date('YmdHis'));

        $invoices = DB::table('t_facture')
            ->select('NumFacture')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('NatureFacture', '=', 'FT')
            ->where('effacer', '=', 0)
            ->orderBy('NumFacture', 'desc')
            ->first();

        $customers = DB::table('t_client')
            ->select('IDt_ClientPK', 'NomCli')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('effacer', '=', 0)
            ->orderBy('NomCli', 'asc')
            ->get();

        return view('admin.invoice.create', compact('customers', 'invoices'));
    }

    /**
     * delete a draft created invoice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancel_invoice(Request $request)
    {
        DB::table('t_lignefact_brouillon')->where('id_fact_brouillon', $request->session()->get('facture_session_id'))->delete();
        return redirect()->route('admin.invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // generation de id facture pk
        if (!$request->session()->has('gnGnVarNum_Fin_Id')) {
            $request->session()->put('gnGnVarNum_Fin_Id', 0);
        }
        if ($request->session()->get('gnGnVarNum_Fin_Id') == 50) {
            $request->session()->put('gnGnVarNum_Fin_Id', 0);
        }
        $id_facture = Auth::user()->CodeStruct . date('YmdHisv') . 'TFA' . $request->session()->get('gnGnVarNum_Fin_Id');

        // calcul du numero de facture
        $num_fact = 0;
        $invoices = DB::table('t_facture')
            ->select('NumFacture')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('NatureFacture', '=', 'FT')
            ->where('effacer', '=', 0)
            ->orderBy('NumFacture', 'desc')
            ->first();
        if (isset($invoices->NumFacture)) {
            $num_fact = $invoices->NumFacture + 1;
        } else {
            $num_fact = 1;
        }

        // gestion du client
        $id_client = ' ';
        $customer = 'inconnu';
        // le client est deja enregistré (champ select)
        if (!empty($request->customer)) {
            $client = DB::table('t_client')
                ->select('NomCli')
                ->where('IDt_ClientPK', '=', $request->customer)
                ->first();

            $id_client = $request->customer;
            $customer = $client->NomCli;
        }
        // nouveau client
        if (!empty($request->new_name) || !empty($request->new_ifu)) {
            // enregistrer le nouveau client
            $new_id = Auth::user()->CodeStruct . date('YmdHisv') . 'TCL' . $request->session()->get('gnGnVarNum_Fin_Id');
            $save_customer = DB::table('t_client')->insert([
                'IDt_ClientPK' => $new_id,
                'AjouterPar' => Auth::user()->Login,
                'CodeStruct' => Auth::user()->CodeStruct,
                'NomCli' => $request->new_name,
                'Tel_1' => $request->new_contact,
                'NumIFU' => $request->new_ifu
            ]);

            if ($save_customer) {
                Alert::toast('Client enregistré', 'success');
                $id_client = $new_id;
                $customer = $request->new_name;
            } else {
                Alert::toast('Une erreur est survenue', 'error');
                return redirect()->back()->withInput($request->input());
            }
        }

        $save_invoice = DB::table('t_facture')->insert([
            'IDt_FacturePK' => $id_facture,
            'AjouterPar' => Auth::user()->Login,
            'CodeStruct' => Auth::user()->CodeStruct,
            'Date' => $request->fact_date,
            'NumFacture' => $num_fact,
            'Observation' => $request->object,
            'IDClientFK' => $id_client,
            'NomClient' => $customer,
            'Montant_HT_AEX' => $request->hta_total,
            'Montant_HT_B' => $request->htb_total,
            'Montant_HT_D' => $request->htd_total,
            'Montant_HT_E' => $request->hte_total,
            'Montant_TVA_B' => $request->hta_total,
            'Montant_TVA_D' => $request->tva_btotal,
            'MontantTotal_TVA' => $request->tva_dtotal,
            'Montant_TTC' => $request->ttc_total,
            'TypeAIB' => $request->aib,
            'MontantAIBRetenuParClient' => $request->aib_total,
            'NatureFacture' => 'FT',
            'MT_CLI_Percu' => $request->mt_percu,
            'MT_CLI_Rendu' => $request->mt_rendu,
            'MT_CLI_Reliquat' => $request->reliquat,
        ]);

        $invoice_lines = DB::table('t_lignefact_brouillon')
            ->join('t_produit', 't_produit.IDt_ProduitPK', '=', 't_lignefact_brouillon.product')
            ->select('t_lignefact_brouillon.*', 't_produit.LibProd', 't_produit.RefCodeBar', 't_produit.RefCodeBar', 't_produit.PrixHT')
            ->where('id_fact_brouillon', $request->session()->get('facture_session_id'))
            ->orderBy('id', 'asc')
            ->get();
        $c = 0;
        foreach ($invoice_lines as $invoice_line) {
            //calcler taux tva
            if ($invoice_line->TypeTaxe == 'A' || $invoice_line->TypeTaxe == 'E') {
                $taux_tva = 0;
                $tva = 1;
            }
            if ($invoice_line->TypeTaxe == 'B' || $invoice_line->TypeTaxe == 'D') {
                $taux_tva = 0.18;
                $tva = 1.18;
            }
            $save_invoice_line = DB::table('t_lignefact')->insert([
                'IDt_LigneFactPK' => Auth::user()->CodeStruct . date('YmdHisv') . 'TLF' . $request->session()->get('gnGnVarNum_Fin_Id'),
                'AjouterPar' => Auth::user()->Login,
                'CodeStruct' => Auth::user()->CodeStruct,
                'ModifierLe' => $invoice_line->created_at,
                'LibProd' => $invoice_line->LibProd,
                'Qtte' => $invoice_line->Qtte,
                'PrixUnitHT' => $invoice_line->PrixHT,
                'PrixUniTTTC' => $invoice_line->PrixHT * $tva,
                'SousTotalTTC' => $invoice_line->PrixHT * $tva * $invoice_line->Qtte,
                'NumOrdre' => ++$c,
                'IDt_ProduitFK' => $invoice_line->product,
                'TauxTVA' => $taux_tva,
                'IDt_FactureFK' => $id_facture,
                'TypeTaxe' => $invoice_line->TypeTaxe,
                'DateAjoutLigne' => date('Y-m-d H-i-s'),
            ]);
            if ($save_invoice_line) {
                $request->session()->put('gnGnVarNum_Fin_Id', $request->session()->get('gnGnVarNum_Fin_Id') + 1);
            }
        }

        if ($save_invoice) {
            $request->session()->put('gnGnVarNum_Fin_Id', $request->session()->get('gnGnVarNum_Fin_Id') + 1);
            Alert::toast('Facture enregistrée', 'success');
            return redirect()->route('admin.invoice.create');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($fact)
    {
        $details = DB::table('t_facture')
            ->join('t_lignefact', 't_facture.IDt_FacturePK', '=', 't_lignefact.IDt_FactureFK')
            ->select('t_facture.*', 't_lignefact.*')
            ->where('t_facture.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_facture.IDt_FacturePK', '=', $fact)
            ->where('t_lignefact.IDt_FactureFK', '=', $fact)
            ->where('t_lignefact.effacer', '=', 0)
            ->get();
        return view('admin.invoice.show', compact('details', 'fact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
