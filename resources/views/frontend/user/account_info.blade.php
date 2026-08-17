@extends('layouts.userinner')
@section('title', 'Account Info')
@section('content')

<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
  <div class="profile_block myorderouter">
    <div class="logheading">
      <h2>Account Info</h2>
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
    <div class="service_tab">				
      <ul class="nav nav-tabs" role="tablist">
        <li role="OpenOrders" class="active"><a href="#headInstitute" aria-controls="headInstitute" role="tab" data-toggle="tab">Head of the Institute</a></li>
        <li role="Orders"><a href="#Contact" aria-controls="Contact" role="tab" data-toggle="tab">Contact Person</a></li>
        <li role="presentation"><a href="#loginInfo" aria-controls="loginInfo" role="tab" data-toggle="tab">Login Info</a></li>
      </ul>
      <div class="tab-content">
        <div role="OpenOrders" class="tab-pane active" id="headInstitute">
          <div style="padding:10px 0px 0px 0px;">
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
                  <input type="text" id='phoneno' name="mobile_no" class="form-control" placeholder="Mobile No." value="@if(!empty($head_info->mobile)){{$head_info->mobile}}@endif">
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
            <div style="padding:10px 0px 0px 0px;">
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
            <div style="padding:10px 0px 0px 0px;">
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

@endsection