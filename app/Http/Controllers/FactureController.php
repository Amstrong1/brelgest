<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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
            ->orderBy('NumFacture', 'desc')
            ->get();

        return view('admin.invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            ->get();
        return view('admin.invoice.create', compact('customers', 'invoices'));
    }

    /**
     * Show the product list on typing.
     *
     */
    public function selectSearch(Request $request)
    {
        $products = [];
        if ($request->has('q')) {
            $search = $request->q;
            $products = DB::table('t_produit')->select("id", "LibProd", "PrixHT", "AssujetisTVA")
                ->where('CodeStruct', '=', Auth::user()->CodeStruct)
                ->where('LibProd', 'LIKE', "%$search%")
                ->where('effacer', '=', 0)
                ->get();
        }
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $taux_tva = 0;

        if ($request->tva_btotal != 0 || $request->htd_total != 0) {
            $taux_tva = 0.18;
        }

        if (!$request->session()->has('gnGnVarNum_Fin_Id')) {
            $request->session()->put('gnGnVarNum_Fin_Id', 0);
        }
        if ($request->session()->get('gnGnVarNum_Fin_Id') == 50) {
            $request->session()->put('gnGnVarNum_Fin_Id', 0);
        }

        if (!isset($request->customer)) {
            $customer = $request->new_name;

            $save_customer = DB::table('t_client')->insert([
                'AjouterPar' => Auth::user()->Login,
                'ModifierPar' => Auth::user()->Login,
                'CodeStruct' => Auth::user()->CodeStruct,
                'NomCli' => $request->new_name,
                'NumIFU' => $request->new_ifu,
                'Tel_1' => $request->new_contact,
            ]);

            if ($save_customer) {
                $get_customer = DB::table('t_client')
                    ->select('IDt_ClientPK', 'NomCli')
                    ->where('CodeStruct', '=', Auth::user()->CodeStruct)
                    ->orderByDesc('id')
                    ->first();
                $customer_id = $get_customer->IDt_ClientPK;
                $customer = $get_customer->NomCli;
            } else {
                return redirect()->back()->withInput($request->input());
            }
        } else {
            $customer_id = explode("/", $request->customer)[0];
            $customer = explode("/", $request->customer)[1];
        }

        $save_invoice = DB::table('t_facture')->insert([
            'IDt_FacturePK' => Auth::user()->CodeStruct . date('YmdHisv') . 'TFA' . $request->session()->get('gnGnVarNum_Fin_Id'),
            'AjouterPar' => Auth::user()->Login,
            'ModifierLe' => date('Y-m-d H-i-s'),
            'CodeStruct' => Auth::user()->CodeStruct,
            'NumFacture' => $request->num_fact,
            'Date' => $request->fact_date,
            'Observation' => $request->object,
            'IDClientFK' =>  $customer_id,
            'Tota_Remise' => $request->t_remise,
            'DateCommande' => $request->fact_date,
            'Total_DejaPaye' => '',
            'NomClient' => $customer,
            'Montant_HT_AEX' => $request->hta_total,
            'Montant_TVA_B' => $request->tva_btotal,
            'MontantTotal_TVA' => $request->tva_btotal + $request->tva_dtotal,
            'Montant_HT_B' => $request->htb_total,
            'Montant_TS_B' => '',
            'Montant_AIB' => $request->aib_total,
            'Montant_TTC' => $request->htf_total,
            'NumeroOperateur' => '',
            'NomOperateur' => Auth::user()->Nom . Auth::user()->Prénom,
            'TypeAIB' => explode("/", $request->aib)[1],
            'TauxTVA' => $taux_tva,
            'CategorieFacture' => '',
            'MontantAIBRetenuParClient' => $request->aib,
            'Montant_HT_D' => $request->htd_total,
            'Montant_TVA_D' => $request->tva_dtotal,
            'TableauDeDonnéesDeNormalisation' => '',
            'Montant_HT_C' => $request->htc_total,
            'Montant_HT_E' => $request->hte_total,
            'Montant_HT_F' => $request->htf_total,
            'TypeFacture' => 'FV',
            'Montant_TVA_E' => '',
            'Montant_TS_D' => '',
            'Montant_TS_E' => '',
            'DateAjoutLigne' => date('Y-m-d H-i-s'),
            'MT_CLI_Percu' => $request->mt_percu,
            'MT_CLI_Rendu' => $request->mt_rendu,
            'MT_CLI_Reliquat' => $request->reliquat,
            'NatureFacture' => 'FT'
        ]);

        if ($save_invoice) {
            $request->session()->put('gnGnVarNum_Fin_Id', $request->session()->get('gnGnVarNum_Fin_Id') + 1);
            return redirect()->route('admin.invoice.create');
        } else {
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
        return view('admin.invoice.show', compact('details'));
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
