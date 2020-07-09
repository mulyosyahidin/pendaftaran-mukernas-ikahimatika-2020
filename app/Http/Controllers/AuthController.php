<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        if ( ! Auth::attempt($credentials)) {
            return redirect()
                ->back()
                ->withError('Email atau Password salah');
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        $roles = Auth::user()->getRoleNames();

        if ($roles[0] == 'registrant') {
            $request->session()->flash('loginHello', 'Halo '. Auth::user()->name .', selamat datang kembali!');
            return redirect()
                ->to(route('reg.home'));
        }
        else if ($roles[0] == 'admin') {
            session(['Bearer_token' => $tokenResult->accessToken]);
            return redirect()
                ->to(route('admin.home'));
        }
        else {
            return redirect()
                ->to(route('home'));
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
