<?php
		
		namespace App\Http\Controllers;
		use App\Http\Controllers\Controller;
		use Mail;
		use View;
		use Image;
		//use Intervention\Image\ImageManagerStatic as Image;
		use File;
		use Storage;
		use Twilio;
		use App\User;
		use Validator;
		use App\Frontend;
		use Illuminate\Http\Request;
		//use Request;
		use Illuminate\Support\Facades\DB;
		use Illuminate\Support\Facades\URL;
		use Illuminate\Support\Facades\Auth;
		use Illuminate\Support\Facades\Input;
		use Illuminate\Support\Facades\Session;
		use Srmklive\PayPal\Services\ExpressCheckout;
		use Helper;
		use CRUDBooster;

	class AdminUserController extends \crocodicstudio\crudbooster\controllers\CBController {
		#view user with add
		public function viewuser(){
			if(!CRUDBooster::myId()) {
				Session::flush();
				return redirect()->route('getLogin')->with('message',trans('crudbooster.alert_session_expired'));
			}
			$data=array();
				$data['all_active_users']=DB::table('users')
								->select('users.id','users.name','users.age','sa_package.title','sa_user_transaction.created_at')
								->join('sa_user_transaction','users.id','=','sa_user_transaction.user_id')
								->join('sa_package','sa_user_transaction.package_id','=','sa_package.id')
								->where("sa_user_transaction.status",1)
								 ->paginate(20);
							 
			return view('admin.user.user_list_view', $data);
		}
		#search
		public function search(){
			if(!CRUDBooster::myId()) {
				Session::flush();
				return redirect()->route('getLogin')->with('message',trans('crudbooster.alert_session_expired'));
			}
			$search_text = $_GET['q'];
			$query = DB::table('users');
			$query->select('users.id','users.name','users.age','sa_package.title','sa_user_transaction.created_at');
			$query->join('sa_user_transaction','users.id','=','sa_user_transaction.user_id');
			$query->join('sa_package','sa_user_transaction.package_id','=','sa_package.id');
			$query->where("sa_user_transaction.status",1);
			if ($search_text != '') {
				$query->where(function ($query) use ($search_text){ 
						return  $query->where('users.name', 'like', '%' . $search_text . '%')
								->orWhere('users.age', 'like', '%' . $search_text . '%')
								->orWhere('sa_package.title', 'like', '%' . $search_text . '%')
								->orWhere('sa_user_transaction.created_at', 'like', '%' . $search_text . '%');
					});
			}
			
			$data['all_active_users'] = $query->paginate(20);
								
			return view('admin.user.user_list_view', $data);
		}
		#user details
		public function userDetails($id=null){
			if(!CRUDBooster::myId()) {
				Session::flush();
				return redirect()->route('getLogin')->with('message',trans('crudbooster.alert_session_expired'));
			}
			$id=base64_decode($id);
			
			$data['users_details']=DB::table('users')
								->select('users.id','users.age','users.name','users.health_details','users.email','users.phoneno','users.gender','sa_package.title','sa_package.price','sa_package.duration','sa_user_transaction.created_at')
								->join('sa_user_transaction','users.id','=','sa_user_transaction.user_id')
								->join('sa_package','sa_user_transaction.package_id','=','sa_package.id')
								->where("users.id",$id)
								->first();
				$data['food_allergies']=DB::table('sa_food_allergies')
								->select('sa_food_allergies.id','sa_food_allergies.name')
								->where("user_id",$id)
								->where("status",1)
								->get();				
			return view('admin.user.user_details', $data);
		}
	
}