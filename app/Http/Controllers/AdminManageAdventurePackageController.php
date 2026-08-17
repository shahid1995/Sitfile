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

class AdminManageAdventurePackageController extends \crocodicstudio\crudbooster\controllers\CBController
{
    /**
     * Show the form to create a new blog post.
     *
     * @return Response
     */

    public function list(Request $request)
    {

        if(!CRUDBooster::myId()) {
            Session::flush();
            return redirect()->route('getLogin')->with('message',trans('crudbooster.alert_session_expired'));
        }
        
        //DB::enableQueryLog();

        # for search
        if($request->input('q')){
            $search = $request->input('q');
            /*$data['pages'] = DB::table('snor_static_page as sp')
                            ->leftJoin('snor_static_page_details as spd', 'sp.id', '=', 'spd.page_id')
                            ->where('spd.lang_id', '=', 1)
                            ->where(function ($query) use ($search){
                                $query->where('spd.page_title', 'LIKE', '%'.$search.'%')
                                      ->orWhere('spd.page_content', 'LIKE', '%'.$search.'%');
                            })
                            ->select('sp.*', 'spd.page_title','spd.page_content')->orderBy('sp.id', 'desc')->paginate(10);*/
            # get package details
            $data['adventures'] = DB::table('snor_add_tour_package as atp')
                            ->leftJoin('users as us', 'atp.user_id', '=', 'us.id')
                            ->leftJoin('snor_add_tour_package_details as tpd', 'atp.id', '=', 'tpd.tour_id')
                            ->where('tpd.lang_id', '=', 1)
                            ->where(function ($query) use ($search){
                                $query->where('tpd.tour_name', 'LIKE', '%'.$search.'%')
                                      ->orWhere('tpd.description', 'LIKE', '%'.$search.'%')
                                      ->orWhere('tpd.details_description', 'LIKE', '%'.$search.'%');
                            })
                            ->select('atp.*','us.last_name','us.first_name','tpd.tour_name')
                            ->orderBy('atp.id', 'desc')->paginate(10);


            $data['adventures']->appends(['q' => $search]); // next page with serach and pagination

        }else{
            $data['adventures'] = DB::table('snor_add_tour_package as atp')
                            ->leftJoin('users as us', 'atp.user_id', '=', 'us.id')
                            ->leftJoin('snor_add_tour_package_details as tpd', 'atp.id', '=', 'tpd.tour_id')
                            ->where('tpd.lang_id', '=', 1)
                            ->select('atp.*','us.last_name','us.first_name','tpd.tour_name')
                            ->orderBy('atp.id', 'desc')->paginate(10);
        }
        
        $data['page_title'] = "Manage Adventure";
        return view('admin.manage_adventure_list', $data);
    }

