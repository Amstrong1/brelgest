<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('t_produit')
            ->select('RefProd', 'LibProd', 'Description', 'PrixHT', 'QtteStock', 'AssujetisTVA')
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('effacer', '=', 0)
            ->get();

            return view('admin.edition.product', compact('products'));
    }
}
