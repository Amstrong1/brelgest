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
            ->join('t_familleprod', 't_produit.IDt_FamilleProdFK', '=', 't_familleprod.IDt_FamilleProdPK')
            ->select('t_familleprod.LibelléFam', 'RefCodeBar', 'LibProd', 'Description', 'PrixHT', 'QtteStock', 'AssujetisTVA')
            ->where('t_produit.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_familleprod.effacer', '=', 0)
            ->where('t_produit.effacer', '=', 0)
            ->orderBy('t_familleprod.LibelléFam', 'asc')
            ->orderBy('LibProd', 'asc')
            ->get();

        return view('admin.edition.product', compact('products'));
    }
}
