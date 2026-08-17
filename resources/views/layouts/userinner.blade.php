<!DOCTYPE html>
<html>
<head>
<title>Awzonex - @yield('title')</title>
@include('partial.head_new')
</head>
<body>

<!-- header elements -->

<!-- header elements -->

<section class="dashboard profilecontainer">
    <div class="dashboardcontainer">
        <div class="sidenav">
            <!-- user left elements -->
		    @include('partial.userleftsidebar')
		    <!-- user left elements -->
        </div>
        <div class="layoutcontainer">
            <div class="layoutcontent">
                <div class="layoutcontentinner">
                    <div class="dashboardcontentcenter">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="dashheader">
                                    
                                    <div class="dashlogo"><a href="{{ url('/') }}"><img src="{{ asset('images/logo-sticky.png')}}" alt="" /></a></div>
                                    <div class="pull-right">
                                        <a class="dashnav" id="DashNav" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
                                        @auth
                						<div class="userimgbx">
                							<a id="UserDrop" class="useprofilerimg" href="javascript:void(0);">
                								@php
                									if(Auth::user()->roll_id == '2'):
                									if(!empty(Auth::user()->company_logo)):
                								@endphp
                								<img src="{{ url('/') }}/public/images/upload/service/{{ Auth::user()->company_logo}}" alt="" />
                								@php
                								else:
                								@endphp
                								<img src="{{ url('/public/images/user_icon.png') }}" alt="" />
                								@php
                								endif;
                									elseif(Auth::user()->roll_id == '1'):
                									if(!empty(Auth::user()->profile_picture)):
                								@endphp
                								<img src="{{ url('/') }}/public/{{ Auth::user()->profile_picture }}" alt="" />
                								@php
                								else:
                								@endphp
                								<img src="{{ url('/public/images/user_icon.png') }}" alt="" />
                								@php
                									endif;
                									endif;
                								@endphp
                							</a>
                							<div id="UserDropBox" class="userdropdown">
                								<ul>
                									<li><a href="{{url('user/profile')}}"><i class="fa fa-user-o"></i>Account Setting</a></li>
                									<li><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i>Sign Out</a></li>
                								</ul>
                							</div>
                						</div>
                						@endauth
                					</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="dscontent">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('partial.scripts')
<script>
    @if(Request::segment(2)=='institute-details' || Request::segment(2)=='institute-details-create' || Request::segment(2)=='equipment-details' || Request::segment(2)=='equipment-details-create' || Request::segment(2)=='account-info')
        $("#setting-nav").addClass('active');
        $("#setting-nav-list").css('display','block');
    @endif
    @if(Request::segment(2)=='qa-expiration')
        $("#dashboard-nav").addClass('active');
        $("#dashboard-nav-list").css('display','block');
    @endif
    @if(Request::segment(2)=='active-offer' || Request::segment(2)=='expired-offer')
        $("#active-offer").addClass('active');
        $("#request-service-nav").css('display','block');
    @endif
</script>
</body>
</html>
