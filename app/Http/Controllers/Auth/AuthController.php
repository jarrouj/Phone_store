<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Container\Attributes\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login_page()
    {
        return view('Auth.login');
    }

    public function register_page()
    {
        return view('Auth.register');
    }

    public function login(Request $request)
    {
        try {
            $email    = $request->email;
            $password = $request->password;

            if (Auth::attempt(compact('email', 'password'))) {
                $user         = Auth::user();
                $access_token = $user->createToken('authToken')->plainTextToken;

                // Save the access token in the session
                // We can also save token in local storage
                session(['access_token' => $access_token]);

                // Redirect based on user type
                if ($user->usertype == 1) {
                    return redirect('/admin');
                } else {
                    return redirect('/');
                }
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => "Invalid Username or Password"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function register(RegisterRequest $request)
    {
        try {
            $user = new User();

            $user->name  = $request->name;
            $user->address = $request->address;
            $user->phone   = $request->phone;
            $user->email   = $request->email;
            $user->password = bcrypt($request->password);
            $user->password_confirmation = bcrypt($request->password_confirmation);

            $user->save();

            $access_token = $user->createToken('authToken')->plainTextToken;

            session(['access_token' => $access_token]);

            return redirect('/');
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e
            ], 500);
        }
    }

    public function reset_password() {}

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        try{
            $SocialUser = Socialite::driver($provider)->user();
            // dd($SocialUser);

            if(User::where('email' , $SocialUser->getEmail())->exists()){
                return redirect('/login')->withErrors(['email' => 'This email uses different method to login.' ]);
            }

            $user = User::where([
                'provider' => $provider,
                 'provider_id' => $SocialUser->id,
            ])->first();

            if(!$user){
                $nickname = $SocialUser->nickname ?? $SocialUser->name;


                // If both nickname and name are null, generate a random username
                if (is_null($nickname)) {
                    $nickname = Str::lower(Str::random(8));
                }


                $user = User::create([
                    'name' => $nickname,
                    'email' => $SocialUser->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $SocialUser->getId(),
                    'provider_token' => $SocialUser->token,
                    'email_verified_at' => now()
                ]);

                Auth::login($user);
                return redirect('/');
            }
        }catch(\Exception $e){
            return redirect('/login');
        }

    }
}
