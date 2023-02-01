<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProdFamilController extends Controller
{
    public function index()
    {
        $groups = DB::table('t_familleprod')
            ->select('t_familleprod.CodeFam', 't_familleprod.LibelléFam')
            ->where('t_familleprod.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_familleprod.effacer', '=', 0)
            ->orderBy('LibelléFam', 'asc')
            ->get();
        return view('admin.edition.product_group', compact('groups'));
    }
}
