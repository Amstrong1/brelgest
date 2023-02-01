<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EmptySoonController extends Controller
{
    public function index()
    {
        $alerts = DB::table('t_produit')
            ->select('RefCodeBar', 'LibProd', 'QtteStock', 'QtteMini')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->whereColumn('QtteStock', '<=', 'QtteMini')
            ->where('QtteStock', '>', 0)
            ->where('effacer', '=', 0)
            ->get();

        // dd($alerts);
        return view('admin.stock.empty_soon', compact('alerts'));
    }
}
