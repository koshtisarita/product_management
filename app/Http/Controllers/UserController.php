<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use Log;
use Hash;
use Auth;

class UserController extends Controller
{
    public function redirectToProvider($driver)
    {
        
        return Socialite::driver($driver)->redirect();
    } 
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
            
     
            $finduser = User::where('google_id', $user->id)->first();
     
            if($finduser){
     
                Auth::login($finduser);
                Log::info($finduser);   
                return redirect('/dashboard');
     
            }else{

                $newUser = new User();
                    $newUser->name = $user->name; 
                    $newUser->email = $user->email; 
                    $newUser->password = encrypt('123456dummy');
                    $newUser->google_id = $user->id; 
                    $newUser->save(); 
                
                
                Auth::login($newUser); 
                Log::info($newUser);    
                return redirect('/dashboard');
            }
    
        } catch (Exception $e) {
            Log::info($e->getMessage());    
            return redirect()->back()->with('error',$e->getMessage());
            // dd($e->getMessage());
        }
    }
}
