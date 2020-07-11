<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registrant;
use App\Models\University;
use App\Models\Organization;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistrantController extends Controller
{
    public function index()
    {
        return view('admin.registrant.all');
    }

    public function show($id) {
        $registrant = Registrant::findOrFail($id);

        return view('admin.registrant.show', compact('registrant'));
    }

    public function display($reg_status)
    {
        $statuses = [1, 2, 3, 4];

        if (in_array($reg_status, $statuses))
        {
            return view('admin.registrant.status-'. $reg_status);
        }
    }

    public function accept($id)
    {
        $registrant = Registrant::findOrFail($id);

        DB::table('registrants')
            ->where('id', $id)
            ->update(['registration_status' => 2]);

        return redirect()
            ->back()
            ->withSuccess('Pendaftar diterima');
    }

    public function decline($id)
    {
        $registrant = Registrant::findOrFail($id);

        DB::table('registrants')
            ->where('id', $id)
            ->update(['registration_status' => 4]);

        return redirect()
            ->back()
            ->withSuccess('Berkas pendaftar ditandai sebagai gagal diverifikasi');
    }

    public function payed($id)
    {
        $registrant = Registrant::findOrFail($id);

        DB::table('registrants')
            ->where('id', $id)
            ->update(['registration_status' => 3]);

        return redirect()
            ->back()
            ->withSuccess('Pendaftar ditandai sebagai sudah membayar');
    }

    public function export()
    {
        return view('admin.registrant.export');
    }

    public function destroy($id)
    {
        $registrant = Registrant::findOrFail($id);
        $reg_status = $registrant->registration_status;

        $registrant->user->media[0]->delete();
        $registrant->user->media[1]->delete();

        $registrant->delete();

        return redirect()
            ->to(route('admin.reg.display', $reg_status))
            ->withSuccess('Data pendaftaran peserta berhasil dihapus');
    }

    public function edit(Registrant $registrant)
    {
        $universities = University::orderBy('name', 'ASC')->get();
        $organizations = Organization::orderBy('name', 'ASC')->get();

        return view('admin.registrant.edit', compact('registrant', 'universities', 'organizations'));
    }

    public function update(Request $request, Registrant $registrant)
    {
        $request->validate([
            'name' => 'required|min:4|max:64',
            'nim' => 'required|min:6|max:32',
            'whatsapp_number' => 'required|min:9|max:15',
            'phone_number' => 'required|min:9|max:15',
            'picture' => 'nullable|max:2048|mimes:jpg,jpeg,png',
            'email' => 'nullable|email:filter',
            'password' => 'nullable|min:6',
            'region_id' => 'required|numeric',
            'university_id' => 'required|numeric',
            'organization_id' => 'required|numeric',
        ]);

        $user = User::findOrFail($registrant->user->id);
        $user->name = $request->name;

        if ($request->email !== '') {
            $user->email = $request->email;
        }

        if ($request->password === '') {
            $password = $registrant->user->password;
        }
        else {
            $password = Hash::make($request->password);
        }
        $user->password = $password;

        $user->save();

        $registrant->nim = $request->nim;
        $registrant->phone_number = $request->phone_number;
        $registrant->whatsapp_number = $request->whatsapp_number;
        $registrant->region_id = $request->region_id;
        $registrant->university_id = $request->university_id;
        $registrant->organization_id = $request->organization_id;
        
        $registrant->save();

        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            if (isset($user->media[1])) {
                $user->media[1]->delete();
            }

            $user->addMediaFromRequest('picture')
                ->toMediaCollection('registrant_picture');
        }

        return redirect()
            ->to(route('admin.reg.show', $registrant->id))
            ->withSuccess('Berhasil menyimpan data pendaftaran peserta');
    }
}
