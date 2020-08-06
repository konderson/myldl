<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Person;
use App\Mail\Vertify; use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
   // protected $redirectTo = "/profile/index";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     
        protected $redirectPath= '/plan';
     
     
 /*    
     protected function redirectTo()
{
     return redirect('/profile/index');
}
   /*  
     
  
     
     
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
            'username' => ['required', 'string', 'max:255'],
            'email1' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required', 'string', 'min:8',],
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
        $user= User::create([
            'name' => $data['username'],
            'email' => $data['email1'],
            'password' => Hash::make($data['password']),
        ]);
        
        $person=new Person();
        $person->names=$data['username'];
        $person->user_id=$user->id;
		$person->avatar='default.png';
        $person->save();
		$pass=$data['password'];
        Mail::to($user->email)->send(new Vertify($user,$pass));
       
        
  return $user;
    }
}