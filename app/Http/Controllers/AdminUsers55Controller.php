<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use App\User;
	use Mail;

	class AdminUsers55Controller extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->col[] = ["label"=>"Name","name"=>"name"];
			//$this->col[] = ["label"=>"Company Name","name"=>"company_name"];
			$this->col[] = ["label"=>"Document","name"=>"documents","download"=>true];
			$this->col[] = ["label"=>"Phone No","name"=>"phoneno"];
			$this->col[] = ["label"=>"Email","name"=>"email"];
			$this->col[] = ["label"=>"Approved","name"=>"active_status","callback_php"=>'($row->active_status==1) ? Approved : Pending'];
			$this->col[] = ["label"=>"Status","name"=>"status","callback_php"=>'($row->status==1) ? Active : Inactive'];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			
			$type = 2;
			$new_membertype_id = 'id='.$type;
			$this->form = [];

			$this->form[] = ['label'=>'Role Name','name'=>'roll_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'f_users_roll,roll_name','datatable_where'=>$new_membertype_id];

			$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];

			$this->form[] = ['label'=>'Phone No','name'=>'phoneno','type'=>'text','validation'=>'required|integer|min:1|max:255|unique:users','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Profile Picture','name'=>'profile_picture','type'=>'upload','validation'=>'required|min:1|max:255||mimes:jpeg,jpg,png','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Documents','name'=>'documents','type'=>'upload','validation'=>'mimes:pdf,docx,doc','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:255|email|unique:users','width'=>'col-sm-10','placeholder'=>'Please enter a valid email address'];

			$this->form[] = ['label'=>'Password','name'=>'password','type'=>'password','validation'=>'min:3|max:32','width'=>'col-sm-10','help'=>'Minimum 5 characters. Please leave empty if you did not change the password.'];

			$this->form[] = ['label'=>'Company Name','name'=>'company_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'GSTIN','name'=>'gst','type'=>'text','validation'=>'min:3|max:16','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'Address','name'=>'address','type'=>'textarea','validation'=>'required|string|min:3|max:16','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'Pin Code','name'=>'pin_code','type'=>'text','validation'=>'required|string|min:3|max:16','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'City','name'=>'city','type'=>'text','validation'=>'required|string|min:3|max:16','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'State','name'=>'state','type'=>'text','validation'=>'required|string|min:3|max:16','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'Number of Service Engineer/RSO','name'=>'country','type'=>'text','validation'=>'required|min:1','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'Name of Service Engineer/RSO','name'=>'country','type'=>'text','validation'=>'required|string|min:3|max:16','width'=>'col-sm-10','placeholder'=>''];

			$this->form[] = ['label'=>'Remarks','name'=>'remarks','type'=>'text','validation'=>'string|min:3|max:16','width'=>'col-sm-10','placeholder'=>'Anything you want to say'];

			$this->form[] = ['label'=>'AERB Authorisation Letter','name'=>'auth_letter','type'=>'upload','validation'=>'required|min:1|max:255||mimes:jpeg,jpg,png,pdf','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Service Engineer/RSO Certificate','name'=>'rso_certificate','type'=>'upload','validation'=>'required|mimes:jpeg,jpg,png','width'=>'col-sm-10'];
			
			/*$this->form[] = ['label'=>'Company Name','name'=>'company_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];*/
			/*$this->form[] = ['label'=>'Username','name'=>'username','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];*/
			/*$this->form[] = ['label'=>'Whatsappno','name'=>'whatsappno','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];*/			
			
			
			//$this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','validation'=>'required|min:0|max:1','width'=>'col-sm-10','dataenum'=>'1|Active;0|Deactive'];


			if(CRUDBooster::getCurrentMethod() == 'getDetail'){

				$status = $this->user->status;
				if($status==1){

					$status ='Active';

				}else if($status==0){


					$status ='Deactive';
				}else{
					$status ='Rejected';
				}


				$this->form[] = ['label'=>'Status','type'=>'text','validation'=>'required|min:0|max:1','width'=>'col-sm-10','value'=>$status];



			}else{

				$this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','validation'=>'required|min:0|max:1','width'=>'col-sm-10','dataenum'=>'1|Active;0|Deactive'];
			}
			//$this->form[] = ['label'=>'Active Status','name'=>'active_status','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			
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
	        
	        $this->sub_module[] = ['label'=>'Equipment List','path'=>'provider_equipments','parent_columns'=>'name','foreign_key'=>'user_id','button_color'=>'success','button_icon'=>'fa fa-imagee'];
            $this->sub_module[] = ['label'=>'Bank Details','path'=>'bank_account_details94	','parent_columns'=>'name','foreign_key'=>'user_id','button_color'=>'success','button_icon'=>'fa fa-imagee'];


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
	        //Approved action
	        $this->addaction[] = ['label'=>'Approve','url'=>CRUDBooster::mainpath('set-status/approve/[id]'),'icon'=>'fa fa-check','color'=>'success','showIf'=>"[active_status] == 0"];
	        //Reject action
	        $this->addaction[] = ['label'=>'Reject','url'=>CRUDBooster::mainpath('set-status/reject/[id]'),'icon'=>'fa fa-check','color'=>'warning','showIf'=>"[active_status] == 0"];
	        $this->addaction[] = ['label'=>'Rejected', 'url'=>'javascript:void(0)', 'color'=>'danger','showIf'=>"[active_status]==2"];

	        $this->addaction[] = ['label'=>'Service List','url'=>CRUDBooster::mainpath('set-detail-view/[id]'),'icon'=>'fa fa-eye','color'=>'primary'];



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
	       
	        $query->where('roll_id','2');
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
			   	CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Service Provider Active !","success");
	    	}
	    	elseif($status == "in-active"){
	    		User::where('id',$id)->update(['status'=>0]);
			   	//This will redirect back and gives a message
			   	CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Service Provider Inactive !","info");
	    	}
	    	elseif ($status == "approve") {
	    		User::where('id',$id)->update(['active_status'=>1]);
	    		$user = User::where('id',$id)->first();


	    		$data = array('name'=>"Altibbe");
			      /*Mail::send('mail',['name',$user->name],function($message){
					    $message->to($user->email)->subject("Thank you for registration");
					    $message->from($user->email,'Welcome');
					});*/
			   	//This will redirect back and gives a message
			   	CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Service Provider Approved !","success");
	    	}
	    	elseif ($status == "reject") {
	    		User::where('id',$id)->update(['active_status'=>2, 'status'=>2]);
			   	//This will redirect back and gives a message
			   	CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Service Provider Approved !","success");
	    	}
		}

		public function getSetDetailView($id)
		{
			$data = array();
			$m_data = array();
			$s_data = array();
			$user_name = DB::table('users')->where('id',$id)->first();
			$data['page_title'] = 'Services List For: '.$user_name->name;
			$data['machine_service_type'] = DB::table('sp_machine_service_type as mst')
                                        ->select('mst.id','mst.service_type','mmt.id as mt_id','mmt.machine_type','mmt.image')
                                        ->join('manage_machine_type as mmt','mmt.id','=','mst.service_type')
                                        ->where('mst.user_id','=',$id)->get();
	        $data['service_types'] = DB::table('sp_service_type as st')
	                                        ->select('st.id','st.service','s.service_name')
	                                        ->join('services as s','s.id','=','st.service')
	                                        ->where('st.user_id','=',$id)->get();

			$this->cbView('adminservicelist',$data);
		}



	    //By the way, you can still create your own method in here... :) 


	}