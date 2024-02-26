<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    protected function credentials(Request $request)
    {        
        return ['email' => $request->{$this->email()}, 'password' => $request->password, 'isActive' => 1];
    }


    
    public function showLoginForm(){
     
        return view('login');

    }


}
