<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $logo = Setting::findOrFail(2);

        return view('admin.settings.index', compact('logo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|max:2048|mimes:png,jpg,jpeg'
        ]);

        $name = Setting::findOrFail(1);
        $name->content = $request->name;
        $name->save();

        $logo = Setting::findOrFail(2);

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            if (isset($logo->media[0])) {
                $logo->media[0]->delete();
            }

            $logo->addMediaFromRequest('logo')
                ->toMediaCollection('site_logo');
        }

        return redirect()
            ->back()
            ->withSuccess('Pengaturan berhasil disimpan');
    }

    public function banks()
    {
        return view('admin.settings.banks');
    }

    public function contacts()
    {
        return view('admin.settings.contacts');
    }
}
