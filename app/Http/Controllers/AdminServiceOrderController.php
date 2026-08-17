<?php namespace App\Http\Controllers;

	use Session;
	//use Request;
	use DB;
	use CRUDBooster;
	use Illuminate\Http\Request;

	class AdminServiceOrderController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = false;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "service_order";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Invoice No","name"=>"invoice_no"];
			$this->col[] = ["label"=>"Total Amount","name"=>"total_amount"];
			$this->col[] = ["label"=>"Date","name"=>"created_at"];
			$this->col[] = ["label"=>"Payment","name"=>"status","callback_php"=>'($row->status==0) ? Pending :  "Done"'];
			$this->col[] = ["label"=>"User Name","name"=>"user_id","join"=>"users,first_name"];
			$this->col[] = ["label"=>"Name of Agency","name"=>"assign_provider","join"=>"users,first_name"];
			$this->col[] = ["label"=>"Order Status","name"=>"order_status"];
			$this->col[] = ["label"=>"Open Service","name"=>"open_service","callback_php"=>'($row->open_service==0) ? Pending :  "Accepted"'];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Invoice No','name'=>'invoice_no','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Total Amount','name'=>'total_amount','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'User Id','name'=>'user_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'user,id'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Accept Job','name'=>'accept_job','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Is Baccepted','name'=>'is_bid_accepted','type'=>'radio','validation'=>'required|integer','width'=>'col-sm-10','dataenum'=>'Array'];
			$this->form[] = ['label'=>'Is Reschedule','name'=>'is_reschedule','type'=>'radio','validation'=>'required|integer','width'=>'col-sm-10','dataenum'=>'Array'];
			$this->form[] = ['label'=>'Active Offer','name'=>'active_offer','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Offer Price','name'=>'offer_price','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Is Negotiation','name'=>'is_negotiation','type'=>'radio','validation'=>'required|integer','width'=>'col-sm-10','dataenum'=>'Array'];
			$this->form[] = ['label'=>'Service Order','name'=>'service_order','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Invoice No','name'=>'invoice_no','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Total Amount','name'=>'total_amount','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'User Id','name'=>'user_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'user,id'];
			//$this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Accept Job','name'=>'accept_job','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Is Baccepted','name'=>'is_bid_accepted','type'=>'radio','validation'=>'required|integer','width'=>'col-sm-10','dataenum'=>'Array'];
			//$this->form[] = ['label'=>'Is Reschedule','name'=>'is_reschedule','type'=>'radio','validation'=>'required|integer','width'=>'col-sm-10','dataenum'=>'Array'];
			//$this->form[] = ['label'=>'Active Offer','name'=>'active_offer','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Offer Price','name'=>'offer_price','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Is Negotiation','name'=>'is_negotiation','type'=>'radio','validation'=>'required|integer','width'=>'col-sm-10','dataenum'=>'Array'];
			//$this->form[] = ['label'=>'Service Order','name'=>'service_order','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
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
	        
	        $this->sub_module[] = ['label'=>'Equipment','path'=>'service_order_equipment_services','parent_columns'=>'title','foreign_key'=>'order_id','button_color'=>'success','button_icon'=>''];
	        $this->sub_module[] = ['label'=>'Bid Request','path'=>'offer_prices','parent_columns'=>'title','foreign_key'=>'order_id','button_color'=>'success','button_icon'=>'']; 
	        //$this->sub_module[] = ['label'=>'Assign Provider','path'=>'service_assign_provider','parent_columns'=>'title','foreign_key'=>'service_id','button_color'=>'success','button_icon'=>'']; 


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

            $this->addaction[] = ['label'=>'Open Service','url'=>CRUDBooster::mainpath('set-status/1/[id]/[order_id]'),'icon'=>'fa fa-check','color'=>'success','showIf'=>"[open_service]=='0'"];
            $this->addaction[] = ['label'=>'Assign Provider','url'=>CRUDBooster::mainpath('set-status/assign/[id]'),'icon'=>'fa fa-check','color'=>'success','showIf'=>"[status]=='1'"];
            $this->addaction[] = ['label'=>'Customer Details','url'=>CRUDBooster::mainpath('set-status/c_details/[user_id]'),'icon'=>'fa fa-check','color'=>'success'];
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
	        //Your code here
	            
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
	        
	      
          /* DB::table('bid_report')->where('bid_id',$id)->update(['status'=>$status]);
           if($status==1)
           {
               DB::table('service_order_equipment_services')->where('order_id',$order_id)->update(['is_bid_accepted'=>1]);
           }else{
               DB::table('service_order_equipment_services')->where('order_id',$order_id)->update(['is_bid_accepted'=>0]);
           }
           
           //This will redirect back and gives a message
           
        */
        
        if($status =="assign"){
            
            $id = $id;
            
            $user_details = DB::table('users')->where('roll_id',2)->get();
            
            $service_order = DB::table('service_order')->where('id',$id)->first();
            
            
            
        	
        	 $values = explode(";",$service_order->assign_provider);
        	
        	//var_dump($values);
        	
        	foreach($user_details as $key=>$user_details_data){
        	   
        	 
        	    if(in_array($user_details_data->id, $values)){
        	        
        	       $user_details[$key]->checked = 1; 
        	        
        	    }else{
        	        
        	         $user_details[$key]->checked = 0; 
        	    }
        	}
            
            
            
          //dd($user_details);
            
           return $this->cbView('cbview.assignuser',compact('user_details','id')); 
            
        }elseif($status==1){
            
            
            DB::table('service_order')->where('id',$id)->update(['open_service'=>1]);
            
        }elseif($status=='c_details'){
            
            $user_details = DB::table('users')->where('id',$id)->first();
            
            //dd($user_details);
            
           return $this->cbView('cbview.userdetails',compact('user_details')); 
        }
        
        
        
        CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Service Opened Successfully !","info");

    }
    
   
   		function storeditassign(Request $request, $id) {
        
        
        
        $user_id = $request->input('user_id');
        
        
        if($user_id ) :
        $user_id         = implode(';', $user_id);
        
        endif;
        
        
        
       

        $status = DB::table('service_order')
                ->where('id', $id)
                ->limit(1)  
                ->update(
                    array(
                        
                        'assign_provider' =>  $user_id,
                      
                        )
                    );

                //echo $status;
                
                
                CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Successfully Update !","success");
                
               
            }
   
   

	    //By the way, you can still create your own method in here... :) 


	}