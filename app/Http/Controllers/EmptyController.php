<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class EmptyController extends Controller
{
    public function index()
    {
        $alerts = DB::table('t_produit')
            ->select('RefProd', 'LibProd', 'QtteStock')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('QtteStock', '=', 0)
            ->where('effacer', '=', 0)
            ->get();
        return view('admin.stock.empty', compact('alerts'));
    }
}