    public function edit(Request $request, $id)
    { 

        # session expaire redirect to admin login
        if(!CRUDBooster::myId()) {
            Session::flush();
            return redirect()->route('getLogin')->with('message',trans('crudbooster.alert_session_expired'));
        }

        # get all languages
        $data['languages'] = DB::table('language')->get();

        # get all location for dropdown
        $data['locations'] = DB::table('snor_adventure_location as al')
                            ->join('snor_adventure_location_details as ald', 'al.id', '=', 'ald.location_id')
                            ->where('ald.lang_id', '=', 1)
                            ->where('al.status', '=', 'ACTIVE')
                            ->select('al.*', 'al.location')->orderBy('al.id', 'desc')->get();

        # get all categories for dropdown
        $data['categories'] = DB::table('snor_adventure_category as ac')
                            ->join('snor_adventure_category_details as acd', 'ac.id', '=', 'acd.category_id')
                            ->where('acd.lang_id', '=', 1)
                            ->where('ac.status', '=', 'ACTIVE')
                            ->select('ac.id', 'acd.category_title')->orderBy('ac.id', 'desc')->get();
        //dd($data);
        # get all package inclusion
        $data['inclusions'] = DB::table('snor_package_inclusion_master')
                            ->where('status', '=', 'ACTIVE')
                            ->select('*')->get();

        # get package details
        $data['adventure'] = DB::table('snor_add_tour_package as atp')
                            ->join('users as us', 'atp.user_id', '=', 'us.id')
                            ->where('atp.id', '=', $id)
                            ->select('atp.*','us.last_name','us.first_name')
                            ->first();

        $adventures_details = DB::table('snor_add_tour_package_details')->where('tour_id', '=', $id)->get();
        $adventure_inclusion = DB::table('snor_tour_package_inclusion')->where('tour_id', '=', $id)->get();

        # set tour name, details array
        foreach ($adventures_details as $value) {
            $data['tour_name'][$value->lang_id] = $value->tour_name;
            $data['description'][$value->lang_id] = $value->description;
            $data['details_description'][$value->lang_id] = $value->details_description;
        }

        # set tour inclusion array
        foreach ($adventure_inclusion as $value) {
            $data['tours_inclusion'][] = $value->inclusion_id;
        }

        
        if($request->input('update')){
            //dd($request->all());die();
            #check validate add
            $ValResult = $this->validate_adventure_edit($request->all());
            $ValErrors = $ValResult->messages();
            if($ValResult->fails()){
                return redirect('admin/manage-adventure-package/edit/'.$id)
                    ->withErrors($ValErrors)
                    ->withInput($request->all());
            }

            //dd($request->all());die();
            # insert into table
            $tour_name = $request->input('adventure_name');

            # generate unique seo slaug
            //$slug = Helper::seoUrls('snor_add_tour_package','seo_url',$tour_name[1]);
            # generate unique seo slaug

            $postdata = array(
              //'user_id'              =>Auth::user()->id,
              'location_id'          =>$request->input('location_id'),
              'category_id'          =>$request->input('adventure_category'),
              //'seo_url'              =>$slug,
              'total_days_stay'      =>$request->input('total_days_stay'),
              'tour_start_date'      =>date('Y-m-d',strtotime($request->input('tour_start_date'))),
              'person_capacity'      =>$request->input('person_capacity'),
              'price_per_person'     =>$request->input('package_price'),
              //'tour_image'           =>$filename,
              'updated_at'           =>date('Y-m-d H:i:s'),
              'status'               =>$request->input('status')
            );

            DB::table('snor_add_tour_package')->where('id', '=', $id)->update($postdata);
            
            //if($last_id) {

            # first delete previos details from snor_add_tour_package_details and then insert into tour details table

            #delete from details table
            DB::table('snor_add_tour_package_details')->where('tour_id', '=', $id)->delete();

            # and insert new rows
            $tour_name = $request->input('adventure_name');
            $description = $request->input('description');
            $details_description = $request->input('details_description');
            $count = count($request->input('adventure_name'));
            for($i=1;$i<=$count;$i++){ 
                $data_description = array('tour_id'=>$id,'lang_id'=>$i,'tour_name'=>$tour_name[$i],'description'=>$description[$i],'details_description'=>$details_description[$i]);
                DB::table('snor_add_tour_package_details')->insert($data_description);
            }

            #delete package inclusion details
            DB::table('snor_tour_package_inclusion')->where('tour_id', '=', $id)->delete();

            # insert package inclution details table
            if($request->input('package_inclusion')){
                $package_inclusion = $request->input('package_inclusion');
                $count = count($request->input('package_inclusion'));
                for($i=0;$i<$count;$i++){ 
                    $data_inclusion = array('tour_id'=>$id,'inclusion_id'=>$package_inclusion[$i]);
                    DB::table('snor_tour_package_inclusion')->insert($data_inclusion);
                }
            }

            Session::flash('success_message', 'Adventure details updated successfully!');
            return redirect('admin/manage-adventure-package/list');
                
        }

        return view('admin.manage_adventure_edit', $data);
    }

    public function delete($id){ 

        # then delete from tables

        DB::table('snor_add_tour_package')->where('id', '=', $id)->delete();
        DB::table('snor_add_tour_package_details')->where('tour_id', '=', $id)->delete();
        DB::table('snor_tour_package_inclusion')->where('tour_id', '=', $id)->delete();
        DB::table('snor_tour_image_gallery')->where('tour_id', '=', $id)->delete();
        DB::table('snor_adventure_review')->where('adventure_id', '=', $id)->delete();

        Session::flash('success_message', 'Adventure deleted successfully!');

        return redirect('admin/manage-adventure-package/list');
    }

