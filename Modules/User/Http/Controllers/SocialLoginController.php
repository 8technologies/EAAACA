<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Notification;
use Modules\User\Notifications\NewAccountCreatedNotifyAdmins;
use Modules\User\Notifications\NewAccountCreatedNotifyUser;

class SocialLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected $providers = [
        'github','facebook','google','twitter'
    ];

    public function show()
    {
        return view('auth.login');
    }

    public function redirectToProvider($driver)
    {
        if( ! $this->isProviderAllowed($driver) ) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }
  
    public function handleProviderCallback( $driver )
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check for email in returned user
        return empty( $user->email )
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }

    protected function sendSuccessResponse()
    {
        return redirect()->route('dashboard')->with('success', 'Logged in Successfully');
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('social.login')
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    protected function loginOrCreateAccount($providerUser, $driver)
    {
        // check for already has account
        $user = User::where('email', $providerUser->getEmail())->first();

        // if user already found
        if( $user ) {
            // update the avatar and provider that might have changed
            $user->update([
                'profile_photo_path' => $providerUser->avatar,
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
        } else {
            // create a new user

            // temp password
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $password = Hash::make(substr(str_shuffle($chars), 0, 8));

            $user = User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'email_verified_at'=> now(),
                'profile_photo_path' => $providerUser->getAvatar(),
                'provider' => $driver,
                'provider_id' => $providerUser->getId(),
                'access_token' => $providerUser->token,
                // user can use reset password to create a password
                'password'=> $password,
            ]);

            // Notifications
            $entity = $user; 

            // Notify account owner
            Notification::send($user, new NewAccountCreatedNotifyUser($entity));
            // Notify Administrators
            Notification::send(getAdministrators(), new NewAccountCreatedNotifyAdmins($entity));

            return redirect()->route('login')
                ->withSuccess('An account has been created successfully!')
                ->withMessage('Your Account is pending approval. You will been notified once enabled');
        }

        // login the user
        Auth::login($user, true);

        return $this->sendSuccessResponse();
    }

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}