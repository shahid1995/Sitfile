@extends('layouts.master_login')

@section('content')

<!-- @if (count($errors) > 0)
@foreach ($errors->all() as $error)
   {{!! $errors !!}}
@endforeach
@endif -->

<style>
    
 .error {

    color: #f30101;

    font-weight: bold;

}
    
</style>


<section class="registrationcontainer customerregister reg_sec sregister">
  <a class="homebtn" href="{{ url('/') }}"><i class="fa fa-home"></i></a>
  <div class="maincontainer">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-push-2 col-md-push-2">
        <div class="wizard">
          <div class="wizard-inner">
            <ul class="nav nav-tabs nav-tabs-c-register" role="tablist">
              <li role="presentation" class="active">
                <a href="#Step01" data-toggle="tab" aria-controls="Step01" role="tab" title="" data-original-title="Step 1">
                  <span class="round-tab">
                    <i></i>
                    <span class="tabtext">Step 1</span>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#Step03" data-toggle="tab" aria-controls="Step02" role="tab" title="" data-original-title="Step 2">
                  <span class="round-tab">
                    <i></i>
                    <span class="tabtext">Step 2</span>
                  </span>
                </a>
              </li>
             <!-- <li role="presentation" class="disabled">
                <a href="#Step03" data-toggle="tab" aria-controls="Step03" role="tab" title="" data-original-title="Step 3">
                  <span class="round-tab">
                    <i></i>
                    <span class="tabtext">Step 3</span>
                  </span>
                </a>
              </li>-->
              
            </ul>
          </div>
          <div class="reg_box_sec newreg">
            <div class="rheading">Service Provider Registration</div>
            <div class="reg_box_in">
              <h2>Create Account</h2>
              <div class="wizardformouter">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                  <ul id="login-validation-errors" class="validation-errors">
                      @foreach ($errors->all() as $error)
                      <li class="validation-error-item">{{ $error }}</li>
                      @endforeach
                  </ul>
                </div>
                @endif
                <form role="form" class="wizardform" action="{{ url('/sregister') }}" method="post" enctype="multipart/form-data" id="sregister-form">
                  {{ csrf_field() }}
                  <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="Step01">
                      <div class="formtypebox">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>Your Name</label>
                                    @if ($errors->has('name'))
                                      <span class="error-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                      @endif
                                    <input type="text" class="form-control" placeholder="Your Name" name="name" id="sname" value="{{old('name')}}" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>Mobile Number</label>
                                    <span id="error-phone"></span> 
                                    <input type="text" class="form-control" value="{{old('mobileno')}}" placeholder="Mobile Number" name="mobileno" id="phoneno" maxlength="10">
                                  </div>
                                </div>
                              </div>
                             <div class="col-sm-6">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>Email ID</label>
                                    <span id="error-email"></span>
                                    <input type="email" class="form-control" value="{{old('email')}}" placeholder="Email ID" name="email" id="semail">
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>Password</label>
                                    <input type="password" class="form-control" value="{{old('password')}}" placeholder="Password" name="password" id="spassword">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="formtypebtnbox">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-12 col-xs-12 text-center">
                            <div class="formtypebtngroup">
                              <button type="button" class="nextformbtn next-step-btn2" id="step2">Next</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="Step02">
                      <div class="formtypebox">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                  <label class="otpsendlabel">OTP will be sent to validate the Mobile Number and Email ID.</label>
                                  <div class="groupinner">
                                    <input type="text" class="form-control mobilenumber" value="" placeholder="OTP for Mobile" name="" onkeyup="checkinput()" id="mobile_otp">
                                    <a class="otpsend" href="javascript:void(0);">Resend OTP</a>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <input type="text" class="form-control mobilenumber" value="" placeholder="OTP for Email" name="" onkeyup="checkinput()" id="email_otp">
                                    <a class="otpsend" href="javascript:void(0);">Resend OTP</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="formtypebtnbox">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-12 col-xs-12 text-center">
                            <div class="formtypebtngroup">
                              <button type="button" class="nextformbtn next-step-btn2" id="step2">Next</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="Step03">
                      <div class="formtypebox">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>Company/Business Name</label>
                                    <input type="text" class="form-control" placeholder="Company/Business Name" name="company_name" value="{{ old('company_name') }}" required>
                                  </div>
                                </div>
                                @if ($errors->has('company_name'))
                                    <span class="error-block">
                                      <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>GSTIN</label>
                                    <input type="text" class="form-control" value="{{old('gstin')}}" placeholder="GSTIN" name="gstin" required>
                                  </div>
                                </div>
                                @if ($errors->has('gstin'))
                                    <span class="error-block">
                                      <strong>{{ $errors->first('gstin') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>Pin Code</label>
                                    <input type="text" class="form-control" value="{{old('pincode')}}" placeholder="Pin Code" name="pincode" required>
                                  </div>
                                </div>
                                @if ($errors->has('pincode'))
                                    <span class="error-block">
                                      <strong>{{ $errors->first('pincode') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>Address</label>
                                    <input type="text" class="form-control" value="{{old('address')}}" placeholder="Address" name="address" required>
                                  </div>
                                </div>
                                @if ($errors->has('adress'))
                                    <span class="error-block">
                                      <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>Country</label>
                                    <select class="form-control" name="country" required>
                                      <option selected="" hidden="">Country</option>
                                      <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>USA</option>
                                      <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                                      <option value="China" {{ old('country') == 'China' ? 'selected' : '' }}>China</option>
                                    </select>
                                  </div>
                                </div>
                                @if ($errors->has('country'))
                                    <span class="error-block">
                                      <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control" placeholder="State" value="{{old('state')}}">
                                  </div>
                                </div>
                                @if ($errors->has('state'))
                                    <span class="error-block">
                                      <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" placeholder="City" value="{{old('city')}}">
                                  </div>
                                </div>
                                @if ($errors->has('city'))
                                    <span class="error-block">
                                      <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>Number of Service Engineer/RSO</label>
                                    <input type="text" class="form-control" value="{{old('number_of_serv_eng')}}" placeholder="Number of Service Engineer/RSO" name="number_of_serv_eng" required>
                                  </div>
                                </div>
                                @if ($errors->has('number_of_serv_eng'))
                                    <span class="error-block">
                                      <strong>{{ $errors->first('number_of_serv_eng') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>Name of Service Engineer/RSO</label>
                                    <input type="text" class="form-control" value="{{old('name_of_serv_eng')}}" placeholder="Name of Service Engineer/RSO" name="name_of_serv_eng" required>
                                  </div>
                                </div>
                                @if ($errors->has('name_of_serv_eng'))
                                    <span class="error-block">
                                      <strong>{{ $errors->first('name_of_serv_eng') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>Anything you want to say</label>
                                    <input type="text" class="form-control" value="{{old('remarks')}}" placeholder="Anything you want to say" name="remarks">
                                  </div>
                                </div>
                                @if ($errors->has('remarks'))
                                    <span class="error-block">
                                      <strong>{{ $errors->first('remarks') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>AERB Authorisation Letter</label>
                                    <small>Uploaded file type must be : jpeg,jpg,png</small>
                                    <div class="fileinput">
                                      <input type="file" class="form-control" id="upload" name="auth_upload" required>
                                      <input type="text" class="form-control filetext">
                                      <span class="filebtn"><i class="fa fa-folder-open-o"></i></span>
                                    </div>
                                    
                                  </div>
                                </div>
                                @if ($errors->has('auth_upload'))
                                    <span class="error-block">
                                      <strong>{{ $errors->first('auth_upload') }}</strong>
                                    </span>
                                    @endif
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="groupinner">
                                    <label>Service Engineer/RSO Certificate</label>
                                    <small>Uploaded file type must be : jpg/jpeg/png</small>
                                    <div class="fileinput">
                                      <input type="file" class="form-control" id="upload" name="certificate_upload" required>
                                      <input type="text" class="form-control filetext">
                                      <span class="filebtn"><i class="fa fa-folder-open-o"></i></span>
                                    </div>
                                  </div>
                                </div>
                                @if ($errors->has('certificate_upload'))
                                    <span class="error-block">
                                      <strong>{{ $errors->first('certificate_upload') }}</strong>
                                    </span>
                                    @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="formtypebtnbox">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-12 col-xs-12 text-center">
                            <div class="formtypebtngroup">
                              <button type="submit" class="nextformbtn">Submit</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="tab-pane" role="tabpanel" id="Step04">
                      <div class="formtypebox">
                        <div class="row">
                          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-push-2 col-md-push-2">
                            <div class="tableheading">
                              <label>View Your Account Details</label>
                            </div>
                            <div class="equipmentbox">
                              <dl class="dl-horizontal">
                                <dt>Your Name:</dt>
                                <dd>Tapas Mahato</dd>
                                <dt>Mobile Number:</dt>
                                <dd>+91 8477499367</dd>
                                <dt>Email ID:</dt>
                                <dd>tapas.jbb@gmail.com</dd>
                                <dt>Password:</dt>
                                <dd>**********</dd>
                                <dt>Company/Business Name:</dt>
                                <dd>Brainware India Pvt Ltd</dd>
                                <dt>GSTIN:</dt>
                                <dd>G57635563826</dd>
                                <dt>Pin Code:</dt>
                                <dd>700091</dd>
                                <dt>Address:</dt>
                                <dd>Y8, EP Block, Sector V, Bidhannagar, Kolkata, West Bengal 700091, India</dd>
                                <dt>Country:</dt>
                                <dd>India</dd>
                                <dt>State:</dt>
                                <dd>Kolkata</dd>
                                <dt>City:</dt>
                                <dd>West Bengal</dd>
                                <dt>Number of Service Engineer/RSO:</dt>
                                <dd>1</dd>
                                <dt>Name of Service Engineer/RSO:</dt>
                                <dd>2</dd>
                                <dt>Anything you want to say:</dt>
                                <dd>Doller lorem ipsum</dd>
                                <dt>AERB Authorisation Letter:</dt>
                                <dd>Lorem ipsum</dd>
                                <dt>Service Engineer/RSO Certificate:</dt>
                                <dd>certificate.jpg</dd>
                              </dl>
                              <div class="actiongroup">
                                <a class="editbtn" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
                              </div>
                            </div>
                            <div class="eqicontent text-center">
                              <button class="rejectbtn" type="button">Reject</button>
                              <button class="acceptbtn" type="button">Accept</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> -->
                  </div>
                </form>
                <div class="createaccount">
                 
                  <p>Already have an altibbe account? <a href="{{ route('login') }}">Sign in</a>.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection