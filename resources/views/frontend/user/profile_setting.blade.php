@extends('layouts.userinner')
@section('title', 'Profile Setting')
@section('content')
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
    <div class="profile_block profileblock">
        <div class="logheading">
          <h2>Account Info</h2>
          
          @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session()->get('success') }}
                </div>
            @endif
             @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
    </div>
    <div class="service_tab">				
      <ul class="nav nav-tabs" role="tablist">
        <li role="Company Details" class="active"><a href="#companyDetails" aria-controls="companyDetails" role="tab" data-toggle="tab">Company Details</a></li>
        <li role="Account info"><a href="#accountInfo" aria-controls="accountInfo" role="tab" data-toggle="tab">Account info</a></li>
      </ul>
      <div class="tab-content">
        <div role="Company Details" class="tab-pane active" id="companyDetails">
          <div style="padding: 10px 0px 0px 0px;">
           <form action="{{ url('user/profile_setting_update')}}" method="post" enctype="multipart/form-data">
               {{csrf_field()}}
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>Company/Business Name</label>
                          <input type="text" name="company_name" class="form-control" placeholder="Company/Business Name" value="{{ (old('company_name'))?old('company_name'):$userdata->company_name }}">
                          @if($errors->has('company_name'))
                          <span class="error">{{$errors->first('company_name')}}</span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>Business Type </label>
                          <select name="business_type" class="form-control">
                              <option value="Private Limited" @if($userdata->business_type=='Private Limited') selected @endif>Private Limited</option>
                              <option value="Proprietorship" @if($userdata->business_type=='Proprietorship') selected @endif>Proprietorship</option>
                              <option value="Individual" @if($userdata->business_type=='Individual') selected @endif>Individual</option>
                              <option value="Public Limited" @if($userdata->business_type=='Public Limited') selected @endif>Public Limited</option>
                              <option value="LLP" @if($userdata->business_type=='LLP') selected @endif>LLP</option>
                          </select>
                          @if($errors->has('business_type'))
                          <span class="error">{{$errors->first('business_type')}}</span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>GSTIN</label>
                          <input type="text" name="gstin" class="form-control" placeholder="GSTIN" value="{{ (old('gstin'))?old('gstin'):$userdata->gst }}">
                          @if($errors->has('gstin'))
                          <span class="error">{{$errors->first('gstin')}}</span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>Pin Code</label>
                          <input type="text" name="pincode" class="form-control" placeholder="Pin Code" value="{{ (old('pincode'))?old('pincode'):$userdata->pin_code }}">
                          @if($errors->has('pincode'))
                          <span class="error">{{$errors->first('pincode')}}</span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label>Address</label>
                          <textarea name="address" class="form-control" rows="5">{{ (old('address'))?old('address'):$userdata->address }}</textarea>
                          @if($errors->has('address'))
                          <span class="error">{{$errors->first('address')}}</span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>City</label>
                          <input type="text" name="city" class="form-control" placeholder="City" value="{{ (old('city'))?old('city'):$userdata->city }}">
                          @if($errors->has('city'))
                          <span class="error">{{$errors->first('city')}}</span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>State</label>
                          <input type="text" name="state" class="form-control" placeholder="State" value="{{ (old('state'))?old('state'):$userdata->state }}">
                          @if($errors->has('state'))
                          <span class="error">{{$errors->first('state')}}</span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>Country</label>
                          <input type="text" name="country" class="form-control" placeholder="Country" value="{{ (old('country'))?old('country'):$userdata->country }}">
                          @if($errors->has('country'))
                          <span class="error">{{$errors->first('country')}}</span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>Number of Service Engineer/RSO</label>
                          <input type="text" name="number_of_service" class="form-control" placeholder="Number of Service Engineer/RSO" value="{{ (old('number_of_service'))?old('number_of_service'):$userdata->number_of_service }}">
                          @if($errors->has('number_of_service'))
                          <span class="error">{{$errors->first('number_of_service')}}</span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>Name of RSO/Service Engineer</label>
                          <input type="text" name="name_of_service_eng" class="form-control" placeholder="Name of RSO/Service Engineer" value="{{ (old('name_of_service_eng'))?old('name_of_service_eng'):$userdata->name_of_serv_eng }}">
                          @if($errors->has('name_of_service_eng'))
                          <span class="error">{{$errors->first('name_of_service_eng')}}</span>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label>Service Engineer/RSO Certificate</label><br>
                          @if($userdata->rso_certificate) <img src="{{ asset(str_replace('public','',$userdata->rso_certificate)) }}" class="thumbnail" style="height:100px; width:auto; margin-bottom: 8px;"> @endif
                          <input type="file" name="service_engineer_certificate" class="form-control" value="">
                          @if($errors->has('service_engineer_certificate'))
                          <span class="error">{{$errors->first('service_engineer_certificate')}}</span>
                          @endif
                      </div>
                  </div>
                  
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label>AERB Authorisation Letter</label><br>
                          @if($userdata->auth_letter) <img src="{{ asset(str_replace('public','',$userdata->auth_letter)) }}" class="thumbnail" style="height:100px; width:auto; margin-bottom: 8px;"> @endif
                          <input type="file" name="aerb_auth_letter" class="form-control" placeholder="AERB Authorisation Letter" value="">
                          @if($errors->has('aerb_auth_letter'))
                          <span class="error">{{$errors->first('aerb_auth_letter')}}</span>
                          @endif
                      </div>
                  </div>
              </div>
              
              <div class="form-group">
                  <input type="submit" class="btn btn-success" value="Update">
              </div>
              
          </form>
          </div>
        </div>
        <div role="Account info" class="tab-pane" id="accountInfo">
            <div style="padding: 10px 0px 0px 0px;">
                <h2>Contact Person</h2>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="OpenOrders" class="active"><a href="#headInstitute" aria-controls="headInstitute" role="tab" data-toggle="tab">Head of the Company</a></li>
                    <li role="Orders"><a href="#Contact" aria-controls="Contact" role="tab" data-toggle="tab">Contact Person</a></li>
                    <li role="presentation"><a href="#loginInfo" aria-controls="loginInfo" role="tab" data-toggle="tab">Login Info</a></li>
                </ul>
                  <div class="tab-content">
                    <div role="OpenOrders" class="tab-pane active" id="headInstitute">
                      <div style="padding: 10px 0px 0px 0px;">
                       <form action="{{ url('user/headof-institute')}}" method="post">
                           {{csrf_field()}}
                          <div class="form-group">
                              <label>Name</label>
                              <input type="text" name="name" class="form-control" placeholder="Name" value="@if(!empty($head_info->name)){{$head_info->name}}@endif">
                              @if($errors->has('name'))
                              <span class="error">{{$errors->first('name')}}</span>
                              @endif
                          </div>
                          <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="email" class="form-control" placeholder="Email" value="@if(!empty($head_info->email)){{$head_info->email}}@endif">
                              @if($errors->has('email'))
                              <span class="error">{{$errors->first('email')}}</span>
                              @endif
                          </div>
                          <div class="form-group">
                              <label>Mobile Number</label>
                              <input type="text" name="mobile_no" class="form-control" placeholder="Mobile No." value="@if(!empty($head_info->mobile)){{$head_info->mobile}}@endif">
                              @if($errors->has('mobile_no'))
                              <span class="error">{{$errors->first('mobile_no')}}</span>
                              @endif
                          </div>
                          <div class="form-group">
                              <input type="submit" class="btn btn-primary" value="Save">
                          </div>
                      </form>
                      </div>
                    </div>
                    <div role="Orders" class="tab-pane" id="Contact">
                        <div style="padding:30px;">
                           <form action="{{ url('user/contact-info')}}" method="post">
                               {{csrf_field()}}
                              <div class="form-group">
                                  <label>Name</label>
                                  <input type="text" name="name" class="form-control" placeholder="Name" value="@if(!empty($contact_info->name)){{$contact_info->name}}@endif">
                                  @if($errors->has('name'))
                                  <span class="error">{{$errors->first('name')}}</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Email</label>
                                  <input type="email" name="email" class="form-control" placeholder="Email" value="@if(!empty($contact_info->email)){{$contact_info->email}}@endif">
                                  @if($errors->has('email'))
                                  <span class="error">{{$errors->first('email')}}</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Mobile Number</label>
                                  <input type="text" name="mobile_no" class="form-control" placeholder="Mobile No." value="@if(!empty($contact_info->mobile)){{$contact_info->mobile}}@endif">
                                  @if($errors->has('mobile_no'))
                                  <span class="error">{{$errors->first('mobile_no')}}</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <input type="submit" class="btn btn-primary" value="Save">
                              </div>
                          </form>
                          </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="loginInfo">
                        <div style="padding: 10px 0px 0px 0px;">
                           <form action="{{ url('user/update-info')}}" method="post">
                               {{csrf_field()}}
                              <div class="form-group">
                                  <label>Email</label>
                                  <input type="email" name="email" class="form-control" placeholder="Email" value="@if(!empty($user_info->email)){{$user_info->email}}@endif">
                                  @if($errors->has('email'))
                                  <span class="error">{{$errors->first('email')}}</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>Phone</label>
                                  <input type="text" name="mobile_no" class="form-control" placeholder="Mobile No." value="@if(!empty($user_info->phoneno)){{$user_info->phoneno}}@endif">
                                  @if($errors->has('mobile_no'))
                                  <span class="error">{{$errors->first('mobile_no')}}</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <h3>Change Password</h3>
                              </div>
                              <div class="form-group">
                                  <label>Old Password</label>
                                  <input type="password" name="old_password" class="form-control" placeholder="Old Password">
                                  @if($errors->has('mobile_no'))
                                  <span class="error">{{$errors->first('old_password')}}</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label>New Password</label>
                                  <input type="text" name="new_password" class="form-control" placeholder="New Password">
                                  @if($errors->has('mobile_no'))
                                  <span class="error">{{$errors->first('new_password')}}</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <input type="submit" class="btn btn-primary" value="Save">
                              </div>
                          </form>
                          </div>
                    </div>
                  </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection