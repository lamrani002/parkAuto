<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use App\Mail\confirmationEmail;
use Auth;

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
     //permet l'acces sauf a l'administrateur
    public function __construct()
    {
      $this->middleware(['admin','auth']);
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
     //creer l'agent en lui envoyant un email de confirmation
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirmation_token' => bcrypt(str_random(16)),
        ]);
        $thisUser = User::findOrFail($user->id);
        $this->sendEmail($thisUser);
        return $user;
    }

    public function sendEmail($thisUser){
      Mail::to($thisUser['email'])->send(new confirmationEmail($thisUser));

    }

    public function verifyEmail(){
      return view('email.verifyEmail');
    }

    public function sendEmailDone($email,$confirmation_token)
    {
      $user = User::where(['email' => $email,'confirmation_token' => $confirmation_token])->first();
      if ($user){
        return User::where(['email' => $email,'confirmation_token' => $confirmation_token])->update(['status' =>'1','confirmation_token' => NULL]);
      }
      else {
        return 'error 404 Oups! lien expiré';
      }
    }

}
