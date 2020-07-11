<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Registrant;
use App\Models\Registrant_custom_university as Custom;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'min:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'phone_number' => ['required', 'min:8', 'max:16', 'unique:users'],
            'whatsapp_number' => ['required', 'min:8', 'max:16', 'unique:users'],
            'nim' => ['required', 'min:4', 'max:32', 'unique:users'],
            'region_id' => ['required', 'numeric'],
            'university_id' => ['required', 'numeric'],
            'hima_id' => ['required', 'numeric'],
            'delegation_letter' => ['required', 'mimes:pdf', 'max:2048'],
            'picture' => ['required', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('registrant');

        $id = $user->id;

        Guest::create([
            'user_id' => $id,
            'phone_number' => $data['phone_number'],
            'whatsapp_number' => $data['whatsapp_number'],
            'nim' => $data['nim'],
            'region_id' => $data['region_id'],
            'university_id' => $data['university_id'],
            'organization_id' => $data['organization_id']
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone_number' => ['required', 'min:8', 'max:16'],
            'whatsapp_number' => ['required', 'min:8', 'max:16'],
            'nim' => ['required', 'min:4', 'max:32'],
            'delegation_letter' => ['required', 'mimes:pdf', 'max:2048'],
            'picture' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole('registrant');

        $user_id = $user->id;

        $registrant = new Registrant;
        $registrant->user_id = $user_id;
        $registrant->registration_status = 1;
        $registrant->phone_number = $request->phone_number;
        $registrant->whatsapp_number = $request->whatsapp_number;
        $registrant->nim = $request->nim;

        if (is_numeric($request->region_id) && is_numeric($request->university_id) && is_numeric($request->hima_id)) {
            $registrant->region_id = $request->region_id;
            $registrant->university_id = $request->university_id;
            $registrant->organization_id = $request->hima_id;
        }
        $registrant->save();

        $registrant_id = $registrant->id;

        if (is_array($request->custom) && count($request->custom) > 0) {
            $custom = $request->custom;

            if ((isset($custom['university_name']) && $custom['university_name']) !== '' && (isset($custom['organization_name']) && $custom['organization_name'] !== '')) {
                $registrantCustom = new Custom;

                $registrantCustom->registrant_id = $registrant_id;
                $registrantCustom->region_id = $custom['region_id'];
                $registrantCustom->university_name = $custom['university_name'];
                $registrantCustom->organization_name = $custom['organization_name'];

                $registrantCustom->save();
            }
        }

        if ($request->hasFile('delegation_letter') && $request->file('delegation_letter')->isValid()) {
            //surat rekomendasi
            $user->addMediaFromRequest('delegation_letter')
                ->toMediaCollection('delegation_letter_file');
        }

        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            //file form pendaftaran
            $user->addMediaFromRequest('picture')
                ->toMediaCollection('registrant_picture');
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()
                ->to(route('reg.home'))
                ->withSuccess('Pendaftaran berhasil');
        }
    }
}
