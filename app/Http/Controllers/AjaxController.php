<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Mail;
use View;
use Image;
use File;
use Storage;
use Twilio;
use App\User;
use Validator;
use App\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Routing\ResponseFactory;


class AjaxController extends Controller{
	
	function sessionlanguage(Request $request){
		$code = $request->input('code');
		session()->put('locale', $code);

		return session()->get('locale');
		//return Redirect::back();
	}

	function addProfileImage(Request $request){
		$id = Auth::user()->id;

		$ValResult = $this->validate_image($request->all());
        $ValErrors = $ValResult->messages();
        if($ValResult->fails()){
            $msg = 'error';
            $data = $ValErrors;
        }else{

	        # upload image
	        if ($request->file('user_image')) {

	        	# delete image from folder
                $existingImage = DB::table('users')->where('id', '=', $id)->first();
                $image_path = public_path('images/upload/profile').'/'.$existingImage->user_image;  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }

	            $file = $request->file('user_image');
	            $filename = time().$file->getClientOriginalName();
	            $extension = $file->getClientOriginalExtension();
	            $upload = $file->move(public_path('images/upload/profile'), $filename);
	        }else{
	            $filename = '';
	        }

	        $data = array(
	          'user_image' =>$filename,
	        );

	        #update data
	        $imageUpdate = DB::table('users')->where('id', '=', $id)->update($data);
	        if($imageUpdate){
	        	$msg = 'success';
	        	$data = url('/')."/public/images/upload/profile/".$filename;
	        }
	    }

	    return response()->json(array(
                    'msg' 	=> $msg,
                    'data'	=> $data
                )); 
        
	}

	# validate image
    protected function validate_image(array $data)
    {
        return  Validator::make($data, [
            'user_image' => 'required|mimes:jpeg,png,jpg,JPG,JPEG,svg|max:2048',
            ]
        );
        
    }

    # admin delete adventure image gallery

    public function deleteAdventureImage(Request $request){
    	# delete image from folder
    	$id = $request->input('id');
    	//dd($request->all());
        $existingImage = DB::table('snor_tour_image_gallery')
                        ->where('id', '=', $id)->select('image_name')
                        ->first();

        $image_path = public_path('images/upload/tours').'/'.$existingImage->image_name;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        #delete from table
        $delete = DB::table('snor_tour_image_gallery')->where('id', '=', $id)->delete();

        if($delete){
        	$msg = 'success';
        }else{
        	$msg = 'failed';
        }

        return response()->json(array(
                    'msg' 	=> $msg,
                ));
    }

    # admin delete adventure image gallery

    public function changeStatus(Request $request){
    	# delete image from folder
    	$rowid = $request->input('rid');
    	$status = $request->input('status');
    	$table = $request->input('dbtable');
    	//dd($request->all());
        #delete from table
        if($status == 'ACTIVE'){
        	$changeStatus = 'INACTIVE';
        }elseif($status == 'INACTIVE'){
        	$changeStatus = 'ACTIVE';
        }

        $statusdata = array(
        	'status'=>$changeStatus,
        );

        $update = DB::table($table)->where('id', '=', $rowid)->update($statusdata);

        if($update){
        	$msg = 'success';
        	$data = $changeStatus;
        }else{
        	$msg = 'failed';
        	$data = '';
        }

        return response()->json(array(
                    'msg' 	=> $msg,
                    'data'	=> $data,
                ));
    }

    # admin delete adventure image gallery

    public function addUserReview(Request $request){
    	# delete image from folder
    	$adventure_id = $request->input('adventure_id');
    	$rating = $request->input('rating');
    	$review = $request->input('review');
    	$user_id = Auth::user()->id;
    	
        #insert from table
        $reviewdata = array(
        	'user_id' => $user_id,
        	'adventure_id' => $adventure_id,
        	'rating' => $rating,
        	'review' => $review,
        	'status'=>'INACTIVE',
        	'created_at'=>date('Y-m-d h:i:s'),
        );

        $saveReview = DB::table('snor_adventure_review')->insert($reviewdata);

        if($saveReview){
        	$msg = 'success';
        	$data = 'Your review has been submitted successfully and waiting for admin approval!';
        }else{
        	$msg = 'failed';
        	$data = 'Somthing went wrong!! Try again.';
        }

        return response()->json(array(
                    'msg' 	=> $msg,
                    'data'	=> $data,
                ));
    }
}
