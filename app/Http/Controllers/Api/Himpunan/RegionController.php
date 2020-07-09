<?php

namespace App\Http\Controllers\Api\Himpunan;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use Validator;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->json(['data' => Region::orderBy('name', 'ASC')->get()]);
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
            'name' => 'required|min:4',
            'code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['error' => TRUE, 'errors' => $validator->errors()]);
        }

        $region = new Region;
        $region->name = $request->name;
        $region->code = $request->code;
        $region->save();

        return response()
            ->json(['success' => TRUE, 'message' => 'Berhasil menambah data wilayah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return $region;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['error' => TRUE, 'errors' => $validator->errors()]);
        }

        $region->name = $request->name;
        $region->code = $request->code;
        $region->save();

        return response()
            ->json(['success' => TRUE, 'message' => 'Berhasil memperbarui data wilayah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();

        return response()
            ->json(['success' => TRUE, 'message' => 'Berhasil menghapus wilayah']);
    }
}
