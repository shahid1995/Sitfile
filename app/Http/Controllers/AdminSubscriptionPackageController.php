<?php namespace App\Http\Controllers;

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
use CRUDBooster;

/*use Session;
use Request;
use DB;
use CRUDBooster;*/

class AdminSubscriptionPackageController extends \crocodicstudio\crudbooster\controllers\CBController
{
    /**
     * Show the form to create a new blog post.
     *
     * @return Response
     */

    public function list()
    {

        if(!CRUDBooster::myId()) {
            Session::flush();
            return redirect()->route('getLogin')->with('message',trans('crudbooster.alert_session_expired'));
        }
        
        $data['packages'] = DB::table('snor_subscription_package as sp')
                            ->join('snor_subscription_package_details as spd', 'sp.id', '=', 'spd.package_id')
                            ->where('spd.lang_id', '=', 1)
                            ->select('sp.*', 'spd.package_title')->get();
        $data['page_title'] = "Subscription Package List";
        return view('admin.subscription_package_list', $data);
    }

    public function create()
    {

        if(!CRUDBooster::myId()) {
            Session::flush();
            return redirect()->route('getLogin')->with('message',trans('crudbooster.alert_session_expired'));
        }
        
        $data['action'] = url('/admin/package/save');
        $data['page_title'] = "Add New Package";
        $data['languages'] = DB::table('language')->get();
        //$this->cbview('post_package_add',$data);
        return view('admin.subscription_package_add_edit', $data);
    }

    public function save(Request $request)
    { 

        //print_r($request->all());die();
        #check validate add
        $ValResult = $this->validate_message_add($request->all());
        $ValErrors = $ValResult->messages();
        if($ValResult->fails()){
            return redirect('admin/package/add')
                ->withErrors($ValErrors)
                ->withInput($request->all());
        }

        # upload image
        if ($request->file('package_image')) {
            $file = $request->file('package_image');
            $filename = time().$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $upload = $file->move(public_path('images/upload'), $filename);
        }else{
            $filename = '';
        }


        # insert into table
        $package_title = $request->input('package_title');

        $data = array(
          'package_amount'         =>$request->input('package_amount'),
          'package_image'          =>$filename,
          'package_billing_cycle'  =>$request->input('package_billing_cycle'),
          'seo_url'                =>str_replace(' ','-',strtolower($package_title[1])),
          'created_at'             => date('Y-m-d H:i:s'),
          'status'                 =>$request->input('status')
        );

        $last_id = DB::table('snor_subscription_package')->insertGetId($data);
        
        if($last_id) {

            # insert into details table
            $package_title = $request->input('package_title');
            $package_description = $request->input('package_description');
            $count = count($request->input('package_title'));
            for($i=1;$i<=$count;$i++){ 
                $data_des = array('package_id'=>$last_id,'lang_id'=>$i,'package_title'=>$package_title[$i],'package_description'=>$package_description[$i]);
                DB::table('snor_subscription_package_details')->insert($data_des);
            }

            Session::flash('success_message', 'Package added successfully!');
            return redirect('admin/package/list');
            
        }else{
            return redirect('admin/package/add')->withErrors(['err_message'=> 'Error in insertion.']);
        }
    }

    public function edit($id)
    { 
        # session expaire redirect to admin login
        if(!CRUDBooster::myId()) {
            Session::flush();
            return redirect()->route('getLogin')->with('message',trans('crudbooster.alert_session_expired'));
        }
        
        $data['action'] = url('/admin/package/update/'.$id);
        $data['page_title'] = "Edit Package";

        # get all edit data
        $data['languages'] = DB::table('language')->get();
        $data['package_details'] = array();
        $data['package_titles'] = array();
        $data['packages'] = DB::table('snor_subscription_package')->where('id', '=', $id)->first();
        $package_details = DB::table('snor_subscription_package_details')->where('package_id', '=', $id)->get();

        foreach ($package_details as $value) {
            $data['package_details'][$value->lang_id] = $value->package_description;
            $data['package_titles'][$value->lang_id] = $value->package_title;
        }

        return view('admin.subscription_package_add_edit', $data);
    }


