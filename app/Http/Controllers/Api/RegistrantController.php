<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Registrant;
use Illuminate\Http\Request;

class RegistrantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->status;

        if ($status && $status > 0) {
            $registrants = Registrant::where('registration_status', $status)->get();
        }
        else {
            $registrants = Registrant::all();
        }

        $data = [];
        $n = 0;

        foreach ($registrants as $registrant) {
            $data[$n]['id'] = $registrant->id;
            $data[$n]['name'] = $registrant->user->name;
            $data[$n]['nim'] = $registrant->nim;
            $data[$n]['status'] = $registrant->status->name;
            $data[$n]['organization'] = isset($registrant->organization->name) ? $registrant->organization->name : $registrant->custom->organization_name;
            $data[$n]['university'] = isset($registrant->university->name) ? $registrant->university->name : $registrant->custom->university_name;

            $n++;
        }

        return response()
            ->json(['data' => $data]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registrant  $registrant
     * @return \Illuminate\Http\Response
     */
    public function show(Registrant $registrant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registrant  $registrant
     * @return \Illuminate\Http\Response
     */
    public function edit(Registrant $registrant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registrant  $registrant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registrant $registrant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registrant  $registrant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registrant $registrant)
    {
        //
    }
}
