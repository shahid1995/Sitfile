@extends('layouts.userinner')
@section('content')

<div class="col-lg-9 col9">
        <div class="row">
          <div class="col-xs-12">
           <!--  <div class="righttopheading"></div> -->
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="rightprofile">
              <div class="profile-bio">
                <div class="row">
                  <div class="col-xs-12">
                      
                      

                  <form name="frmPaypal" id="frmPaypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="cmd" value="_xclick">
                  <input type="hidden" name="business" value="perso1_1305032285_per@yahoo.com">
                  <!--<input type="hidden" name="business" value="seller_1296116991_biz@yahoo.com">-->
                 
                  <input type="hidden" name="item_number" value="<?php echo $payment_details['quote_unique_id']; ?>">
                  <input type="hidden" name="amount" value="2">
                  <input type="hidden" name="item_name" value="<?php echo $payment_details['company_name']; ?>">

                  <input type="hidden" name="currency_code" value="USD">                  
                  <input type="hidden" name="return" value="{{url('/')}}/user/payment-success">
                  <input type="hidden" name="cancel_return" value="{{url('/')}}/user/payment-failed">
                  <input type="hidden" name="notify_url" value="{{url('/')}}/user/paypal-payment-ipn">
                 
                  </form>
                
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="success-msg">
                      <div class="loader"></div>
                      <h3><strong>Thanks for your order</strong></h3>
                      <p>You are redirecting to paypal payment gateway. Please do not refresh the page.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script language="JavaScript" type="text/javascript">
window.onload=function() {
  window.document.frmPaypal.submit();
}
</script>
</div>
</div>


@endsection