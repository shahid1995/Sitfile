@extends('layouts.userinner')
@section('title', 'Bank Account Details')
@section('content')
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
    <div class="profile_block">
        <div class="logheading">
          <h2>Bank Account Details</h2>
          
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
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ url('user/save-bank-details') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <lable>Branch IFSC Code</lable>
                            <input type="text" name="branch_ifsc" placeholder="Branch IFSC Code" class="form-control" value="{{ $acc_details->branch_ifsc }}" required>
                            @if($errors->has('branch_ifsc'))
                              <span class="error">{{$errors->first('branch_ifsc')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <lable>Account Number</lable>
                            <input type="text" name="acc_number" placeholder="Account Number" class="form-control" value="{{ $acc_details->acc_number }}" required>
                            @if($errors->has('acc_number'))
                              <span class="error">{{$errors->first('acc_number')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <lable>Re-Enter Account Number</lable>
                            <input type="text" name="conf_acc_number" placeholder="Re-Enter Account Number" class="form-control" required>
                            @if($errors->has('conf_acc_number'))
                              <span class="error">{{$errors->first('conf_acc_number')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <lable>Beneficiary Name</lable>
                            <input type="text" name="beneficary_name" placeholder="Beneficiary Name" class="form-control" value="{{ $acc_details->name }}" required>
                            @if($errors->has('beneficary_name'))
                              <span class="error">{{$errors->first('beneficary_name')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection