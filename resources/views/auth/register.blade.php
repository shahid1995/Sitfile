  @extends('layouts.master_login')
  @section('title', 'register')
  @section('content')

<section class="registrationcontainer customerregister userregister reg_sec">
  <a class="homebtn" href="{{ url('/') }}"><i class="fa fa-home"></i></a>
  <div class="maincontainer">
    <div class="row">
      <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-push-1 col-md-push-1">
        <div class="wizard">
          <div class="wizard-inner" style="display: none;">
            <ul class="nav nav-tabs nav-tabs-normal-register" role="tablist">
              <li role="presentation" class="active">
                <a href="#Step01" data-toggle="tab" aria-controls="Step01" role="tab" title="" data-original-title="Step 1">
                  <span class="round-tab">
                    <i></i>
                    <span class="tabtext">Step 1</span>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#Step02" data-toggle="tab" aria-controls="Step02" role="tab" title="" data-original-title="Step 2">
                  <span class="round-tab">
                    <i></i>
                    <span class="tabtext">Step 2</span>
                  </span>
                </a>
              </li>
            </ul>
          </div>
          
          <div class="reg_box_sec newreg">
            <div class="rheading">Let’s create your account.</div>
            
            <h2><span id="reg_text-no-text">Signing up for awzonex is fast and free</span> </h2>
            <div class="rerow">
                <div class="recolumn">
                    <div class="recolumninner">
                        <h5>Just the basics</h5>
                        <p>Tell us about your business so we can serve you better.</p>
                    </div>
                </div>
                <div class="recolumn">
                    <div class="recolumninner">
                        <h5>QA test reminder</h5>
                        <p>Get notification to take necessary action on time to perform periodic Quality Assurance test as prescribed by AERB</p>
                    </div>
                </div>
                <div class="recolumn">
                    <div class="recolumninner">
                        <h5>Free Support</h5>
                        <p>Get basic support for AERB license for operation, registration, radiation protection, room shielding, elora account management, etc</p>
                    </div>
                </div>
            </div>
            <div class="reg_box_in">
              <!--<h2>Create Account</h2>-->
                <div class="wizardformouter">
              <form class="wizardform" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
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
                <div class="tab-content">
                  <div class="tab-pane active" role="tabpanel" id="Step01">
                    <div class="formtypebox">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>First Name</label>
                                <div class="groupinner">
                                  <input type="text" class="form-control" value="{{old('first_name')}}" placeholder="First Name" name="first_name" id="first_name" required>
                                </div>
                                @if ($errors->has('first_name'))
                                <span class="error-block">
                                  <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                            
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Last Name</label>
                                <div class="groupinner">
                                  <input type="text" class="form-control" value="{{old('last_name')}}" placeholder="Last Name" name="last_name" id="last_name" required>
                                </div>
                                @if ($errors->has('last_name'))
                                <span class="error-block">
                                  <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                            
                            
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Mobile Number</label>
                                <span class="error-block" id="error-phn"></span>
                                <span class="success-block" id="success-phn"></span>
                                <div class="groupinner">
                                  <input type="text" class="form-control mobilenumber" value="{{old('phoneno')}}" placeholder="Mobile Number" name="phoneno" id="phoneno" maxlength="10" required>
                                  <!-- <a class="otpsend" href="javascript:void();" id="send-otp">Send OTP</a> -->
                                </div>
                                @if ($errors->has('phoneno'))
                                <span class="error-block">
                                  <strong>{{ $errors->first('phoneno') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Email</label>
                                <span class="error-block" id="error-email"></span>
                                <div class="groupinner">
                                  <input type="email" class="form-control" value="{{old('email')}}" placeholder="Email" name="email" id="email" required>
                                </div>
                                @if ($errors->has('email'))
                                <span class="error-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Password</label>
                                <div class="groupinner">
                                  <input type="password" class="form-control" value="{{old('password')}}" placeholder="Password" name="password" id="password" required>
                                </div>
                                @if ($errors->has('password'))
                                <span class="error-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                            
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="groupinner">
                                  <input type="password" class="form-control" value="{{old('con_password')}}" placeholder="Confirm Password" name="con_password" id="con_password" required>
                                </div>
                                @if ($errors->has('password'))
                                <span class="error-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                              </div>
                            </div>
                            
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="formtypebtnbox">
                      <div class="row">
                        <div class="col-sm-6">
                            <div class="cttextinner"><p>By continue, you agree to awzonex <a href="{{ url('page/terms-of-use') }}" target="_blank">Terms and condition</a>, <a href="{{ url('page/privacy-policy') }}" target="_blank">Privacy Policy</a></p></div>
                        </div>
                        <div class="col-sm-6">
                          <div class="formbtncontent">
                          </div>
                          <div class="formtypebtngroup">
                            <!--<button type="button" class="nextformbtn next-step-btn3" id="step1" onclick="getemailmobile()">Continue</button>-->
                            <button type="submit" class="nextformbtn next-step-btn3" id="step12">Continue</button>
                          </div>
                        </div>
                      </div>
                      </form>
                      <div class="row">
                          <div class="col-xs-12">
                              <div class="createaccount">
                                <p>Already have an awzonex account? <a href="http://quality-web-programming.com/projects/f4/shahid/login">Sign in</a>.</p>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  
                  
                  
                  <div class="tab-pane" role="tabpanel" id="Step02" style="display:none">
                    <div class="formtypebox">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <!--<label class="otpsendlabel">OTP will be sent to validate the Mobile Number and Email ID.</label>-->
                                <label class="otpsendlabel"></label>
                                <div class="groupinner">
                                  <input type="text" class="form-control" value="" placeholder="Enter Mobile OTP" name="otp" id="input-otp">
                                  <a class="otpsend" href="javascript:void();" id="send-otp">Resend OTP</a>
                                </div>
                                <div class="groupinner">
                                  <input type="text" class="form-control" value="" placeholder="Enter Email OTP" name="otp" id="input-otp">
                                  <a class="otpsend" href="javascript:void();" id="send-otp">Resend OTP</a>
                                </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="formtypebtnbox">
                      <div class="row">
                        <div class="col-lg-10 col-md-10 col-12 col-xs-12 col-lg-push-1 col-md-push-1">
                          <div class="formbtncontent">
                          </div>
                          <div class="formtypebtngroup">
                            <button type="submit" class="nextformbtn next-step-btn3" id="step1">Create Your Account</button>
                          </div>
                        </div>
                      </div>
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

<!-- Modal -->
<div class="modal fade signuppoup signuppoup_reg" id="AnswerModal" tabindex="-1" role="dialog" aria-labelledby="AnswerModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="poupupheading poupupheading_modal">
              <p>Below are the some questionnaire, according to the response of client, the system will display/show the client what compliance he/she need to fulfil and also what services we offer to fulfill those compliances</p>
              <p>What kind of activity/action you are doing and/or about to do</p>

              <ol class="reg_upper_alpha">
                <li>Operating x-ray equipment</li>
                <li>Purchasing x-ray equipment</li>
                <li>Changing /moving the location/position of x-ray equipment</li>
                <li>Shutting down/closing the operation of x-ray equipment</li>
              </ol>
              <ol class="reg_upper_alpha reg_upper_alpha_first">
                <li>Question for “Regulatory Compliance for operating X-Ray Equipment”
                  <ol class="reg_number">
                <li>Tell us where your institute is located. (next Q-2)
                  <ol class="reg_lower_alpha">
                  <li>pincode/city/state/address</li>
                </ol>
                </li>
                <li>Do you have the branch institute? (if yes Q-3, if No Q-4)
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
                </li>
                <li>Tell us where your branch institute is located. (Next Q-4)
                  <ol class="reg_lower_alpha">
                  <li>pincode/city/state/address*</li>
                </ol>
                </li>
                <li>Is your institute accredited from NABH/NABL (next Q-5)
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
                </li>
                <li>Tell us a few details about the equipment you have.(Next Q-6)
                  <ol class="reg_lower_alpha">
                  <li>Type of equipment*</li>
                  <li>Branch where machine is operated*</li>
                  <li>Model name</li>
                  <li>Manufacturer</li>
                  <li>Serial number</li>
                </ol>
                </li>
                <li>Do you have a license for the operation of the following machines? (If Yes Q-7, If No Q-8)
                  <ol class="reg_lower_latter">
                  <li>Display the list of machines that he/she declared</li>
                </ol>
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
                </li>
                <li>Tell us a few details of the license you have for the following machines.(Next Q-09)
                  <ol class="reg_lower_alpha">
                  <li>Select the equipment for which you have the license for operation*</li>
                  <li>Issuance Date</li>
                  <li>Expiry Date</li>
                </ol>
                </li>
               <li>Do you have a Quality Assurance test report of the following machines? (If yes than Next Q-9 or Q-10)
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No </li>
                </ol>
                </li>
              <li>Tell us when last Quality Assurance test for the following machines were performed?(If Q-6=yes then jump to Q-15)
                  <ol class="reg_lower_alpha">
                  <li>Date of last QA Test performed or --months ago*</li>
                </ol>
               </li>
               <li>Do you have a room shielding layout for the following machines? (Next Q-11)
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
               </li>
               <li>Tell us a few details about your staff working in the Radiology department (e.g. X-Ray technician/Radiologist) (Next Q-13)</li>
               <li>Do you have the TLD Badges for these Radiation workers? (Next Q-14)
                <ol class="reg_lower_latter">
                  <li>Display the list of Radiation Worker</li>
                </ol>
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
               </li>
               <li>Do you have these radiation protection Accessories/Instruments? (Next Q-15)
                <ol class="reg_lower_latter">
                  <li>List of the instrument mandatory to have</li>
                </ol>
                  <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
               </li>
               <li>Have you done recently any servicing of the following machines?
                <ol class="reg_lower_alpha">
                  <li>Yes</li>
                  <li>No</li>
                </ol>
               </li>
            </ol>
                </li>
                <li>Purchasing X-Ray Equipment
                  <ol class="reg_number">
                <li>Tell a few details of the equipment you are buying
                  <ol class="reg_lower_alpha">
                    <li>I am purchasing the New equipment/Pre-owned equipment</li>
                    <li>For New machine
                      <ol class="reg_lower_latter">
                      <li>What Type of equipment you are about to buy?*
                        <ol class="reg_number">
                          <li>Radiography (fixed)</li>
                          <li>Radiography (mobile)</li>
                          <li>Radiography (portable)</li>
                          <li>Radiography & Fluoroscopy</li>
                          <li>C-Arm</li>
                          <li>6.O-Arm</li>
                          <li>Interventional Radiology</li>
                          <li>Computed Tomography (CT-Scan)</li>
                          <li>Mammography</li>
                          <li>Dental Cone Beam CT</li>
                          <li>Ortho Pantomography (OPG)</li>
                          <li>Dental (Intra Oral)</li>
                          <li>Dental (Hand Held)</li>
                          <li>Bone Densitometer (BMD)</li>
                        </ol>
                      </li>
                      <li>Do you have room Layout*
                        <ol class="reg_number">
                          <li>Yes</li>
                          <li>No</li>
                        </ol>
                      </li>
                      <li>Do you have a Copy of authenticated QA report from the earlier user*
                        <ol class="reg_number">
                          <li>Yes</li>
                          <li>No</li>
                        </ol>
                      </li>
                    </ol>
                    </li>
                  </ol>
                </li>
             </ol>
                </li>
                <li>Change in Layout
                  <ol class="reg_number">
                  <li>Select the equipment for which layout is to be change</li>
                  <li>What type of changes are you supposed to do
                    <ol class="reg_lower_alpha">
                      <li>Layout modification in an existing facility</li>
                      <li>Repositioning of equipment</li>
                      <li>Relocation of equipment</li>
                    </ol>
                  </li>
                </ol>
                </li>
                <li>Decommissioning of X-Ray Equipment
                  <ol class="reg_number">
                  <li>Which of the following equipment do you want to decommission
                    <ol class="reg_lower_alpha">
                      <li>List of the equipment</li>
                    </ol>
                  </li>
                </ol>
                </li>
              </ol>

          </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

<script type="text/javascript"></script>
<script>
    function getemailmobile()
    {
        var phone = $('#phoneno').val();
        var email = $('#email').val();
        //alert(phone);
        //alert(email);
        $('.otpsendlabel').html('OTP will be sent to validate the Mobile Number (' + phone +') and Email ID (' + email +').');
    }
</script>
