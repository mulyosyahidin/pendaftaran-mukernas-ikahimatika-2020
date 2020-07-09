<?php

namespace App\Http\Controllers\Api\Accessible;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $is_select2 = $request->select2;

        $data = University::with('region')
            ->orderBy('name', 'ASC')
            ->get();

        if (!$is_select2) {
            return response()
                ->json(['data' => $data]);
        }

        $results = [];
        $n = 0;
        $query = $request->q;
        $selected = ($request->selected) ? $request->selected : 0;
        $region_id = $request->region;

        if ($region_id) {
            $data = University::where('name', 'like', '%'. $query .'%')
                ->where('region_id', $region_id)
                ->get();
        }
        else {
            $data = University::where('name', 'like', '%'. $query .'%')
                ->orderBy('name', 'ASC')
                ->get();
        }

        foreach ($data as $result) {
            $results[$n]['text'] = $result->name;
            $results[$n]['id'] = $result->id;

            if ($result->id == $selected) {
                $results[$n]['selected'] = TRUE;
            }

            $n++;
        }

        return response()
            ->json(['results' => $results]);
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
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit(University $university)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, University $university)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        //
    }
}
