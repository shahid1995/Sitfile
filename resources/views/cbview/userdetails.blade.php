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

     
        <div class="table-responsive">
<table id="table-detail" class="table table-striped">
	
           

        	    				<tbody><tr><td>User First Name</td><td>{{ $user_details->first_name }}</td></tr>		
			                   
        	    				<tr><td>User Last Name</td><td>{{ $user_details->last_name }}</td></tr>		
			                   
        	    				<tr><td>Company Name</td><td> {{ $user_details->company_name }} </td></tr>		
			                       		                

        	    				<tr><td>Contact Person Name</td><td>{{ $user_details->contact_person_name }}</td></tr>		
			                       		                


        	    				<tr><td>Institute Name</td><td>{{ $user_details->institute_name }}</td></tr>		
			                       		                

        	    				<tr><td>Mobile Number</td><td>{{ $user_details->phoneno }}</td></tr>		
			                     
        	    				<tr><td>Email</td><td>{{ $user_details->email }}</td></tr>		
			                       		                

        	    				<tr><td>Address</td><td>{{ $user_details->address }}</td></tr>		
			                       		                


	
	</tbody></table>
	</div>
     
     
     
     
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
        