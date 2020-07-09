<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->json(['data' => Contact::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'whatsapp_number' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['error' => TRUE, 'errors' => $validator->errors()]);
        }

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->whatsapp_number = $request->whatsapp_number;
        $contact->save();

        return response()
            ->json(['success' => TRUE, 'message' => 'Berhasil menambah data']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'whatsapp_number' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['error' => TRUE, 'errors' => $validator->errors()]);
        }

        $contact->name = $request->name;
        $contact->whatsapp_number = $request->whatsapp_number;
        $contact->save();

        return response()
            ->json(['success' => TRUE, 'message' => 'Berhasil memperbarui data']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()
            ->json(['success' => TRUE, 'message' => 'Berhasil menghapus data']);
    }
}
