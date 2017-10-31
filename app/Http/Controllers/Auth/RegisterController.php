<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        $rules = User::rules();

        return Validator::make($data, $rules);
    }

    protected function create(array $data)
    {
        $user = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'nick' => $data['nick'],
            'password' => bcrypt($data['password']),
            'dob' => $data['dob'],
            'gender' => $data['gender']
        ];

        return User::create($user);
    }

    public function showRegistrationForm()
    {
        $genders = User::genders();

        return view('auth.register', compact('genders'));
    }
}
