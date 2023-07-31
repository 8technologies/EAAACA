<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckDestinationParameter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Perform action
        $redirrectArray = [
            'PUT', 'PATCH', 'POST',
        ];

        if (in_array($request['_method'], $redirrectArray) || in_array($request->method(), $redirrectArray)) {

            $url = request()->headers->get('referer');
            $url_components = parse_url($url);

            // dump( $request );
            // dd( $request->session()->get('errors') );

            if (isset($url_components['query'])) {
                parse_str($url_components['query'], $params);

                if (
                    isset($params['destination']) && 
                    $params['destination'] && 
                    isset($request['_detach_image']) == false && 
                    isset($request['_detach_attachment']) == false && 
                    str_contains($request->getRequestUri(), '/dashboard/layout') == false && 
                    $request->session()->get('errors') == false
                    ) 
                {
                    return redirect($params['destination']);
                }
            }
        }

        return $response;
    }
}
