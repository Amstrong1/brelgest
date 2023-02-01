<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = DB::table('t_client')
            ->select('*')
            ->where('t_client.CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('t_client.effacer', '=', 0)
            ->orderBy('NomCli', 'asc')
            ->get();
        return view('admin.edition.customer', compact('customers'));
    }
}
