<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registrant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $params['registrantToday'] = Registrant::whereDate('created_at', Carbon::today())->count();
        $params['weekRegistrant'] = Registrant::where('created_at', '>', Carbon::now()->startOfWeek())
            ->where('created_at', '<', Carbon::now()->endOfWeek())
            ->count();
        $params['totalRegistrant'] = Registrant::count();

        $params['waitingForVerification'] = Registrant::where('registration_status', 1)->count();
        $params['waitingForPayment'] = Registrant::where('registration_status', 2)->count();
        $params['finishedRegistrant'] = Registrant::where('registration_status', 3)->count();
        $params['failedRegistrant'] = Registrant::where('registration_status', 4)->count();

        $params['fileVerifications'] = Registrant::where('registration_status', 1)->orderBy('created_at', 'DESC')->limit(5)->get();
        $params['paymentVerifications'] = Registrant::where('registration_status', 2)->orderBy('created_at', 'DESC')->limit(5)->get();
        

        return view('admin.index')
            ->with($params);
    }
}
