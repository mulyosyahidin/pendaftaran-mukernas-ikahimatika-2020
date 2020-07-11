<?php

namespace App\Http\Controllers\Registrant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registrant;
use Illuminate\Support\Facades\Auth;
use App\Models\Bank;
use App\Models\Contact;
use App\Models\Registrant_custom_university;

class RegistrantController extends Controller
{
    public function index()
    {
        return view('registrant.index');
    }

    public function data()
    {
        $registrant = Registrant::where('user_id', Auth::id())->firstOrFail();

        return view('registrant.data', compact('registrant'));
    }

    public function status()
    {
        $registrant = Registrant::where('user_id', Auth::id())->firstOrFail();

        $status = $registrant->status;
        $banks = Bank::all();
        $contacts = Contact::all();

        return view('registrant.status', compact('status', 'banks', 'contacts'));
    }
}
