@extends('layouts.userinner')
@section('title', 'Quotelist')
@section('content')
<!--========================= profile body section start =========================-->	
	                
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">

	@if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('error') }}
        </div>
    @endif

	<div class="right-panel">
		<div class="heading-title">
			<h2><!-- @lang('sitelanguage.editprofile') -->Truck Driver List</h2>
		</div>
    <!-- <div class="row">
      <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
        <form class="filterform" method="post">
          <div class="form-group">
            <select class="selectpicker" data-live-search="true">
              <option selected="" data-icon="fa fa-star"> Search by Rating</option>
              <option data-icon="fa fa-star"> One Star</option>
              <option data-icon="fa fa-star"> Two Star</option>
              <option data-icon="fa fa-star"> Three Star</option>
              <option data-icon="fa fa-star"> Four Star</option>
              <option data-icon="fa fa-star"> Five Star</option>
            </select>
          </div>
        </form>
      </div>
    </div> -->

    <a href="{{url('user/create-truck-driver')}}"> <button class="common-btn submitbtn">Add Driver </button></a>
    <div class="row">
      <div class="col-xs-12">
        <div class="table-responsive">
          <table class="table table-bordered modifiedtable">
            <thead>
              <tr>
                <th>Driver Name</th>
                <th>Mobile Number</th>
              
                <th>Truck No</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($driver_list as $list_data)
              <tr>
                <td> {{ $list_data->name }} </td>
                <td> {{ $list_data->mobile_number }} </td>
                <td> {{ $list_data->truck_no }} </td>
                <td> <a href="{{ url('/')}}/user/driver-edit/{{ $list_data->id }}" style="margin-right: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>  <a onclick="delete_truck_driver('{{ $list_data->id }}')"><i class="fa fa-trash" aria-hidden="true" ></i></a></td>
                
               
              </tr>
             @endforeach
             
            </tbody>
          </table>
          {{ $driver_list->links() }}
        </div>
      </div>
    </div>
		
	</div>
</div>					

<div id="SellerModal" class="modal fade sellerdetailsmodal" role="dialog">
  <div class="modal-dialog">
    <!-- <div class="modal-content">
    	<div class="modal-body">
    		<button type="button" class="close" data-dismiss="modal">×</button>
    		<div class="sellermodalinner">
          <div class="selleruserbox">
            <div class="sellerimag">
              <img src="http://keenthemes.com/preview/metronic/theme/assets/pages/media/profile/profile_user.jpg" />
            </div>
            <div class="sellerusercontent">
              <h4>Koushik Mukherjee</h4>
              <p>India</p>
            </div>
          </div>
          <dl class="dl-horizontal">
            <dt>Email</dt>
            <dd>koushik.mukherjee@gmail.com</dd>
            <hr>
            <dt>Phone Number</dt>
            <dd>9336738638</dd>
            <hr>
            
            <dt>Company Name</dt>
            <dd>Webguru Infosystems</dd>
            <hr>
            <dt>Rating</dt>
            <dd><i class="fa farating fa-star"></i><i class="fa farating fa-star"></i><i class="fa farating fa-star"></i><i class="fa farating fa-star"></i><i class="fa  farating fa-star-o"></i></dd>
            <hr>
          </dl>
        </div>
    	</div>
    </div> -->
    <div id="vendar_data"> </div>
  </div>
</div>

   <!-- Modal -->
  <div class="modal fade delete-modal" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <i class="fa fa-exclamation" aria-hidden="true"></i>
          <p>Are you sure delete profile picture?</p>
          <input type="hidden" value="" id="image_path">
          <button type="button" class="btn btn-default" id="delete_image" data-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-default" id ="delete_close" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!--========================= profile body section end =========================-->
	

  <script type="text/javascript">
  $(function() {
  $(".vendar-details").on('click',function() {
      var lang = '<?php echo $locale =app()->getLocale(); ?>';
          var vendar_id = $(this).data('vendar');
            //alert(vendar_id); 
             var token = '<?php echo csrf_token() ?>';

            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              var url_val='{{ url('/') }}/user/vendar-details/'+vendar_id;                 

              $.ajax({
                url: url_val,
                method: 'get',
                success: function(result){
                  
                    $("#vendar_data").html(result);                          
                   
                  }
              });

              });
              });


</script>

<script>

  function delete_truck_driver($id){
    /*$('#myModal').modal('show');*/

      var result = confirm("Are you sure delete truck driver ?"); 
            if (result == true) {             
               window.location.href='driver-delete'+'/'+$id;
            } else {                 
                return false;
            } 
  }
</script>

@endsection