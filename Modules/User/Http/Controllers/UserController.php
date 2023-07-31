<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
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

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', User::class)) {
            return response(['message' => 'You are not authorized to access this page'], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/User/Index', []);
        }
    }

    /**
     * Get resource listing from the database.
     *
     * @return \$data
     */
    public function getData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : '25';
        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data = User::with('roles', 'media', 'organization', 'organization.member_state')
                ->filter($request->all())
                ->search($query)
                ->orderBy($sort_by, $sort_type)
                ->paginate($limit)
                ->withQueryString();

        $data->each(function($model) {
            $model->append(['thumbnail', 'entity_permissions']);
        });

        return $data;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function indexContactPoint(Request $request)
    {
        // Provide the role id
        $request['role'] = 3;

        if ($request->user()->cannot('viewAny', User::class)) {
            return response(['message' => 'You are not authorized to access this page'], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/User/IndexContactPoint', []);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', User::class)) {
            return response(['message' => 'You are not authorized to add a new item'], 403);
        }

        $data = [];
        $data['system_roles'] = Role::get()->toArray();

        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/User/Create', ['data' => $data]);
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', User::class)) {
            return response(['message' => 'You are not authorized to add a new item'], 403);
        }

        $input = $request->all();
        $input['password'] = 'password';
        $input['password_confirmation'] = 'password';
        $input['terms'] = true;

        // Validate results
        Validator::make($input, [
            'name' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'password' => ['required'],
        ])->validate();

        $newUser = new CreateNewUser();
        $user = $newUser->create($input);
        $user->updateRelatedEntities($request);

        // Notifications
        $entity = $user;
        $statusText = 'User "' . $entity['name'] . '" has been created';

        // Notify account owner
        Notification::send($user, new NewAccountCreatedNotifyUser($entity));
        // Notify Administrators
        Notification::send(getAdministrators(), new NewAccountCreatedNotifyAdmins($entity));

        if(checkAjaxJsonRequest($request))
        {
            return response($user)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $entity = User::with('roles', 'media', 'organization')->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => 'You are not authorized to view this item'], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/User/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $user = User::with('roles', 'organization')->findOrFail($id);

        if ($request->user()->cannot('update', $user)) {
            return response(['message' => 'You are not authorized to update this item'], 403);
        }

        $system_roles = Role::get()->toArray();
        $user['system_roles'] = $system_roles;

        if(checkAjaxJsonRequest($request))
        {
            return $user;
        }
        return Inertia::render('Core/User/Edit', ['data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = User::findOrFail($id);
        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => 'You are not authorized to update this item'], 403);
        }

        $data = $request->all();

        if ($request->has('_detach_image')) {
            $entity->updateRelatedEntities($request);
        } else {
            // Validate results
            Validator::make($data, [
                'name' => ['required', 'min:3', 'max:30'],
                'roles' => ['required'],
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
    public function updateVerified(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->user()->cannot('update', $user)) {
            return response(['message' => 'You are not authorized to update this item'], 403);
        }

        $data = $request->only('email_verified_at', 'notify_user');

        if (!$data['email_verified_at']) {
            $data['email_verified_at'] = now();
        }
        // Validate results
        Validator::make($data, [
            'email_verified_at' => ['required'],
        ])->validate();
        
        $user->fill($data)->save();

        // Notifications
        
        $entity = $user;
        if ($data['notify_user'] == 1) {
            // Notify account owner
            Notification::send($user, new AccountVerifiedNotifyUser($entity));
            // Notify Administrators
            Notification::send(getAdministrators(), new AccountVerifiedNotifyAdmins($entity));
        }

        $statusText = 'User "' . $user['name'] . '" has been verified';
        if(checkAjaxJsonRequest($request))
        {
            return response($user)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Manualy Verify User.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateEnabled(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->user()->cannot('update', $user)) {
            return response(['message' => 'You are not authorized to update this item'], 403);
        }

        $data = $request->only('enabled', 'notify_user');
        // Validate results
        $ValidationStatus = Validator::make($data, [
            'enabled' => ['required'],
        ])->validate();
        
        $user->fill($data)->save();

        // Notifications
        
        $entity = $user;
        if ($data['notify_user'] == 1) {
            if (!$user->enabled) {
                // Notify account owner
                Notification::send($user, new AccountDisabledNotifyAdmins($entity));
                // Notify Administrators
                Notification::send(getAdministrators(), new AccountDisabledNotifyUser($entity));
            } else if ($user->enabled) {
                // Notify account owner
                Notification::send($user, new AccountEnabledNotifyUser($entity));
                // Notify Administrators
                Notification::send(getAdministrators(), new AccountEnabledNotifyAdmins($entity));
            }
        }

        $statusText = 'User "' . $user['name'] . '" has been enabled';
        if(checkAjaxJsonRequest($request))
        {
            return response($user)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Manualy Verify User.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->user()->cannot('update', $user)) {
            return response(['message' => 'You are not authorized to update this item'], 403);
        }

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
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, User $user)
    {
        $entity = $user;

        if ($request->user()->cannot('delete', $user)) {
            return response(['message' => 'You are not authorized to delete this item'], 403);
        }

        $statusText = 'User "' . $entity['name'] . '" has been deleted';
        $user->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }






    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editProfile(Request $request, $id)
    {
        $user = User::with(
            'media',
            // 'user_profile',
            // 'employee.office',
            // 'employee.organization',
        )->findOrFail($id);

        if ($request->user()->cannot('update', $user)) {
            return response(['message' => 'You are not authorized to update this item'], 403);
        }

        // dd( $profile );

        if(checkAjaxJsonRequest($request))
        {
            return $user;
        }
        return Inertia::render('Core/User/EditProfile', ['data' => $user]);
    }

    /**
     * Update Profile.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->user()->cannot('update', $user)) {
            return response(['message' => 'You are not authorized to update this item'], 403);
        }

        $data = $request->all();
        // Validate results
        Validator::make($data, [
            'designation' => ['required'],
            'telephone_number' => ['required'],
            'personal_email' => ['required'],
        ])->validate();
        
        $user->fill($data)->save();

        $statusText = 'User "' . $user['name'] . '" profile has been updated';
        if(checkAjaxJsonRequest($request))
        {
            return response($user)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }
}
