<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
class VertifyController extends Controller
{
    public function activation($userId, $token)
{
    $user = User::findOrFail($userId);

    // Check token in user DB. if null then check data (user make first activation).
    if (is_null($user->token)) {
        // Check token from url.
        if (md5($user->email) == $token) {
            // Change status and login user.
            $user->verified = 1;
            $user->token =$token;
            $user->save();

            
       if(!Auth::check()){
            // Make login user.
            Auth::login($user, true);
        }
        } else {
           return redirect('/error/auth');
        }
    } else {
        return redirect('/error/auth');
    }
    return redirect('/');
}
}