    public function update(Request $request, $id)
    { 

        //echo $id;die();
        # session expaire redirect to admin login
        if(!CRUDBooster::myId()) {
            Session::flush();
            return redirect()->route('getLogin')->with('message',trans('crudbooster.alert_session_expired'));
        }
        
        
        if($request->input('submit')){
            //print_r($request->all());die();

            $ValResult = $this->validate_message_edit($request->all());
            $ValErrors = $ValResult->messages();
            if($ValResult->fails()){
                return redirect('admin/package/edit/'.$id)
                    ->withErrors($ValErrors)
                    ->withInput($request->all());
            }

            # upload image
            if ($request->file('package_image')) {
                request()->validate([
                    'package_image' => 'image|mimes:jpeg,png,jpg,JPG,JPEG,svg|max:2048',
                ]);

                # delete image from folder
                $packages = DB::table('snor_subscription_package')->where('id', '=', $id)->first();
                $image_path = public_path('images/upload').'/'.$packages->package_image;  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }

                # image upload code
                $file = $request->file('package_image');
                $filename = time().$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $upload = $file->move(public_path('images/upload'), $filename);
            }else{
                $filename = $request->input('exist_package_image');
            }

            #update data array
            $package_title = $request->input('package_title');

            $data = array(
              'package_amount'         =>$request->input('package_amount'),
              'package_image'          =>$filename,
              'package_billing_cycle'  =>$request->input('package_billing_cycle'),
              'seo_url'                =>str_replace(' ','-',strtolower($package_title[1])),
              'updated_at'             => date('Y-m-d H:i:s'),
              'status'                 =>$request->input('status')
            );

            #update data
            $packageUpdate = DB::table('snor_subscription_package')->where('id', '=', $id)->update($data);

            $package_title = $request->input('package_title');
            $package_description = $request->input('package_description');
            $count = count($request->input('package_title'));

            #delete from details table
            DB::table('snor_subscription_package_details')->where('package_id', '=', $id)->delete();
            # and insert new rows

            for($i=1;$i<=$count;$i++){ 
                $data_des = array('package_id'=>$id, 'lang_id'=>$i, 'package_title'=>$package_title[$i], 'package_description'=>$package_description[$i]);
                DB::table('snor_subscription_package_details')->insert($data_des);
            }

            Session::flash('success_message', 'Package updated successfully!');
            return redirect('admin/package/list');

        }

        return view('admin.subscription_package_add_edit', $data);
    }

    public function delete($id){ 

        # delete image from folder
        $packages = DB::table('snor_subscription_package')->where('id', '=', $id)->first();
        $image_path = public_path('images/upload').'/'.$packages->package_image;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        # then delete from tables
        DB::table('snor_subscription_package')->where('id', '=', $id)->delete();
        DB::table('snor_subscription_package_details')->where('package_id', '=', $id)->delete();
        Session::flash('success_message', 'Package deleted successfully!');
        return redirect('admin/package/list');
    }

    # validate banner add
    public function validate_message_add(array $data)
    {

        return  Validator::make($data, [
            'package_amount' => 'required',
            'package_title' => 'required',
            'status' => 'required',
            'package_billing_cycle' => 'required',
            'package_image' => 'image|mimes:jpeg,png,jpg,JPG,JPEG,svg|max:2048',
            ]
        );
        
    }

    # validate banner edit
    public function validate_message_edit(array $data)
    {

        return  Validator::make($data, [
            'package_amount' => 'required',
            'package_title' => 'required',
            'status' => 'required',
            'package_billing_cycle' => 'required',
            'package_image' => 'image|mimes:jpeg,png,jpg,JPG,JPEG,svg|max:2048',
            ]
        );
        
    }
    /*public function validateitinerary_message(array $data){

        return  Validator::make($data, [
            'name' => 'required',
            'price' => 'required|numeric',
            'country' => 'required',
            'state' => 'required',
            'description' => 'required',
            'total_days' => 'required',
            'start_location' => 'required',
            'end_location' => 'required',
            'type' => 'required',
            'theme' => 'required',
            'age' => 'required|integer'
            ],
            ['size'    => 'The :attribute must be exactly :size. digits']
        );        
    }*/

}