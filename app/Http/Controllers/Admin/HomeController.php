<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $alerts_req = DB::table('t_produit')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('QtteStock', '<=', 0)
            ->where('effacer', '=', 0)
            ->count();

        $alerts_req2 = DB::table('t_produit')
            ->select('*')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('QtteStock', '>', 0)
            ->where('QtteStock', '<=', 't_produit.QtteMini')
            ->where('effacer', '=', 0)
            ->count();

        $providers_req = DB::table('t_fournisseur')
            ->select('NomFrns')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('effacer', '=', 0)
            ->count();

        $customers_req = DB::table('t_client')
            ->select('NomCli')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('effacer', '=', 0)
            ->count();

        $products_req = DB::table('t_produit')
            ->select('RefProd')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('effacer', '=', 0)
            ->count();

        $invoices_req = DB::table('t_facture')
            ->select('*')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('effacer', '=', 0)
            ->count();

        $invoices_count = DB::table('t_facture')
            ->select(DB::raw('SUM(t_facture.Montant_TTC) as Montant_TTC'))
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_facture.NatureFacture', '=', 'FT')
            ->where('Date', '=', date('Y-m-d'))
            ->where('effacer', '=', 0)
            ->get();

        $users_req = User::where('CodeStruct', '=', Auth::user()->CodeStruct)->count();;

        return view('admin.index', compact(
            'alerts_req',
            'alerts_req2',
            'providers_req',
            'customers_req',
            'products_req',
            'invoices_req',
            'invoices_count',
            'users_req'
        ));
    }
}
