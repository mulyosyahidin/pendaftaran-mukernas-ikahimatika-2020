<?php

namespace App\Http\Controllers\Admin\Himpunan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;
class HimpunanController extends Controller
{
    public function index()
    {
        return view('admin.himpunan.organization.index');
    }

    public function create()
    {
        return view('admin.himpunan.organization.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'create.*.name' => 'required',
            'create.*.university_id' => 'required'
        ]);

        Organization::insert($request->create);

        return redirect()
            ->back()
            ->withSuccess('Berhasil menambahkan data');
    }
}
