<!-- First, extends to the CRUDBooster Layout -->
@push('head')
<link rel='stylesheet' href="{{asset('vendor/crudbooster/assets/select2/dist/css/select2.min.css')}}"/>
<style type="text/css">
  .select2-container--default .select2-selection--single {border-radius: 0px !important}
        .select2-container .select2-selection--single {height: 35px}
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
          background-color: #3c8dbc !important;
          border-color: #367fa9 !important;
          color: #fff !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
          color: #fff !important;
        }
</style>
<link rel="stylesheet" type="text/css" href="{{asset('vendor/crudbooster/assets/summernote/summernote.css')}}">
@endpush
@push('bottom')
<script type="text/javascript" src="{{asset('vendor/crudbooster/assets/summernote/summernote.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
@endpush
@extends('crudbooster::admin_template')
@section('content')
@if(CRUDBooster::getCurrentMethod() != 'getProfile' && $button_cancel)
@if(g('return_url'))
<p><a title='Return' href='{{g("return_url")}}'><i class='fa fa-chevron-circle-left '></i>
  &nbsp; {{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>
  @else
  <p><a title='Main Module' href='{{CRUDBooster::mainpath()}}'><i class='fa fa-chevron-circle-left '></i>
    &nbsp; {{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>
    @endif
    @endif
    <!-- Your html goes here -->
    <div class="panel panel-default">
     <div class="panel-heading">
       <strong><i class="fa fa-th-list"></i> Property Edit</strong>
     </div> 

     <div class="panel-body" id="parent-form-area" style="padding:20px 0px 0px 0px;">

      <form method="post" class="form-horizontal" action="<?php echo URL::to('/');?>/admin/assign/edit-save/<?php echo $id;?>" enctype='multipart/form-data'>
        <div class="box-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" >   
            <input type="hidden" name="order_id" value="{{$id}}" >   
           
         
             
            <div class="form-group header-group-0 " id="form-group-external_feature" style="">
              <label class="control-label col-sm-2">Service Provider </label>             
              <div class="col-sm-9">
          
              
                
                        
                         @foreach($user_details as $user_details_data)
							<div data-val="Balcony" class="checkbox ">
                          <label>	                    
	                        <input type="checkbox" value="{{$user_details_data->id}}" name="user_id[]" @if($user_details_data->checked ==1) Checked @endif > {{$user_details_data->name}} 
	                    </label>
                        </div>
	                     @endforeach
                        
                        
                        
                       
                    <div class="text-danger"></div>
              <p class="help-block"></p>
              </div>
            </div>


          

            <div class="col-sm-12">
                
                <input type="submit" name="submit" value="Update" class="btn btn-success">
            </div>

          </div>

          </form>
          </div>
        </div>

        <!--<script src='https://developersatwork.com/projects/f4/jack_latest1/public/vendor/crudbooster/assets/select2/dist/js/select2.full.min.js'></script>-->
        <script type="text/javascript">
        
            
         
            
            
           /* $( document ).ready(function() {
                    alert(1);
                    $('#suburbsedit').select2();
            });*/
            
        </script>
        @endsection
        