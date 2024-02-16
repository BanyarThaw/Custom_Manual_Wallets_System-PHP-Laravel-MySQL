<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function loginForm() {
        if(!Auth::check()) {
            return view('login.login');
        }
        return redirect()->route('payments.index');
    }

    public function login(Request $request) {
        $email = filter_var($request->email, FILTER_SANITIZE_EMAIL);

        $password = filter_var($request->password, FILTER_SANITIZE_STRING);

        if(Auth::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            $user = Auth::user();
            return redirect()->route('payments.index');
        }
        return redirect('/boot')->with('info','Email or password not matched.');
    }

    public function logout() {
        Auth::logout();
        return redirect('/boot');
    }

    public function changePasswordForm() {
        return view('login.change-password');
    }

    public function changePassword(Request $request) {
        request()->validate([
            "password" => "required",
        ]);

        $user = User::find(Auth::user()->id);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('payments.index')->with('info','Password changing success.');
    }
}
