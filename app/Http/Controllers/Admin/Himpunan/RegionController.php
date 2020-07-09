<?php

namespace App\Http\Controllers\Admin\Himpunan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    public function index()
    {
        return view('admin.himpunan.region.index');
    }
}
