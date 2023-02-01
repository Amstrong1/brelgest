<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = DB::table('t_produit')
            ->select('RefCodeBar', 'LibProd', 'QtteStock')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->whereColumn('QtteStock', '<=', 'QtteMini')
            ->where('effacer', '=', 0)
            ->orderByDesc('QtteStock')
            ->orderBy('LibProd', 'asc')
            ->get();
        return view('admin.stock.alert', compact('alerts'));
    }
}
