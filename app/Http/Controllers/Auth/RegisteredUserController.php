<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', 'unique:gi_user'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!$request->session()->has('gnGnVarNum_Fin_Id')) {
            $request->session()->put('gnGnVarNum_Fin_Id', 0);
        }
        if ($request->session()->get('gnGnVarNum_Fin_Id') == 50) {
            $request->session()->put('gnGnVarNum_Fin_Id', 0);
        }

        $check = User::where('CodeStruct', '=', $request->structure)->where('EstAdmin', '=', 1)->get();
        // dd($check);

        foreach ($check as $key) {
            if ($key->Login == $request->login_sup) {
                $user = User::create([
                    'IDGI_UserPK' => $request->structure . date('YmdHisv') . 'GUS' . $request->session()->get('gnGnVarNum_Fin_Id'),
                    'Login' => $request->login,
                    'Nom' => $request->surname,
                    'Prénom' => $request->firstname,
                    'Email' => $request->email,
                    'CodeStruct' => $request->structure,
                    'MotDePasseCrypte' => $request->password,
                    'ModifierLe' => date('Y-m-d H-i-s'),
                    'DateAjoutLigne' => date('Y-m-d H-i-s'),
                ]);

                $request->session()->put('gnGnVarNum_Fin_Id', $request->session()->get('gnGnVarNum_Fin_Id') + 1);

                event(new Registered($user));

                Auth::login($user);

                return redirect(RouteServiceProvider::HOME);
            }

            else {
                echo 'Vérifier le login du superviseur <br>';
            }
        }
    }
}
