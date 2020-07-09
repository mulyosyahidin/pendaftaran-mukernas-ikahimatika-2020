<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registrant;
use Illuminate\Support\Facades\DB;

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

    public function verify_file()
    {
        return view('admin.registrant.to-verify');
    }

    public function verify_payment()
    {
        return view('admin.registrant.verify-payment');
    }

    public function finished()
    {
        return view('admin.registrant.finished');
    }

    public function failed()
    {
        return view('admin.registrant.failed');
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
}