    # manage package image data
    public function imageData(Request $request, $id){ 

        # then delete from tables
        $data['page_title'] = 'Adventure Images';
        $data['tour_image'] = DB::table('snor_add_tour_package')->where('id', '=', $id)->select('id','tour_image')
                            ->first();

        $data['image_gallery'] = DB::table('snor_tour_image_gallery')
                                ->where('tour_id', '=', $id)->select('id','image_name')
                                ->get();

        # upload tour image
        if($request->input('add_image')){
            $validator = Validator::make($request->all(), [
                'tour_image' => 'required|image|mimes:jpeg,png,jpg,JPG,JPEG',
                ]
            );

            $ValErrors = $validator->messages();
            if($validator->fails()){
                return redirect('admin/manage-adventure-package/image/'.$id)
                    ->withErrors($ValErrors)
                    ->withInput($request->all());
            }

            # delete image from folder
            $image_path = public_path('images/upload/tours').'/'.$data['tour_image']->tour_image;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            # image upload code
            $file = $request->file('tour_image');
            $filename = rand().time().$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $upload = $file->move(public_path('images/upload/tours'), $filename);

            #update table snor_add_tour_package
            if($upload){
                $imageData = array(
                    'tour_image' => $filename,
                );
                DB::table('snor_add_tour_package')->where('id', '=', $id)->update($imageData);

                Session::flash('success_message', 'Tour image updated successfully!');

                return redirect('admin/manage-adventure-package/list');
            }
        }

        # upload image gallery
        if($request->input('add_gallery')){
            //dd($request->all());
            $gvalidator = Validator::make($request->all(), [
                'tour_image_gallery' => 'required',
                'tour_image_gallery.*' => 'image|mimes:jpeg,png,jpg,JPG,JPEG',
                ]
            );

            $GValErrors = $gvalidator->messages();
            //dd($GValErrors);
            if($gvalidator->fails()){
                return redirect('admin/manage-adventure-package/image/'.$id)
                    ->withErrors($GValErrors)
                    ->withInput($request->all());
            }

            # image upload code
            $gallery = array();
            if($request->file('tour_image_gallery')){
                $files = $request->file('tour_image_gallery');
                foreach($files as $file){ 
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $picture = rand().time().$filename;
                    $destinationPath = base_path() . '/public/images/upload/tours';
                    $file->move($destinationPath, $picture);
                    $gallery[] = $picture;
                }
                # insert gallery table rows
                if (!empty($gallery)) {      
                    foreach($gallery as $image) {
                        $imagearr = array('tour_id'=>$id,'image_name' =>$image);
                        DB::table('snor_tour_image_gallery')->insert($imagearr);
                    }
                }

                Session::flash('success_message', 'Gallery image added successfully!');

                return redirect('admin/manage-adventure-package/list');
            }
        }

        return view('admin.manage_adventure_images', $data);
    }

    # validate edit
    public function validate_adventure_edit(array $data)
    {

        return  Validator::make($data, [
            'location_id' => 'required',
            'adventure_category' => 'required',
            'total_days_stay' => 'required|numeric',
            'tour_start_date' => 'required',
            'person_capacity' => 'required|numeric',
            'package_inclusion' => 'required|array|min:1',
            'package_price' => 'required|numeric',
            'adventure_name.*' => 'required|string',
            'description.*' => 'required|string',
            'details_description.*' => 'required|string',
            'status' => 'required',
            ]
        );
        
    }

    //======================manage adventure reviews====================
    public function reviewList(Request $request, $adventure_id){

        if($request->input('q')){
            $search = $request->input('q');
            $data['reviews'] = DB::table('snor_adventure_review as ar')
                            ->leftjoin('snor_add_tour_package_details as tpd', 'tpd.tour_id','=','ar.adventure_id')
                            ->leftjoin('users as us', 'ar.user_id', '=', 'us.id')
                            ->where('tpd.lang_id', '=', 1)
                            ->where(function ($query) use ($search){
                                $query->where('ar.review', 'LIKE', '%'.$search.'%')
                                      ->orWhere('us.first_name', 'LIKE', '%'.$search.'%')
                                      ->orWhere('us.last_name', 'LIKE', '%'.$search.'%');
                            })
                            ->where('ar.adventure_id', '=', $adventure_id)
                            ->select('ar.*','us.last_name','us.first_name','tpd.tour_name')
                            ->orderBy('ar.id', 'desc')->paginate(10);


            $data['reviews']->appends(['q' => $search]); // next page with serach and pagination

        }else{
            $data['reviews'] = DB::table('snor_adventure_review as ar')
                            ->leftjoin('snor_add_tour_package_details as tpd', 'tpd.tour_id','=','ar.adventure_id')
                            ->leftjoin('users as us', 'ar.user_id', '=', 'us.id')
                            ->where('tpd.lang_id', '=', 1)
                            ->where('ar.adventure_id', '=', $adventure_id)
                            ->select('ar.*','us.last_name','us.first_name','tpd.tour_name')
                            ->orderBy('ar.id', 'desc')->paginate(10);
        }

        $data['adventure_id'] = $adventure_id;
        $data['page_title'] = 'Review Lists';

        return view('admin.manage_adventure_reviews', $data);
    }

    #delete reviews
    public function deleteReview($id){ 

        # then delete from tables
        DB::table('snor_adventure_review')->where('id', '=', $id)->delete();

        Session::flash('success_message', 'Review deleted successfully!');

        return redirect('admin/manage-adventure-package/reviews/'.$id);
    }
    //======================manage adventure reviews====================
    
}