<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Redirect the user to the GitHub authentication page.
     *
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        $user = User::where(['email' => $socialUser->getEmail()])->first();
        if(!$user){
            $user = new User();
            $user->email = $socialUser->getEmail();
            $user->name = $socialUser->getName();
            $user->save();
        }
        $socialAccount = $user->socialAccounts()->where("provider", $provider)->first();
        if(!$socialAccount){
            $socialAccount = new SocialAccount();
            $socialAccount->user_id = $user->id;
            $socialAccount->nickname = $socialUser->nickname;
            $socialAccount->token = $socialUser->token;
            $socialAccount->provider = $provider;
            $socialAccount->provider_id = $socialUser->getId();
        }
        else{
            $socialAccount->token = $socialUser->token;
        }
        $socialAccount->save();
        if(!Auth::check()) {
            Auth::login($user);
        }
        return redirect()->route("posts.index");
    }
}
