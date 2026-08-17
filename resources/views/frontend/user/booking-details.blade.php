@extends('layouts.userinner')
@section('title', 'Booking')
@section('content')
<!--========================= profile body section start =========================-->	
	                
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">

	@if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            @lang('sitelanguage.update_account_success_msg')
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
			<h2><!-- @lang('sitelanguage.editprofile') -->Booking Details </h2>
		</div>
		<form class="c-form-wr" enctype="multipart/form-data" method="POST" action="{{ route('booking') }}" onsubmit="return validateForm()">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.deliverytype') --> Contact Name <span>*</span></label>

						<input type="text" name="contact_name" id="contact_name" class="form-control" value="" required="true">
						
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.cemail') --> Company Name <span>*</span></label>
						<input type="text" name="company_name" id="company_name" class="form-control" value="" required="true">
					</div>
				</div>

				<!-- shipping from -->
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.cmobile') --> Address <span>*</span></label>
						<input type="text" name="address" id="address" class="form-control" value="" required="true">
					</div>
				</div>
				
				

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --> Telephone<span>*</span></label>
						<input type="text" name="telephone" id="telephone" class="form-control" value="" required="true">
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --> Fax <span></span></label>
						<input type="text" name="fax" id="fax" class="form-control" value="" >
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --> Shipping Price ($) <span></span></label>
						<input type="text" name="total_price" id="fax" class="form-control" value="{{$vendar_details->vendar_price}}" readonly="">

						<input type="hidden" name="vendor_id" value="{{$vendar_details->id}}">
					</div>
				</div> 


				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --> Payment Percentage <span></span></label>
						<input type="text" name="payment_percentagee" id="fax" class="form-control" value="{{$payment_percentage->percentage_amount}}" readonly="">

						
					</div>
				</div>

				<!-- hidden value -->

				<input type="hidden" value="{{$user_quote_details->quote_id}}" id="quote_unique_id" name="quote_unique_id">
				<input type="hidden" value="{{$user_quote_details->id}}" id="quote_id" name="quote_id">



				<?php 

					$percentage = $payment_percentage->percentage_amount;
					$total_amount = $vendar_details->vendar_price;
					$new_amount = ($percentage / 100) * $total_amount;
				?>



				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --> Payable Amount <span id="currency_code"> (USD) </span> <span></span></label>
						<input type="text" name="shipping_price" id="payable_price" class="form-control" value="{{$new_amount}}" readonly="">
						<input type="hidden" value="{{$new_amount}}" id="shipping_price" name="payment_percentage">

						
					</div>
				</div> 




				

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --> Currencies <span></span></label>
						

						<select name="currencies" id="price_id" class="form-control">

							<option value=""> Select currency </option>
							@foreach($currencies as $cury_value)
							<option value="{{ $cury_value->currencie_code_en}}"> {{ $cury_value->currencie_code_en}} </option>
							@endforeach

						</select>

						
					</div>
				</div>



				

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label><!-- @lang('sitelanguage.address') --> Shipment Destination <span>*</span></label>
						<input type="text" name="shipping_destination" id="shipping_destination" class="form-control" value="" >
					</div>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="submit-btn">
						<input class="common-btn submitbtn" type="submit" value="Submit" name="submit">
					</div>
				</div>


			</div>
		</form>
		Delivery instructions 	
	</div>
</div>


<!--========================= profile body section end =========================-->

<!-- Modal -->
  
</div>
	
	<!------>
		

	<script>
		$( document ).ready(function() {

          var x=$('meta[name="csrf-token"]').attr('content');

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
               // alert(x);



               $('#price_id').change(function(e){
                var price_id=$("#price_id").val(); 
                var shipping_price=$("#shipping_price").val(); 
                //$("#currency_code").innerHTML(price_id);
                //$("#currency_code").innerHTML= price_id;
                document.getElementById("currency_code").innerHTML= '('+price_id +')';              
                        var url_val='{{ url('/') }}/user/rate-exchange/'+price_id+'/'+shipping_price;
                         //alert(url_val);
                         $.ajax({
                          url: url_val,
                          method: 'get',
                          success: function(result){
                            console.log(result);

                            $("#payable_price").val(result);

                        	

                          }});
                });

               //$("#country_id").trigger("change");

               

             });
	</script>


	

	<script>
  $( function() {
    $( "#date" ).datepicker();
  } );
  </script>

@endsection