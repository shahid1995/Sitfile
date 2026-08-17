<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public function init_elements(){
		//$data["head"] =  $this->init_head();
	//	$data["nav_mobile"] = $this->init_nav();
		$data["header"] = $this->init_header();
		
		$data["footer"] = $this->init_footer();
		$data["scriptBase"] = $this->init_scriptBase();

		return $data;
	}
	protected function init_head(){
		return View::make('partial.head');
	}
	protected function init_nav(){
		return View::make('partial.nav_mobile');
	}
	protected function init_header(){
		
		
	}
	
	protected function init_footer(){
		return View::make('partial.footer');	
	}
	protected function init_scriptBase(){
		return View::make('partial.scripts');	
	}

}