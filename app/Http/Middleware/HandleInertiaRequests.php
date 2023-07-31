<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Modules\Block\Entities\Block;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Auth;
use Nwidart\Modules\Facades\Module;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => function () use ($request) {
                $user = null;

                if ($request->user()) {
                    $user = User::with(
                        'roles',
                        'permissions',
                    )->findOrFail($request->user()->id);
                }
                return $user;

                // return [
                //     'user' => $user,
                // ];
            },
            'flash' => function () use ($request) {
                return [
                    'status' => $request->session()->get('status'),
                    'success' => $request->session()->get('success'),
                    'message' => $request->session()->get('message'),
                    'error' => $request->session()->get('error'),
                ];
            },
            'app' => function () use ($request) {
                return [
                    'name' => config('app.name'),
                    'name_short' => env('APP_NAME_SHORT'),
                    'tagline' => env('APP_TAGLINE'),
                    'description' => env('APP_DESCRIPTION'),
                    'year' => date('Y'),
                ];
            },
            'route' => function () use ($request) {
                $route = $request->route()->getName();
                $routeName = (strpos($route, 'show') ? 'detailed-page ' : '') . str_replace('.', '-', $route);

                return [
                    'name' => $routeName,
                ];
            },
            'metatags' => function () {
                return [
                    'title' => SEOMeta::getTitle(),
                    'description' => SEOMeta::getDescription(),
                    'keywords' => SEOMeta::getKeywords(),
                ];

                return SEOMeta::generate();
            },

            'permissions' => function () {
                if (Auth::user()) {
                    return Auth::user()->getAllPermissions()->pluck('name');
                }
            },

            'blocks' => function () use ($request) {
                // Get blocks that are visible on current path
                $routeName = $request->route()->getName();
                $blocks = null;

                if (Module::collections()->has('Block')) {
                    if ($routeName == 'front') {
                        $blocks = Block::where('show_on_pages', '<front>', $routeName)
                            ->orWhere('show_on_pages', '=', 'front')
                            ->orWhere('show_on_pages', '=', '*')
                            ->get();
                    } else {
                        $blocks = Block::where('show_on_pages', '=', $routeName)
                            ->orWhere('show_on_pages', '*')
                            ->get();
                    }
                }

                return $blocks;
            },
        ]);
    }
}
