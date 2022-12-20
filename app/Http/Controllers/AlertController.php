<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = DB::table('t_produit')
            ->select('RefProd', 'LibProd', 'QtteStock')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('QtteStock', '<=', 'QtteMini')
            ->where('effacer', '=', 0)
            ->get();
        return view('admin.stock.alert', compact('alerts'));
    }
}
