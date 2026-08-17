<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ $data['site_meta_description'] }}">
<meta name="keywords" content="{{ $data['site_meta_keywords'] }}">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon"  sizes="32x32" href='{{asset("images/favicon.ico") }}' />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 
<!-- GoogleFonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700|Roboto:300,400,500,700&display=swap" rel="stylesheet" />
<link rel="preload" href='{{asset("fonts/font-awesome/fonts/fontawesome-webfont.woff2?v=4.7.0") }}' as="font" type="font/woff2" crossorigin>
<link rel="preload" href='{{asset("fonts/svg/icomoon.ttf?7vfwjk") }}' as="font" type="font/ttf" crossorigin>
<link rel="preload" href='{{asset("fonts/Gotham-Bold.woff2") }}' as="font" type="font/ttf" crossorigin>
<link rel="preload" href='{{asset("fonts/Gotham-Light.woff2") }}' as="font" type="font/ttf" crossorigin>
<link rel="preload" href='{{asset("fonts/Gotham-Medium.woff2") }}' as="font" type="font/ttf" crossorigin>

<!-- FontAwesome -->
<link href='{{asset("fonts/font-awesome/css/font-awesome.min.css") }}' rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/vendor.min.css')}}">
<!-- CustomCss -->
<link href='{{ asset("css/style.css") }}' rel="stylesheet" type="text/css" />
<link href='{{ asset("css/media.css")}}' rel="stylesheet" type="text/css" />

<!--  -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src='{{ asset("js/jquery.validate.js")}}'></script>

<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script>
var base_url="{{url("/")}}";
var token = $('meta[name="csrf-token"]').attr('content');
</script>
<style type="text/css">
.success-block {
    color: #116311;
    font-size: 12px;
    font-weight: bold;
}
.userimg{
	position: relative;
}
.userimg .uploadimage{
	position: absolute;
    right: -50px;
    top: 19px;
    z-index: 1;
    background: #f44336;
    width: 30px;
    height: 30px;
    line-height: 32px;
    text-align: center;
    color: #ffffff;
    text-decoration: none;
    font-size: 13px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    cursor: pointer;
    -webkit-transition: 0.3s ease-in-out;
    transition: 0.3s ease-in-out;
}
.userimg:hover .uploadimage{right: 25px;}
.userimg .uploadimage i{
	font-size:16px;
	margin-left: 2px;
}
.left_icon {
    float: left;
    margin-right: 10px;
}
</style>
<script type="text/javascript"> var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode:"44a601eeefb35d9db676fb608d3b776995d6bcc3480aa8637996385972d9adb96d6460c327834253d2a1bb2c3985c671", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zoho.com/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);d.write("<div id='zsiqwidget'></div>"); </script>