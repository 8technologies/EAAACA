<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Laravel\Jetstream\Jetstream;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Modules\User\Entities\UserProfile;
use Modules\User\Notifications\{
    NewAccountCreatedNotifyAdmins,
    NewAccountCreatedNotifyUser,
    ProfileUpdatedNotifyAdmins,
    ProfileUpdatedNotifyUser,
    AccountDisabledNotifyAdmins,
    AccountDisabledNotifyUser,
    AccountEnabledNotifyAdmins,
    AccountEnabledNotifyUser,
    AccountVerifiedNotifyAdmins,
    AccountVerifiedNotifyUser,
    PasswordResetLinkSentNotifyUser,
    PasswordResetNotifyAdmins,
    PasswordResetNotifyUser
};

class UserProfileController extends Controller
{
    /**
     * Show the general profile settings screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function show(Request $request)
    {
        $data = User::with(
            'roles',
            // 'user_profile',
            'organization',
            'organization.member_state',

            // 'contact_points',
            // 'contact_points.organization',
            // 'contact_points.organization.member_state',
            // 'organizations',
            // 'organizations.member_state',
        )->findOrFail(Auth::user()->id);
        
        $data['sessions'] = $this->sessions($request)->all();

        return Inertia::render('Core/User/ShowMyProfile', ['data' => $data]);
    }

    public function messages(Request $request)
    {
        return Jetstream::inertia()->render($request, 'Core/User/IndexMyMessages', [
            'sessions' => $this->sessions($request)->all(),
        ]);
    }
    public function notifications(Request $request)
    {
        $data = [];
        return Inertia::render('Core/User/IndexMyNotifications', ['data' => $data]);
    }
    public function teams(Request $request)
    {
        $data = [];
        return Inertia::render('Core/User/IndexMyTeams', ['data' => $data]);
    }

    public function files(Request $request)
    {
        $data = [];
        return Inertia::render('Core/User/IndexMyFiles', ['data' => $data]);
    }

    public function browserSessions(Request $request)
    {
        if(checkAjaxJsonRequest($request))
        {
            $data = $this->sessions($request)->all();
            return $data;
        } else {
            return Inertia::render('Core/User/IndexMySessions', [
                'sessions' => $this->sessions($request)->all(),
            ]);
        }
    }

    /**
     * Get the current sessions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function sessions(Request $request)
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                    ->where('user_id', $request->user()->getAuthIdentifier())
                    ->orderBy('last_activity', 'desc')
                    ->get()
        )->map(function ($session) use ($request) {
            $agent = $this->createAgent($session);

            return (object) [
                'agent' => [
                    'is_desktop' => $agent->isDesktop(),
                    'platform' => $agent->platform(),
                    'browser' => $agent->browser(),
                ],
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === $request->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    /**
     * Create a new agent instance from the given session.
     *
     * @param  mixed  $session
     * @return \Jenssegers\Agent\Agent
     */
    protected function createAgent($session)
    {
        return tap(new Agent, function ($agent) use ($session) {
            $agent->setUserAgent($session->user_agent);
        });
    }





    /**
     * Delete the other browser session records from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function logoutFromOtherDevices(Request $request)
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
            ->where('user_id', $request->user()->getAuthIdentifier())
            ->where('id', '!=', $request->session()->getId())
            ->delete();
        
        $statusText = 'You have been logged out from other devices';
        $user = Auth::user();
        
        if(checkAjaxJsonRequest($request))
        {
            return response($user)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }





    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function accountEdit(Request $request)
    {
        $user = User::with(
            'organization',
            'organization.member_state',
        )
        ->findOrFail(Auth::user()->id);

        if(checkAjaxJsonRequest($request))
        {
            return $user;
        }
        return Inertia::render('Core/User/EditAccount', ['data' => $user]);
    }

        /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function accountUpdate(Request $request)
    {
        $entity = Auth::user();

        $data = $request->all();

        if ($request->has('_detach_image')) {
            $entity->updateRelatedEntities($request);
        } else {
            // Validate results
            Validator::make($data, [
                'name' => ['required', 'min:3', 'max:30'],
            ])->validate();

            $entity->fill($data)->save();
            $entity->updateRelatedEntities($request);
        }

        // Notifications
        $statusText = 'User "' . $entity['name'] . '" has been updated';    

        // Notify account owner
        Notification::send($entity, new ProfileUpdatedNotifyUser($entity));
        // Notify Administrators
        Notification::send(getAdministrators(), new ProfileUpdatedNotifyAdmins($entity));

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }




    /**
     * Manualy Verify User.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function AccountUpdatePassword(Request $request)
    {
        $user = Auth::user();

        $data = $request->only('passwordoptions', 'notify_user');
        
        if ($data['passwordoptions'] == 'sendresetlink') {
            $status = Password::sendResetLink(
                ['email' => $user->email]
            );

            $entity = $user;
            if ($data['notify_user'] == 1) {
                // Notify account owner
                Notification::send($user, new PasswordResetLinkSentNotifyUser($entity));
            }

            return $status === Password::RESET_LINK_SENT
                ? back()->with(['success' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        }

        if ($data['passwordoptions'] == 'generatenew') {
            $password = Str::random(8);

            $user->forceFill([
                'password' => Hash::make($password)
            ]);
            
            $user->save();

            $entity = $user;
            if ($data['notify_user'] == 1) {
                // Notify account owner
                Notification::send($user, new PasswordResetNotifyUser($entity));
                // Notify Administrators
                Notification::send(getAdministrators(), new PasswordResetNotifyAdmins($entity));
            }

            return Redirect::back()->with(['success' => 'Password reset successfully. New password is "' . $password . '"']);
        }
        
        // $user->fill($data)->save();

        // if(checkAjaxJsonRequest($request))
        // {
        //     return $user;
        // }
        // return Redirect::back()->with('success', 'User Password Updated');
    }







    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function accountEditProfile(Request $request)
    {
        $entity = User::
        // ->
        findOrFail(Auth::user()->id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => 'You are not authorized to update this item'], 403);
        }

        // $profile = $user->user_profile;

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/User/EditAccountProfile', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function accountUpdateProfile(Request $request)
    {
        // $entity = UserProfile::where('user_id', Auth::user()->id)->first();
        $entity = Auth::user();

        $data = $request->all();

        // // Validate results
        // Validator::make($data, [
        //     'first_name' => ['required'],
        //     'other_names' => ['required'],
        // ])->validate();
        
        $entity->fill($data)->save();
        $statusText = 'Your profile has been updated';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }
}
