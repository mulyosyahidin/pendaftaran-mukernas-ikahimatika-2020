<?php

namespace App\Http\Controllers\Registrant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('registrant.profile');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|min:10|max:64',
            'password' => 'nullable|min:6'
        ]);

        if ($request->password == '') {
            $password = Auth::user()->password;
        }
        else {
            $password = Hash::make($request->password);
        }

        $user = User::find(Auth::id());
        $user->email = $request->email;
        $user->password = $password;
        $user->save();

        return redirect()
            ->back()
            ->withSuccess('Data berhasil diperbarui');
    }
}
