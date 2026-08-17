<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

class HeaderloginComposer
{

    public function compose(View $view)
    {
		  $data=array();
        $view->with('data', $data);
    }
}