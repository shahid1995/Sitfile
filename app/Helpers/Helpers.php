<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use DateTime;
use DateInterval;

/**
 * Class Helpers
 * @package App\Helpers
 * Short description for class
 *
 * Locale Helpers
 *
 * 
 */

class Helpers{

	# create unique seo slug
    public static function seoUrls($table, $field, $str)
    {
    	$delimiter = '-';
		$keyword = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));

		$exist_slug = DB::table($table)->where($field, '=', $keyword)->first();

		if($exist_slug){
			$slug = $keyword.'-'.rand();
		}else{
			$slug = $keyword;
		}
        return $slug;
    }

    public function getfieldvalue($table, $field, $cond)
    {
    	$data=DB::table($table)->select($field)->where($cond)->first();
    	return $data->$field;
    }
    
    public static function getProfilePercentage($profile)
    {
        $maximumPoints  = 100;
        $point = 0;
        
        if (!empty($profile)) {
            //foreach($profile_array as $profile)
                $point+= ($profile->client_type != '')? 5:0;
                $point+= ($profile->hospital != '')? 5:0;
                $point+= ($profile->diagnostic_centre != '')? 5:0;
                $point+= ($profile->dental_centre != '')? 5:0;
                $point+= ($profile->medical_establishment != '')? 5:0;
                $point+= ($profile->nabh_nabl_accredited != '')? 5:0;
                $point+= ($profile->gstin != '')? 5:0;
                $point+= ($profile->pincode != '')? 5:0;
                $point+= ($profile->country != '')? 5:0;
                $point+= ($profile->city != '')? 5:0;
                $point+= ($profile->state != '')? 5:0;
                $point+= ($profile->address != '')? 5:0;
                $point+= ($profile->status != '')? 5:0;
                $point+= ($profile->last_qa_test != '')? 5:0;
                $point+= ($profile->equipment_type != '')? 5:0;
                $point+= ($profile->manufacturer != '')? 5:0;
                $point+= ($profile->model != '')? 5:0;
                $point+= ($profile->serial_no != '')? 5:0;
                $point+= ($profile->branch != '')? 5:0;
                $point+= ($profile->name != '')? 5:0;
        }
        else{
            $point = 0;
        }
        $percentage = ($point*$maximumPoints)/100;
        return $percentage. "%";
    }
    
    public static function getExpireyByDate($exp_date, $nabh)
    {
        $start_date = new DateTime();
        $end_date = new DateTime($exp_date);
        /*if($nabh==0)
        {
            $end_date->add(new DateInterval('P2Y'));
        }*/
        
        //$end_date->add(new DateInterval('P1Y'));
        
        $difference = $start_date->diff($end_date);
        $result='';
        if(($difference->y)>0)
            $result .= $difference->y . ' Years ';
        if(($difference->m)>0)
            $result .= $difference->m .' Months ';
        
        $result .= $difference->d .' Days';
        
        return $result;
    }

}
