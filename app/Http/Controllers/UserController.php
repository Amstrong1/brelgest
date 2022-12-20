<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()
            ->where('CodeStruct', '=', Auth::user()->CodeStruct)
            ->where('Effacer', '=', '0');

            return view('admin.users', compact('users'));
    }
}
