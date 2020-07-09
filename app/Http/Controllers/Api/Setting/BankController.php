<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Validator;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->json(['data' => Bank::all()]);
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
            'bank_name' => 'required',
            'bank_number' => 'required',
            'owner_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['error' => TRUE, 'errors' => $validator->errors()]);
        }

        $bank = new Bank;
        $bank->bank_name = $request->bank_name;
        $bank->bank_number = $request->bank_number;
        $bank->owner_name = $request->owner_name;
        $bank->save();

        return response()
            ->json(['success' => TRUE, 'message' => 'Berhasil menambah data']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        return $bank;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required',
            'bank_number' => 'required',
            'owner_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['error' => TRUE, 'errors' => $validator->errors()]);
        }

        $bank->bank_name = $request->bank_name;
        $bank->bank_number = $request->bank_number;
        $bank->owner_name = $request->owner_name;
        $bank->save();

        return response()
            ->json(['success' => TRUE, 'message' => 'Berhasil memperbarui data']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();

        return response()
            ->json(['success' => TRUE, 'message' => 'Berhasil menghapus data']);
    }
}
