<?php

namespace App\Http\Controllers\Registrant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Contact;

class HelpController extends Controller
{
    public function index()
    {

    }

    public function banks()
    {
        $banks = Bank::all();

        return view('registrant.help.banks', compact('banks'));
    }

    public function contacts()
    {
        $contacts = Contact::all();

        return view('registrant.help.contacts', compact('contacts'));
    }
}
