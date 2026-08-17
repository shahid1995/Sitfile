<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class ScriptComposer
{

    public function compose(View $view)
    {
        $data['site_meta_keywords'] = "";
        $data['site_meta_description'] = "";
        $data['favicon'] = "";

        $view->with('data', $data);
    }
}