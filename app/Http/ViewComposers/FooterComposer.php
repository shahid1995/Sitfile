<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FooterComposer
{
    public function compose(View $view)
    {
        /*$data['logo'] = "";
        $data['site_name'] = "";
        $data['site_address'] = "";
        $data['site_email_id'] = "";
        $data['site_phone'] = "";
        $data['facebook_link'] = "";
        $data['twitter_link'] = "";
        $data['google_plus_link'] = "";
        $data['youtube_link'] = "";
        $data['site_additional_address'] = "";
        $data['site_additional_phone'] = "";
        $data['copyright'] = "";
        $settings = DB::table('cms_settings')->get();
        if($settings && count($settings) > 0) {
            foreach($settings as $setting){ 
                if($setting->name == 'logo') {
                    $data['logo'] = url('/')."/public/".$setting->content;
                }
                if($setting->name == 'site_name') {
                    $data['site_name'] = $setting->content;
                }
                if($setting->name == 'site_address') {
                    $data['site_address'] = $setting->content;
                }
                if($setting->name == 'site_email_id') {
                    $data['site_email_id'] = $setting->content;
                }
                if($setting->name == 'site_phone') {
                    $data['site_phone'] = $setting->content;
                }
                if($setting->name == 'facebook_link') {
                    $data['facebook_link'] = $setting->content;
                }
                if($setting->name == 'twitter_link') {
                    $data['twitter_link'] = $setting->content;
                }
                if($setting->name == 'google_plus_link') {
                    $data['google_plus_link'] = $setting->content;
                }
                if($setting->name == 'youtube_link') {
                    $data['youtube_link'] = $setting->content;
                }
                if($setting->name == 'ppinterest_link') {
                    $data['pinterest_link'] = $setting->content;
                }
                if($setting->name == 'site_additional_address') {
                    $data['site_additional_address'] = $setting->content;
                }
                if($setting->name == 'site_additional_phone') {
                    $data['site_additional_phone'] = $setting->content;
                }
                if($setting->name == 'copyright') {
                    $data['copyright'] = $setting->content;
                }
            }
        }*/

        //=========cms pages links=============
        # get session language code
        if(Session::has('locale')){
            $session_lang_code = Session::get('locale');
        }else{
            $session_lang_code = 'en';
        }

        $language_id = DB::table('language')->where('language_code', '=', $session_lang_code)->select('id')->first();
        $data['sess_language_id'] = $language_id->id;
        # get session language code

        $languages = DB::table('language')->get();
        $data['languages'] = $languages;
        $data['session_lang_code'] = $session_lang_code;

        $data['cms_links'] = DB::table('static_page as sp')
                            ->leftJoin('static_page_details as spd', 'sp.id', '=', 'spd.page_id')
                            ->where('spd.lang_id', '=', $data['sess_language_id'])
                            ->where('sp.status', '=', 'ACTIVE')
                            ->select('sp.seo_url', 'spd.page_title')->get();
        //=========cms pages links=============

        $view->with('data', $data);
    }
}