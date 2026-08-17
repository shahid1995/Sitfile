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
use Helper;

/*use Session;
use Request;
use DB;
use CRUDBooster;*/

class AdminStaticPageController extends \crocodicstudio\crudbooster\controllers\CBController
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
        
        // DB::enableQueryLog();

        # for search
        if($request->input('q')){
            $search = $request->input('q');
            /*$data['pages'] = DB::table('static_page as sp')
                            ->leftJoin('static_page_details as spd', 'sp.id', '=', 'spd.page_id')
                            ->where('spd.lang_id', '=', 1)
                            ->where(function ($query) use ($search){
                                $query->where('spd.page_title', 'LIKE', '%'.$search.'%')
                                      ->orWhere('spd.page_content', 'LIKE', '%'.$search.'%');
                            })
                            ->select('sp.*', 'spd.page_title','spd.page_content')->orderBy('sp.id', 'desc')->paginate(10);*/

            $data['pages'] = DB::table('static_page')->orderBy('meta_title', 'asc')->where('meta_title', 'LIKE', '%'.$search.'%')->paginate(10);

            $data['pages']->appends(['q' => $search]); // next page with serach and pagination

        }else{
            /*$data['pages'] = DB::table('static_page as sp')
                            ->join('static_page_details as spd', 'sp.id', '=', 'spd.page_id')
                            ->where('spd.lang_id', '=', 1)
                            ->select('sp.*', 'spd.page_title')->orderBy('sp.id', 'desc')->paginate(10);*/
            $data['pages'] = DB::table('static_page')->orderBy('meta_title', 'asc')->paginate(10);
        }
        /*$data['categories'] = DB::table('snor_adventure_category as ac')
                            ->join('snor_adventure_category_details as acd', 'ac.id', '=', 'acd.category_id')
                            ->where('acd.lang_id', '=', 1)
                            ->select('ac.*', 'acd.category_title')->get();*/

        // dd(DB::getQueryLog());

        // dd($data['pages'][4]->);

        $data['page_title'] = "CMS page List";
        return view('admin.static_page_list', $data);
    }

    public function create()
    {

        if(!CRUDBooster::myId()) {
            Session::flush();
            return redirect()->route('getLogin')->with('message',trans('crudbooster.alert_session_expired'));
        }
        
        $data['action'] = url('/admin/staticpage/save');
        $data['page_title'] = "Add New Page";
        $data['languages'] = DB::table('language')->get();
        //$this->cbview('post_package_add',$data);
        return view('admin.static_page_add_edit', $data);
    }

    public function save(Request $request)
    { 

        //print_r($request->all());die();
        #check validate add
        $ValResult = $this->validate_message_add($request->all());
        $ValErrors = $ValResult->messages();
        if($ValResult->fails()){
            return redirect('admin/staticpage/add')
                ->withErrors($ValErrors)
                ->withInput($request->all());
        }

        # insert into table
        $page_title = $request->input('page_title');
        
        # generate unique seo slaug
        $slug = Helper::seoUrls('static_page','seo_url',$page_title[1]); // db name, field_name, keyword
        # generate unique seo slaug

        $data = array(
          'meta_title'              =>$request->input('meta_title'),
          'meta_keywords'           =>$request->input('meta_keywords'),
          'meta_description'        =>$request->input('meta_description'),
          //'seo_url'                 =>str_replace(' ','-',strtolower($page_title[1])),
          'seo_url'                 =>$slug,
          'created_at'              =>date('Y-m-d H:i:s'),
          'status'                  =>$request->input('status')
        );

        $last_id = DB::table('static_page')->insertGetId($data);
        
        if($last_id) {

            # insert into details table
            $page_content = $request->input('page_content');
            // $count = count($request->input('page_title'));
            
            $data_des = array('page_id'=>$last_id,'lang_id'=>1,'page_title'=>$page_title,'page_content'=>$page_content);
            DB::table('static_page_details')->insert($data_des);
            

            Session::flash('success_message', 'Page added successfully!');
            return redirect('admin/staticpage/list');
            
        }else{
            return redirect('admin/staticpage/add')->withErrors(['err_message'=> 'Error in insertion.']);
        }
    }

    public function edit($id)
    { 
        # session expaire redirect to admin login
        if(!CRUDBooster::myId()) {
            Session::flush();
            return redirect()->route('getLogin')->with('message',trans('crudbooster.alert_session_expired'));
        }
        
        $data['action'] = url('/admin/staticpage/update/'.$id);
        $data['page_title'] = "Edit Page";

        # get all edit data
        $data['languages'] = DB::table('language')->get();
        $data['page_details'] = array();
        $data['page_titles'] = array();
        $data['pages'] = DB::table('static_page')->where('id', '=', $id)->first();
        $data['page_details'] = DB::table('static_page_details')->where('page_id', '=', $id)->first();

        /*foreach ($page_details as $value) {
            $data['page_details'][$value->lang_id] = $value->page_content;
            $data['page_titles'][$value->lang_id] = $value->page_title;
        }*/

        //dd($data['page_details']);

        return view('admin.static_page_add_edit', $data);
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
                return redirect('admin/staticpage/edit/'.$id)
                    ->withErrors($ValErrors)
                    ->withInput($request->all());
            }

            #update data array
            $page_title = $request->input('page_title');
            
            $data = array(
              'meta_title'              =>$request->input('meta_title'),
              'meta_keywords'           =>$request->input('meta_keywords'),
              'meta_description'        =>$request->input('meta_description'),
              //'seo_url'                 =>str_replace(' ','-',strtolower($page_title[1])),
              'updated_at'              =>date('Y-m-d H:i:s'),
              'status'                  =>$request->input('status')
            );

            #update data
            $pageUpdate = DB::table('static_page')->where('id', '=', $id)->update($data);

            $page_content = $request->input('page_content');
            $count = count(array($request->input('page_title')));

           // dd($page_content);

            #delete from details table
            DB::table('static_page_details')->where('page_id', '=', $id)->delete();
            # and insert new rows

            
                $data_des = array('page_id'=>$id, 'lang_id'=>'1', 'page_title'=>$page_title, 'page_content'=>$page_content);
                DB::table('static_page_details')->insert($data_des);
            

            Session::flash('success_message', 'Page updated successfully!');
            return redirect('admin/staticpage/list');

        }

        return view('admin.static_page_add_edit', $data);
    }

    public function delete($id){ 

        # then delete from tables
        DB::table('static_page')->where('id', '=', $id)->delete();
        DB::table('static_page_details')->where('page_id', '=', $id)->delete();
        Session::flash('success_message', 'Page deleted successfully!');
        return redirect('admin/staticpage/list');
    }

    # validate add
    public function validate_message_add(array $data)
    {

        return  Validator::make($data, [
            'page_title' => 'required',
            'meta_title' => 'required',
            'status' => 'required',
            ]
        );
        
    }

    # validate edit
    public function validate_message_edit(array $data)
    {

        return  Validator::make($data, [
            'page_title' => 'required',
            'meta_title' => 'required',
            'status' => 'required',
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