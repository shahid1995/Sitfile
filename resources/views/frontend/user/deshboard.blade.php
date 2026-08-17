@extends('layouts.userinner')
@section('title', 'Profile')
@section('content')
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
  <div class="profile_block myorderouter">
    <div class="logheading">
      <h2>Dashboard</h2>
    </div>
    <div class="service_tab">       
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#RevenueChart" aria-controls="RevenueChart" role="tab" data-toggle="tab">Revenue Chart</a></li>
        <li role="presentation"><a href="#BiddingChart" aria-controls="BiddingChart" role="tab" data-toggle="tab">Bidding Chart</a></li>
        <li role="presentation"><a href="#PaymentSummary" aria-controls="PaymentSummary" role="tab" data-toggle="tab">Payment Summary</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="RevenueChart">
          <div class="plan_history">
            <div class="cheadbx">
              <h3>Revenue Chart</h3>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="BiddingChart">
          <div class="plan_history">
            <div class="cheadbx">
              <h3>Bidding Chart</h3>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="PaymentSummary">
          <div class="plan_history">
            <div class="cheadbx">
              <h3>Payment Summary</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection