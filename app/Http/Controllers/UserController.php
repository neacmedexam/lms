<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class UserController extends Controller
{
    //

    public function showLogin(){
     
            return view('login');
    
        
    }

    public function authenticate(Request $request){
     
        if (Auth::check()) {
            return redirect()->home();
        }
        
        $form = $request->validate([
            'email' => ['required','email'],
            'password' => 'required',
          
        ]); 

   
       
        if(auth()->attempt($form)){
            
            $request->session()->regenerate();
            if(auth()->user()->userType == 2){
                
                return redirect('/viewinquiries');
            }
            elseif(auth()->user()->userType == 4){
                
                return redirect('/events/viewevents');
            }
            else{
                return redirect('/home');
                
            }
        }

 
        return back()->withErrors(['email' => 'Incorrect email or password. Please try again.'])->onlyInput('email');
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // return redirect('/')->with('message','You have successfully logged out.');
        return redirect('/');
    }
}
