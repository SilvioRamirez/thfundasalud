<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Trabajador;
use App\Models\User;
use App\Models\UbicacionFisica;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    protected $redirectTo = '/home';

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cedula' => [
                'required',
                'string',
                'max:10',
                Rule::unique('users', 'cedula'), // La cédula debe ser única en la tabla users
                    function ($attribute, $value, $fail) {
                        // Verificar si la cédula existe en la tabla trabajadors
                        if (!Trabajador::where('cedula', $value)->exists()) {
                            $fail('La cédula no está registrada en el sistema.');
                        }
                    },
                ],
            /* 'g-recaptcha-response' => 'required|captcha', */ /* Se agrega para el captcha */
            'telefono' => ['required'],
            'ubicacion_fisica_id' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cedula' => $data['cedula'],
            'telefono' => $data['telefono'],
            'ubicacion_fisica_id' => $data['ubicacion_fisica_id'],
            'password' => Hash::make($data['password']),
        ])->assignRole('user'); /* Se agrega para que cuando alguien se registre automanticamente sea con este rol */
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $ubicacion_fisicas = UbicacionFisica::pluck('ubicacion_fisica', 'id')->all();
        return view('auth.register', compact('ubicacion_fisicas'));
    }
}
