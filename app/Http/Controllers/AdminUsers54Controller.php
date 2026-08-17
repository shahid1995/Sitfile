<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use App\User;

	class AdminUsers54Controller extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

	    	if(CRUDBooster::getCurrentRowId())
	    		$this->user = User::findOrFail(CRUDBooster::getCurrentRowId());

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "name";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "users";

			
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"First Name","name"=>"first_name"];
			$this->col[] = ["label"=>"Last Name","name"=>"last_name"];
			$this->col[] = ["label"=>"documents","name"=>"documents",'download'=>true];
			$this->col[] = ["label"=>"Phone No","name"=>"phoneno"];
			$this->col[] = ["label"=>"Email","name"=>"email"];
			$this->col[] = ["label"=>"Status","name"=>"status","callback_php"=>'($row->status==1) ? Active : Inactive'];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			
			$type = 1;
			$new_membertype_id = 'id='.$type;

			$this->form[] = ['label'=>'Role Name','name'=>'roll_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'f_users_roll,roll_name','datatable_where'=>$new_membertype_id];

			$this->form[] = ['label'=>'First Name','name'=>'first_name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];
			$this->form[] = ['label'=>'Last Name','name'=>'last_name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];

			$this->form[] = ['label'=>'Phone No','name'=>'phoneno','type'=>'text','validation'=>'required|integer|min:1|max:255|unique:users','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:255|email|unique:users','width'=>'col-sm-10','placeholder'=>'Please enter a valid email address'];

			

			$this->form[] = ['label'=>'Password','name'=>'password','type'=>'password','validation'=>'min:3|max:32','width'=>'col-sm-10','help'=>'Minimum 5 characters. Please leave empty if you did not change the password.'];

			
			
			
			
			
			if(CRUDBooster::getCurrentMethod() == 'getDetail'){

				$customer_type = $this->user->customer_type;
				if($customer_type==1){

					$customer_type ='Hospital / Nursing Home';

				}elseif($customer_type==2){


					$customer_type ='Diagnostic Centre';
				}
				else{


					$customer_type ='Dental Centre';
				}


				$this->form[] = ['label'=>'Customer Type','type'=>'text','validation'=>'required|min:0|max:1','width'=>'col-sm-10','value'=>$customer_type];

			}else{

				$this->form[] = ['label'=>'Customer Type','name'=>'customer_type','type'=>'select','validation'=>'required|min:0|max:1','width'=>'col-sm-10','dataenum'=>'1|Hospital / Nursing Home;2|Diagnostic Centre;3|Dental Centre'];
			}
			
			
			
			
			
			
			

			$this->form[] = ['label'=>'Medical Establishment Name','name'=>'med_estab_name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'GSTIN','name'=>'gst','type'=>'text','validation'=>'min:3|max:16','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'Address','name'=>'address','type'=>'textarea','validation'=>'required|string|min:3|max:16','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'Pin Code','name'=>'pin_code','type'=>'text','validation'=>'required|string|min:3|max:16','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'City','name'=>'city','type'=>'text','validation'=>'required|string|min:3|max:16','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'State','name'=>'state','type'=>'text','validation'=>'required|string|min:3|max:16','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'Country','name'=>'country','type'=>'text','validation'=>'required|string|min:3|max:16','width'=>'col-sm-10','placeholder'=>''];


			


			if(CRUDBooster::getCurrentMethod() == 'getDetail'){

				$status = $this->user->status;
				if($status==1){

					$status ='Active';

				}else{


					$status ='Inactive';
				}


				$this->form[] = ['label'=>'Status','type'=>'text','validation'=>'required|min:0|max:1','width'=>'col-sm-10','value'=>$status];

			}else{

				$this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','validation'=>'required|min:0|max:1','width'=>'col-sm-10','dataenum'=>'1|Active;0|Inactive'];
			}
			
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Profile Picture","name"=>"profile_picture","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Name","name"=>"name","type"=>"text","required"=>TRUE,"validation"=>"required|string|min:3|max:70","placeholder"=>"You can only enter the letter only"];
			//$this->form[] = ["label"=>"Company Name","name"=>"company_name","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Username","name"=>"username","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Whatsappno","name"=>"whatsappno","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Password","name"=>"password","type"=>"password","required"=>TRUE,"validation"=>"min:3|max:32","help"=>"Minimum 5 characters. Please leave empty if you did not change the password."];
			//$this->form[] = ["label"=>"Email","name"=>"email","type"=>"email","required"=>TRUE,"validation"=>"required|min:1|max:255|email|unique:users","placeholder"=>"Please enter a valid email address"];
			//$this->form[] = ["label"=>"Phoneno","name"=>"phoneno","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Address","name"=>"address","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Other Details","name"=>"other_details","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
			//$this->form[] = ["label"=>"Remember Token","name"=>"remember_token","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Usertoken","name"=>"usertoken","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Active Status","name"=>"active_status","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Roll Id","name"=>"roll_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"roll,id"];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        //$this->sub_module = array();
	        
	        $this->sub_module[] = ['label'=>'Institute details','path'=>'branch87','parent_columns'=>'diagnostic_centre','foreign_key'=>'user_id','button_color'=>'success','button_icon'=>'fa fa-imagee'];
	        $this->sub_module[] = ['label'=>'Equipment List','path'=>'user_equipment_details','parent_columns'=>'first_name','foreign_key'=>'user_id','button_color'=>'success','button_icon'=>'fa fa-imagee'];



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        //$this->addaction = array();

	        $this->addaction[] = ['label'=>'In-active','url'=>CRUDBooster::mainpath('set-status/in-active/[id]'),'icon'=>'fa fa-times','color'=>'danger','showIf'=>"[status] == 1"];
	        $this->addaction[] = ['label'=>'Active','url'=>CRUDBooster::mainpath('set-status/active/[id]'),'icon'=>'fa fa-check','color'=>'success','showIf'=>"[status] == 0"];


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	       
	        $query->where('roll_id','1');
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }


	    public function getSetStatus($status,$id) {
	    	if($status == "active"){
	    		User::withoutGlobalScopes()->where('id',$id)->update(['status'=>1]);
			   	//This will redirect back and gives a message
			   	CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Customer Active !","success");
	    	}
	    	elseif($status == "in-active"){
	    		User::where('id',$id)->update(['status'=>0]);
			   	//This will redirect back and gives a message
			   	CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Customer Inactive !","info");
	    	}
	    	elseif ($status == "approve") {
	    		Category::where('id',$id)->update(['approved'=>1]);
			   	//This will redirect back and gives a message
			   	CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Customer Approved !","success");
	    	}
		}



	    //By the way, you can still create your own method in here... :) 


	}