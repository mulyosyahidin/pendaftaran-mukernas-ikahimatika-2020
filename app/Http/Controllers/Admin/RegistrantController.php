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
}
