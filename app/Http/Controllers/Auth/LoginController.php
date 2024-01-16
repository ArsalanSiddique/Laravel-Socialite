<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
        // return Socialite::driver('google')->stateless()->user();
    }

    public function handleGoogleCallback()
    {
        try {

            $user       = Socialite::driver('google')->stateless()->user();
            $finduser   = User::where('google_provider_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {
                $finduser   = User::where('email', $user->getEmail())->first();
                if ($finduser) {

                    $finduser->google_provider_id = $user->getId();
                    // $newUser->avatar            = $user->getAvatar();
                    $finduser->update();

                    Auth::login($finduser);
                } else {

                    $newUser                        = new User;
                    $newUser->google_provider_id    = $user->getId();
                    $newUser->name                  = $user->getName();
                    $newUser->email                 = $user->getEmail();
                    $newUser->email_verified_at     = now();
                    // $newUser->avatar            = $user->getAvatar();
                    $newUser->save();

                    Auth::login($newUser);
                }
            }
        } catch (Exception $e) {
            return redirect('auth/google');
        }

        return redirect('/home');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {

            $user       = Socialite::driver('facebook')->stateless()->user();
            $finduser   = User::where('facebook_provider_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {


                $finduser   = User::where('email', $user->getEmail())->first();
                if ($finduser) {

                    $finduser->facebook_provider_id = $user->getId();
                    // $newUser->avatar            = $user->getAvatar();
                    $finduser->update();

                    Auth::login($finduser);
                } else {

                    $newUser                        = new User;
                    $newUser->facebook_provider_id  = $user->getId();
                    $newUser->name                  = $user->getName();
                    $newUser->email                 = $user->getEmail();
                    $newUser->email_verified_at     = now();
                    // $newUser->avatar            = $user->getAvatar();
                    $newUser->save();

                    Auth::login($newUser);
                }

            }
        } catch (Exception $e) {
            return redirect('auth/facebook');
        }

        return redirect('/home');
    }

    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {

            $user       = Socialite::driver('github')->stateless()->user();
            $finduser   = User::where('github_provider_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {


                $finduser   = User::where('email', $user->getEmail())->first();
                if ($finduser) {

                    $finduser->github_provider_id   = $user->getId();
                    // $newUser->avatar            = $user->getAvatar();
                    $finduser->update();

                    Auth::login($finduser);
                } else {

                    $newUser                        = new User;
                    $newUser->github_provider_id    = $user->getId();
                    $newUser->name                  = $user->getName();
                    $newUser->email                 = $user->getEmail();
                    $newUser->email_verified_at     = now();
                    // $newUser->avatar            = $user->getAvatar();
                    $newUser->save();

                    Auth::login($newUser);
                }

            }
        } catch (Exception $e) {
            return redirect('auth/github');
        }

        return redirect('/home');
    }
}
