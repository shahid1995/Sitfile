  @extends('layouts.master_new')
  @section('title', 'register')
  @section('content')

  <section class="innerbanner wow fadeIn"style="visibility: visible; animation-name: fadeIn;">
    <img src="{{asset('images/contactbanner.jpg') }}" alt="">
    <div class="maincontainer">
      <div class="row">
        <div class="col-xs-12">
        </div>
      </div>
    </div>
  </section>

  <section class="container-fluid servicecontainer logincontainer">
  	<div class="maincontainer">
         <div class="row">
          <div class="col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
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
          </div>
      </div>
      <div class="row">
       <div class="col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
        <div class="login-section">
          <div class="serviceheadingcolumn">
             <h2>@lang('sitelanguage.t_register')</h2>
         </div>
         <form  method="POST" action="{{ route('addtransporter') }}">
             {{ csrf_field() }}

             <input type="hidden" name="roll_id" value="2">

             <div class="logincolumn">
                 <div class="row">

                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('sitelanguage.compname')</label>
                        <input type="text" class="form-control" name="company_name" value="" />
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <!-- <label>Transporter Name</label> -->
                        <label>@lang('sitelanguage.cname')<span>*</span></label>
                        <input id="name" type="text" class="form-control" name="name" value="" required>

                        @if ($errors->has('name'))
                        <span class="help-block">
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('sitelanguage.cemail')<span>*</span></label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" required>

                        @if ($errors->has('email'))
                        <span class="help-block">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('sitelanguage.cusername')<span>*</span></label>
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}"  required>

                        @if ($errors->has('username'))
                        <span class="help-block">
                            {{ $errors->first('username') }}
                        </span>
                        @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('sitelanguage.cpassword')<span>*</span></label>
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                        <span class="help-block">
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('sitelanguage.conpassword')</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('sitelanguage.cmobile')<span>*</span></label>
                        <input id="phoneno" type="number" class="form-control" name="phoneno" value="" required>

                        @if ($errors->has('phoneno'))
                        <span class="help-block">
                            {{ $errors->first('phoneno') }}
                        </span>
                        @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('sitelanguage.cwhatsaap')</label>
                        <input id="whatsappno" type="number" class="form-control" name="whatsappno" value="{{ old('whatsappno') }}" required>

                        @if ($errors->has('whatsappno'))
                        <span class="help-block">
                            {{ $errors->first('whatsappno') }}
                        </span>
                        @endif
                    </div>
                  </div>
                  <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <label>@lang('sitelanguage.address')</label>
                        <textarea class="form-control" name="address"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <label>@lang('sitelanguage.otherdetails')</label>
                        <textarea class="form-control" name="other_details"></textarea>
                    </div>
                  </div>                
                  <div class="col-xs-12">
                    <div class="form-group">
                        <a class="forgot" href="{{url('forgetpass')}}">@lang('sitelanguage.forgotpass')</a>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="checkbox agree">
                      <input id="agree" type="checkbox" required>
                      <label for="agree">@lang('sitelanguage.checkagree') <a href="javascript:void(0);"
                         data-toggle="modal" data-target="#myModal" >@lang('sitelanguage.checkterms')</a> </label>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="button-submit">
                     <button type="submit" class="loginbtn"><span>@lang('sitelanguage.createaccount')</span></button>
                    </div>
                  </div>

                   <div class="col-xs-12">
                     <div class="alreadyaccount">
                        <p>@lang('sitelanguage.allreadyaccount') <a href="{{ route('login') }}">@lang('sitelanguage.login')</a> </p>
                    </div>
                  </div>

                </div>
               </form>
             </div>
           </div>
         </div>
        </div>
      </div>
    </div>
  </div>
</section>


  <div id="myModal" class="modal fade c-model-wrper" role="dialog">
    <div class="modal-dialog modal-md">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">terms of use</h4>
          <span><i class="fa fa-file-text-o" aria-hidden="true"></i></span>
      </div>
      <div class="modal-body">
       <h4>Lorem Ipsum is simply dummy</h4>
       <p>
         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
     </p>
     <h4>Lorem Ipsum is simply dummy</h4>
     <p>
         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
     </p>
     <h4>Lorem Ipsum is simply dummy</h4>
     <p>
         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
     </p>
     <h4>Lorem Ipsum is simply dummy</h4>
     <p>
         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
     </p>
     <h4>Lorem Ipsum is simply dummy</h4>
     <p>
         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
     </p>
     <ul>
         <li>Lorem Ipsum is simply dummy</li>
         <li>Lorem Ipsum is simply dummy</li>
         <li>Lorem Ipsum is simply dummy</li>
         <li>Lorem Ipsum is simply dummy</li>
         <li>Lorem Ipsum is simply dummy</li>
     </ul>
  </div>
  </div>

  </div>
  </div>



  @endsection
