
@extends('layouts.master_new')
  @section('title', 'Forgot Password')
@section('content')
<style>
  .succls{
    border: 2px solid #8e8e8e !important;
  }
  .errcls
  {
    border: 2px solid red !important;
  }
  .hidemsg
  {
    display:none;
  }
  .showmsg
  {
    display:block;
  }
  .errmsg
  {
    color:red;
    text-align: left;
  }
</style>

<?php 
if($user_dtls->photo!=''){
  $user_current_img=url('/').'/storage/app/'.$user_dtls->photo;
}else{
  $user_current_img=asset("images/user-img.jpg");
}
?>

  @if(Session::has('error_message'))
  <div class="alert {{ Session::get('alert-class', 'alert-danger alert-dismissible') }} text-center">{{ Session::get('error_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
  @endif



  <section class="container-fluid afterlogin logincontainer">
    <div class="logininnercontainer">
      <div class="maincontainer">
        <div class="row">
          <div class="col-xs-12">
            <form id="changepwd_form" action="{{ action('HomeController@change_forgot_pass') }}" method="post">
              {{ csrf_field() }}
              <div class="col-md-8 col-md-offset-2">
                <div class="form-outer">
                    <div class="row">
                      <div class="col-xs-12">
                        <h3>Change Password</h3>
                      </div>
                    </div>

                    <div class="login-section register-section">


                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> * New Password:</label>
                            <div class="input-span">
                              <input type="password" class="form-control" name="newp" id="password" value="" placeholder="New Password" >
                             <small id="password_err" class="errmsg "></small>
                            </div>
                          </div>
                        </div>
                      </div>

                      <input type="hidden" class="form-control" name="varify_key" id="varify_key" value="{{ $varify_key }}" placeholder="Confirm Password" >

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> * Confirm Password:</label>
                            <div class="input-span">
                              <input type="password" class="form-control" name="conp" id="cpassword" value="" placeholder="Confirm Password" >
                              <small id="cpassword_err" class="errmsg "></small>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="btn-submit">
                       <input type="button" value="submit" class="btn btn-success signupbutton" id="changepass">
                     </div>
                 </div>
               </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</section>





<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->



<script type="text/javascript">
 $( document ).ready(function() {

  

  $( "#changepass" ).click(function() {

    
    
    var password=$("#password").val();
    var cpassword=$("#cpassword").val();

    /*if(newp=='')
    {
      $("#newp").removeClass('succls').addClass('errcls');
      $("#newp_err").text('Enter New password');
      $("#newp_err").removeClass('hidemsg').addClass('showmsg');
    }
    else
    {

      if(newp.length<6)
      {
        $("#newp").removeClass('succls').addClass('errcls');
        $("#newp_err").text('New Password must be minimum six character');
        $("#newp_err").removeClass('hidemsg').addClass('showmsg');

      }
      else
      {

        $("#newp").removeClass('errcls').addClass('succls');
        $("#newp_err").text('');
        $("#newp_err").removeClass('showmsg').addClass('hidemsg');
      }

    }

    if(conp=='')
    {
      $("#conp").removeClass('succls').addClass('errcls');
      $("#conp_err").text('<?php echo trans('Enter Confirm password');?>');
      $("#conp_err").removeClass('hidemsg').addClass('showmsg');
    }
    else
    {
      if(conp.length<6)
      {
        $("#conp").removeClass('succls').addClass('errcls');
        $("#conp_err").text('Confirm Password must be minimum six character');
        $("#conp_err").removeClass('hidemsg').addClass('showmsg');
      }
      else
      {
        if(newp!=conp)
        {
          $("#conp").removeClass('succls').addClass('errcls');
          $("#conp_err").text('Enter Confirm password'); 
          $("#conp_err").removeClass('hidemsg').addClass('showmsg');
        }
        else
        {
          $("#conp").removeClass('errcls').addClass('succls');
          $("#conp_err").text('');
          $("#conp_err").removeClass('showmsg').addClass('hidemsg');  
        }
      }



    }*/



    if(cpassword==''){

     

 $("#cpassword").removeClass('succls').addClass('errcls');         
 $('#cpassword_err').html('Enter Confirm Password');
 flag = 1;
 //return false;
}else{

  if(cpassword !=password){
   $("#cpassword").removeClass('succls').addClass('errcls'); 
   $('#cpassword_err').html(" Password does't match");
   flag = 1;
   return false;

 }else{

  $("#cpassword").removeClass('errcls').addClass('succls'); 
  $('#cpassword_err').html('');
  flag = 0;
}

}










if(password==''){  

   if(password.length < 6 || password.length >= 12) {        
         $("#password").removeClass('succls').addClass('errcls');        
         $('#password_err').html('Password must be 6 ~ 12 length characters');
        return false;
      }else{

           $("#password").removeClass('succls').addClass('errcls');        
           $('#password_err').html('Enter Password');
           flag = 1;
      }

 
 //return false;
}else{

       if(password.length < 6 || password.length >= 12) {        
         $("#password").removeClass('succls').addClass('errcls');        
         $('#password_err').html('Password must contain at 6 ~ 12 characters!');
        return false;
      }else{




        re = /[0-9]/;
          if(!re.test(password)) {
            //alert("Error: password must contain at least one number (0-9)!");
            //form.pwd1.focus();
             $("#password").removeClass('succls').addClass('errcls');        
             $('#password_err').html('Password must contain at least one number (0-9)!');
            return false;
          }else{

             $("#password").removeClass('errcls').addClass('succls');        
             $('#password_err').html('');
          }

          re = /[A-Z]/;
          if(!re.test(password)) {
            //alert("Error: password must contain at least one number (0-9)!");
            //form.pwd1.focus();
             $("#password").removeClass('succls').addClass('errcls');        
             $('#password_err').html('Password must contain at least one uppercase letter (A-Z)!');
            return false;
          }else{

             $("#password").removeClass('errcls').addClass('succls');        
             $('#password_err').html('');
          }
          re = /[a-z]/;
          if(!re.test(password)) {
            //alert("Error: password must contain at least one number (0-9)!");
            //form.pwd1.focus();
             $("#password").removeClass('succls').addClass('errcls');        
             $('#password_err').html('Password must contain at least one lowercase letter (a-z)!');
            return false;
          }else{

             $("#password").removeClass('errcls').addClass('succls');        
             $('#password_err').html('');
          }

          re = /[!@#\$%\^&\*]/;
          if(!re.test(password)) {
            //alert("Error: password must contain at least one number (0-9)!");
            //form.pwd1.focus();
             $("#password").removeClass('succls').addClass('errcls');        
             $('#password_err').html('Password must contain at least one special character!');
            return false;
          }else{

             $("#password").removeClass('errcls').addClass('succls');        
             $('#password_err').html('');
          }


          /*$("#password").removeClass('errcls').addClass('succls');
         $('#password_err').html('');*/
         flag = 0;
      }
    }





    var errItems = $('#changepwd_form').find('.errcls').length;


    if(errItems==0)
    {
      $('#changepwd_form').submit();
    }
            //$('#registration_form').submit();

          });
});
</script>



@endsection


