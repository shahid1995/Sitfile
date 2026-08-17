<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Config;

/**
 * Class Language
 * @package App\Http\Middleware
 * Short description for class
 *
 * Locale Middleware
 *
 * 
 */

class Language
{
    /**
     * Allowed languages
     * @var array
     */
    protected $languages = ['en', 'no'];


    /**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(Session::has('locale'))
	    {
	       $locale = Session::get('locale', Config::get('app.locale'));
	    }else{
	       $locale = 'en';
	    }

	    App()->setLocale($locale);

	    return $next($request);
	}
}
