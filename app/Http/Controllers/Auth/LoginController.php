<?php

  

namespace App\Http\Controllers\Auth;

  

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

  

class LoginController extends Controller

{

  

    use AuthenticatesUsers;

    

    protected $redirectTo = "{{route('profile.index')}}";

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('guest')->except('logout');

    }

  

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function login(Request $request)

    {   
     
        
        $input = $request->all();

  

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';


        if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['passw'])))

        {

            return redirect()->route('profile.index');

        }else{

            return redirect()->route('error.auth');

        }

          

    }

}