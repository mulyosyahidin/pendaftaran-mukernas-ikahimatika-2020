<?php

namespace App\Http\Controllers\Admin\Himpunan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;

class UniversityController extends Controller
{
    public function index()
    {
        $regions = Region::all();

        return view('admin.himpunan.university.index', compact('regions'));
    }
}
