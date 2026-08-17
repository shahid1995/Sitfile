<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserleftComposer
{
    public function compose(View $view)
    {

        # get session language code
        if(Session::has('locale')){
            $session_lang_code = Session::get('locale');
        }else{
            $session_lang_code = 'en';
        }

        $language_id = DB::table('language')->where('language_code', '=', $session_lang_code)->select('id')->first();
        $data['sess_language_id'] = $language_id->id;
        # get session language code

        $data['userleft'] = DB::table('users')
                            ->where('id', '=', Auth::user()->id)
                            ->first();
        
        //=========cms pages links=============

        $view->with('data', $data);
    }
}