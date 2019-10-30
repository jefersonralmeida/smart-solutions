<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    protected $availableProviders = ['google', 'facebook'];

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
     * @param string $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider(string $provider)
    {
        if (!in_array($provider, $this->availableProviders)) {
            throw new NotFoundHttpException();
        }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback(string $provider)
    {
        /** @var SocialiteUser $user */
        $socialiteUser = Socialite::driver($provider)->user();

        // check if the email is already registered (we're good trusting that the provider is giving us the correct email)
        // for a more fancy way of validation, we could use the social provider/id
        $user = User::where(['email' => $socialiteUser->getEmail()])->first();
        if ($user === null) {

            // user don't exists, try to register!
            try {
                $user = new User();
                $user->name = $socialiteUser->getName();
                $user->email = $socialiteUser->getEmail();
                $user->social_provider = $provider;
                $user->social_id = $socialiteUser->getId();
                $user->password = 'invalidpassword';
                $user->save();
            } catch (\Throwable $e) {
                return response('Falha ao criar o usuário. Tente outra forma de registro', 400);
            }

        }

        // logs the user in
        Auth::guard()->login($user);

        // go to the profile
        return redirect('/profile');
    }
}
