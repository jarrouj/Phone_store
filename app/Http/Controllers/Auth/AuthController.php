<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;
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
                $request->session()->regenerate(); // Regenerate session to prevent fixation attacks
                $user = Auth::user();
                $access_token = $user->createToken('authToken')->plainTextToken;

                session(['token' => $access_token]);

                // Redirect based on user type
                return $user->usertype == 1 ? redirect('/admin') : redirect('/');
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => "Invalid Username or Password"
                ]);
            }
        } catch (\Exception $e) {
            // return response()->json([
            //     'status'  => false,
            //     'message' => $e->getMessage()
            // ], 500);
            return view('404');
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
            // return response()->json([
            //     'status'  => false,
            //     'message' => $e
            // ], 500);
            return view('404');
        }
    }
    public function logout(Request $request)
    {
        try {
            // Check if the user is authenticated

                $user = Auth::user();

                // Revoke the user's current access token

                // Log out the user
                Auth::logout();

                // Remove the access token from the session


            Session::flush();

            Session::forget('token');
            Session::save();

            // Respond with success
            return redirect('/');
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
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
        try {
            // Retrieve the user information from the provider
            $SocialUser = Socialite::driver($provider)->user();

            // Check if the user already exists in the database
            $user = User::where('provider', $provider)
                        ->where('provider_id', $SocialUser->id)
                        ->orWhere('email', $SocialUser->getEmail()) 
                        ->first();

            if ($user) {
                // If user exists, log them in
                Auth::login($user);
            } else {
                // If user does not exist, create a new user
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
                    'email_verified_at' => now(),
                ]);

                Auth::login($user);
            }

            return redirect('/');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Login failed, please try again.']);
        }
    }

}
