$(document).ready(function(){
    if($(window).width() < 990){
      $('.stickyloactionwrap').removeClass('sticky');
      $(window).on('scroll', function(){
       $('.stickyloactionwrap').removeClass('sticky');
      })
    }
    
    var reg_text='Let’s create your account.';
    
    $('#reg_text').text(reg_text);
    
    
    var gal = $('#ClientsSays');
    gal.owlCarousel({
      items:3,
      loop:true,
      margin:0,
      dots: false,
      nav: true,
      navText : ['<i class="ico ico-left-arrow-o"></i>','<i class="ico ico-right-arrow-o"></i>'],
      responsive:{
        0: {
          items: 1
        },
        440: {
          items: 1
        },
        500: {
          items: 1
        },
        600: {
          items: 1
        },
        767: {
          items: 2
        },
        999: {
          items: 3
        },
        1100: {
          items: 3
        }
      },
    });

    var value = $('.valueSlide');
    value.owlCarousel({
      items:1,
      loop:true,
      margin:0,
      dots: true,
      nav: true,
      navText : ['<i class="sarrow"></i>','<i class="sarrow"></i>'],
      responsive:{
        0: {
          items: 1
        },
        440: {
          items: 1
        },
        500: {
          items: 1
        },
        600: {
          items: 1
        },
        767: {
          items: 1
        },
        999: {
          items: 1
        },
        1100: {
          items: 1
        }
      },
    });
    var owl = $('.TMTestimonial');
    owl.owlCarousel({
      items:3,
      autoplay: false,
      loop:true,
      margin:0,
      center: true,
      dots: false,
      nav: true,
      rewind: true,
      navText : ['<i class="ico ico-left-arrow-o"></i>','<i class="ico ico-right-arrow-o"></i>'],
      responsive:{
        0: {
          items: 1,
        },
        440: {
          items: 2,
        },
        500: {
          items: 2,
        },
        600: {
          items: 2,
        },
        767: {
          items: 3,
        },
        999: {
          items: 4
        },
        1100: {
          items: 4
        },
        1200: {
          items: 4
        }
      },
    });
    $('.fullslide_content .owl-carousel').owlCarousel({
    items: 1,
    margin:0,
    nav: true,
    dots: false,
    loop: true,
    autoplay: true,
    autoplayTimeout:5000,
    autoplayHoverPause:false,
    navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
  });
      $('.fileinput input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $(this).next('.filetext').val(fileName);
      });

    // ScrollBar  
    $('.customscroll').enscroll({ 
      showOnHover: false, 
      verticalTrackClass: 'track',  
      verticalHandleClass: 'handle' 
    });
    // User Dropdown 08012020
    $("#UserDrop").click(function(e){
      $("#UserDropBox").slideToggle("fast");
    });
      
    $('body').prepend( $( '<div class="layoutovarlay"></div>' ) );
    $('.navigationinner').prepend( $( '<div class="layoutovarlay2"></div>' ) );
    $("#NavBar").click(function () {
      $("body").toggleClass('layout-expanded2');
    });
    $('.layoutovarlay2').on('click', function(e){
      e.preventDefault();
      if($("body").hasClass('layout-expanded2')){
        $("body").removeClass('layout-expanded2');
      }
    });
    $('body').prepend( $( '<div class="Layoutovarlay-DeskNav"></div>' ) );
    $(".DskNavbar").click(function () {
      $("body").toggleClass('LayoutExpandedDeskNav');
    });
    $('.Layoutovarlay-DeskNav').on('click', function(e){
      e.preventDefault();
      if($("body").hasClass('LayoutExpandedDeskNav')){
        $("body").removeClass('LayoutExpandedDeskNav');
      }
    });
    // 13042020
    $('body').prepend( $( '<div class="layoutovarlay-dashboard"></div>' ) );
    $("#DashNav").click(function () {
      $("body").toggleClass('layout-expanded-dash');
    });
    $('.layoutovarlay-dashboard').on('click', function(e){
      e.preventDefault();
      if($("body").hasClass('layout-expanded-dash')){
        $("body").removeClass('layout-expanded-dash');
      }
    });
    // Navigation
    $('.sf-menu').each(function(index, value){
      var _that = $(this);
      _that.find("li").each(function(i, v){
        if($(this).children('ul').length > 0){
          $(this).addClass('parent');
        }
        else{
          $(this).removeClass('parent');
        }
      });
      _that.find("li").on('click', '.slidedown', function(e){
        e.stopPropagation();
        var _thatItem = $(this).closest('li');
        console.log('hello');
         
        _thatItem.children('ul').slideToggle(200, function(){
          if(!_thatItem.children('.slidedown').hasClass('slideup')){
            _thatItem.children('.slidedown').addClass('slideup');
          }
          else{
            _thatItem.children('.slidedown').removeClass('slideup');
          }
        });
        
        $(this).parent('li').siblings('li').each(function(index, val) {
          $(val).find('.slidedown').removeClass('slideup');
          $(val).find('ul').slideUp(200);
        })
      })
    });
    $('li.parent').prepend( $( '<span class="slidedown"></span>' ) );




    // scroll top
    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
          $('.scrollup').fadeIn();
      } else {
          $('.scrollup').fadeOut();
      }
    });
    $('.scrollup').click(function () {
      $("html, body").animate({
        scrollTop: 0
      }, 600);
      return false;
    });

    $("#RepairingBtn").click(function() {
      if($(window).width() < 990){

        $('html, body').animate({
          scrollTop: $("#RepairingService").offset().top 
        }, 800);
      }
      if($('.sticky').length == 0 && ($(window).width() > 990)){
        console.log('ok')

         $('html, body').animate({
          scrollTop: $("#RepairingService").offset().top - 120
        }, 800);
      }
      if($('.sticky').length == 1 && ($(window).width() > 990)){
        console.log('ok')
         $('html, body').animate({
          scrollTop: $("#RepairingService").offset().top - $('.sticky').outerHeight()
        }, 800);
      }
    });

    $("#QualityAssurance").click(function() {
      if($(window).width() < 990){

        $('html, body').animate({
          scrollTop: $("#Quality").offset().top 
        }, 800);
      }
      if($('.sticky').length == 0 && ($(window).width() > 990)){
        console.log('ok')

         $('html, body').animate({
          scrollTop: $("#Quality").offset().top - 120
        }, 800);
      }
      if($('.sticky').length == 1 && ($(window).width() > 990)){
        console.log('ok')
         $('html, body').animate({
          scrollTop: $("#Quality").offset().top - $('.sticky').outerHeight()
        }, 800);
      }
    });

    $("#GetInstant").click(function() {
      if($(window).width() < 990){

        $('html, body').animate({
          scrollTop: $("#GetInstantBox").offset().top 
        }, 800);
      }
      if($('.sticky').length == 0 && ($(window).width() > 990)){
        console.log('ok')

         $('html, body').animate({
          scrollTop: $("#GetInstantBox").offset().top - 120
        }, 800);
      }
      if($('.sticky').length == 1 && ($(window).width() > 990)){
        console.log('ok')
         $('html, body').animate({
          scrollTop: $("#GetInstantBox").offset().top - $('.sticky').outerHeight()
        }, 800);
      }
    });

    $("#ScheduleAppointment").click(function() {
      if($(window).width() < 990){

        $('html, body').animate({
          scrollTop: $("#ScheduleAppointmentBox").offset().top 
        }, 800);
      }
      if($('.sticky').length == 0 && ($(window).width() > 990)){
        console.log('ok')

         $('html, body').animate({
          scrollTop: $("#ScheduleAppointmentBox").offset().top - 120
        }, 800);
      }
      if($('.sticky').length == 1 && ($(window).width() > 990)){
        console.log('ok')
         $('html, body').animate({
          scrollTop: $("#ScheduleAppointmentBox").offset().top - $('.sticky').outerHeight()
        }, 800);
      }
    });

    $("#PaySecurely").click(function() {
      if($(window).width() < 990){

        $('html, body').animate({
          scrollTop: $("#PaySecurelyBox").offset().top 
        }, 800);
      }
      if($('.sticky').length == 0 && ($(window).width() > 990)){
        console.log('ok')

         $('html, body').animate({
          scrollTop: $("#PaySecurelyBox").offset().top - 120
        }, 800);
      }
      if($('.sticky').length == 1 && ($(window).width() > 990)){
        console.log('ok')
         $('html, body').animate({
          scrollTop: $("#PaySecurelyBox").offset().top - $('.sticky').outerHeight()
        }, 800);
      }
    });

    $("#GetInstant2").click(function() {
      if($(window).width() < 990){

        $('html, body').animate({
          scrollTop: $("#GetInstantBox2").offset().top 
        }, 800);
      }
      if($('.sticky').length == 0 && ($(window).width() > 990)){
        console.log('ok')

         $('html, body').animate({
          scrollTop: $("#GetInstantBox2").offset().top - 120
        }, 800);
      }
      if($('.sticky').length == 1 && ($(window).width() > 990)){
        console.log('ok')
         $('html, body').animate({
          scrollTop: $("#GetInstantBox2").offset().top - $('.sticky').outerHeight()
        }, 800);
      }
    });

    $("#ScheduleAppointment2").click(function() {
      if($(window).width() < 990){

        $('html, body').animate({
          scrollTop: $("#ScheduleAppointmentBox2").offset().top 
        }, 800);
      }
      if($('.sticky').length == 0 && ($(window).width() > 990)){
        console.log('ok')

         $('html, body').animate({
          scrollTop: $("#ScheduleAppointmentBox2").offset().top - 120
        }, 800);
      }
      if($('.sticky').length == 1 && ($(window).width() > 990)){
        console.log('ok')
         $('html, body').animate({
          scrollTop: $("#ScheduleAppointmentBox2").offset().top - $('.sticky').outerHeight()
        }, 800);
      }
    });

    $("#PaySecurely2").click(function() {
      if($(window).width() < 990){

        $('html, body').animate({
          scrollTop: $("#PaySecurelyBox2").offset().top 
        }, 800);
      }
      if($('.sticky').length == 0 && ($(window).width() > 990)){
        console.log('ok')

         $('html, body').animate({
          scrollTop: $("#PaySecurelyBox2").offset().top - 120
        }, 800);
      }
      if($('.sticky').length == 1 && ($(window).width() > 990)){
        console.log('ok')
         $('html, body').animate({
          scrollTop: $("#PaySecurelyBox2").offset().top - $('.sticky').outerHeight()
        }, 800);
      }
    });
    // QTY 
    $(".incr-btn").on("click", function (e) {
    var $button = $(this);
    var oldValue = $button.parent().find('.quantity').val();
    $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
    if ($button.data('action') == "increase") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
    // Don't allow decrementing below 1
    if (oldValue > 1) {
        var newVal = parseFloat(oldValue) - 1;
    } else {
        newVal = 1;
        $button.addClass('inactive');
    }
    }
    $button.parent().find('.quantity').val(newVal);
    e.preventDefault();
    });
    //Tab Wizard
    $('.nav-tabs-login > li a[title]').tooltip();
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
      var $target = $(e.target);
      if ($target.parent().hasClass('disabled')) {
          return false;
      }
    });
    $(".next-step-btn").click(function (e) {
      var $active = $('.wizard .nav-tabs-login li.active');
      $active.next().removeClass('disabled');
      nextTab($active);
    });
    $(".prev-step-btn").click(function (e) {
      var $active = $('.wizard .nav-tabs-login li.active');
      prevTab($active);
    });
    // after login nav
    // Navigation
    $('.afterloginnav').each(function(index, value){
      var _that = $(this);
      _that.find("li").each(function(i, v){
        if($(this).children('ul').length > 0){
          $(this).addClass('parent');
        }
        else{
          $(this).removeClass('parent');
        }
      });
      _that.find("li").on('click', '.slidedown', function(e){
        e.stopPropagation();
        var _thatItem = $(this).closest('li');
        console.log('hello');
         
        _thatItem.children('ul').slideToggle(200, function(){
          if(!_thatItem.children('.slidedown').hasClass('slideup')){
            _thatItem.children('.slidedown').addClass('slideup');
          }
          else{
            _thatItem.children('.slidedown').removeClass('slideup');
          }
        });
        
        $(this).parent('li').siblings('li').each(function(index, val) {
          $(val).find('.slidedown').removeClass('slideup');
          $(val).find('ul').slideUp(200);
        })
      })
    });
    $('li.parent').prepend( $( '<span class="slidedown"></span>' ) );
    
    //Tab Wizard
    $('.nav-tabs-c-register > li a[title]').tooltip();
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
      var $target = $(e.target);
      if ($target.parent().hasClass('disabled')) {
          return false;
      }
    });
    $(".next-step-btn2").click(function (e) {
      var sname = $('#sname').val();
      var smobile = $('#phoneno').val();
      var semail = $('#semail').val();
      var spassword = $('#spassword').val();
      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var validate = false;

        if(sname==''){
          validate = false;
          $('#sname').css('border','1px solid #ec0000');
        }else{
          validate = true;
          $('#sname').css('border','1px solid #CCCCCC');
        }

        if(smobile=='')
        {
          validate = false;
          $('#phoneno').css('border','1px solid #ec0000');
        }else{
          if(smobile.length != 10)
          { 
            validate = false;
            $("#error-phone").html("Please enter 10 digit valid mobile number");
            $("#error-phone").css('color','#ec0000');
            $('#phoneno').css('border','1px solid #ec0000');
          }else{
            validate = true;
            $('#phoneno').css('border','1px solid #CCCCCC');
            $("#error-phone").html("");
          }
        }

        if(semail=='')
        {
          validate = false;
          $('#semail').css('border','1px solid #ec0000');
        }else{
          if(!regex.test(semail)){
            validate = false;
            $("#error-email").html("Please enter a valid email id");
            $("#error-email").css('color','#ec0000');
            $('#semail').css('border','1px solid #ec0000');
          }else{
            validate = true;
            $('#semail').css('border','1px solid #CCCCCC');
            $("#error-email").html("");
          }
          
        }
        
        if(spassword=='')
        {
          validate = false;
          $('#spassword').css('border','1px solid #ec0000');
        }else{
          validate = true;
          $('#spassword').css('border','1px solid #CCCCCC');
        }

        if(validate==true)
        {
          var $active = $('.wizard .nav-tabs-c-register li.active');
          $active.next().removeClass('disabled');
          nextTab($active);
        }
        
      
    });
    $(".prev-step-btn2").click(function (e) {
      var $active = $('.wizard .nav-tabs-c-register li.active');
      prevTab($active);
    });
    //Tab Wizard
    $('.nav-tabs-normal-register > li a[title]').tooltip();
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
      var $target = $(e.target);
      if ($target.parent().hasClass('disabled')) {
          return false;
      }
    });
    $(".next-step-btn3").click(function (e) {
      //var name = $('#name').val();
      var first_name = $('#first_name').val();
      var last_name = $('#last_name').val();
      var phoneno = $('#phoneno').val();
      var email = $('#email').val();
      var con_password = $('#con_password').val();
      var password = $('#password').val();
      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var validate = false;

        /*if(name==''){
          validate = false;
          $('#name').css('border','1px solid #ec0000');
        }else{
          validate = true;
          $('#name').css('border','1px solid #CCCCCC');
        }
        */
        
        if(first_name==''){
          validate = false;
          $('#first_name').css('border','1px solid #ec0000');
          return false;
        }else{
          validate = true;
          $('#first_name').css('border','1px solid #CCCCCC');
        }
        
        
        if(last_name==''){
          validate = false;
          $('#last_name').css('border','1px solid #ec0000');
          return false;
        }else{
          validate = true;
          $('#last_name').css('border','1px solid #CCCCCC');
        }
        
        

        if(phoneno=='')
        {
          validate = false;
          $('#phoneno').css('border','1px solid #ec0000');
          return false;
        }else{
          if(phoneno.length != 10)
          { 
            validate = false;
            $("#error-phn").html("Please enter 10 digit valid mobile number");
            $("#error-phn").css('color','#ec0000');
            $('#phoneno').css('border','1px solid #ec0000');
            return false;
          }else{
            validate = true;
            $('#phoneno').css('border','1px solid #CCCCCC');
            $("#error-phn").html("");
          }
        }

        if(email=='')
        {
          validate = false;
          $('#email').css('border','1px solid #ec0000');
          return false;
        }else{
          if(!regex.test(email)){
            validate = false;
            $("#error-email").html("Please enter a valid email id");
            $("#error-email").css('color','#ec0000');
            $('#email').css('border','1px solid #ec0000');
            return false;
          }else{
            validate = true;
            $('#email').css('border','1px solid #CCCCCC');
            $("#error-email").html("");
             
          }
          
        }
        
        if(password=='')
        {
          validate = false;
          $('#password').css('border','1px solid #ec0000');
           return false;
        }else{
          validate = true;
          $('#password').css('border','1px solid #CCCCCC');
        }
        
        if(con_password=='')
        {
          validate = false;
          $('#con_password').css('border','1px solid #ec0000');
          return false;
        }else{
            
            if(con_password == password){
                
                 validate = true;
                 $('#con_password').css('border','1px solid #CCCCCC');
            }else{
                
                 validate = false;
                 $('#con_password').css('border','1px solid #ec0000');
                 return false;
            }
            
            
         
        }
        
        
        /*alert(validate);
        
        return false; */
        

        if(validate==true)
        {
          var $active = $('.wizard .nav-tabs-normal-register li.active');
          $active.next().removeClass('disabled');
          nextTab($active);
        }
      
    });
    $(".prev-step-btn3").click(function (e) {
      var $active = $('.wizard .nav-tabs-normal-register li.active');
      prevTab($active);
    });

    $('[data-toggle="tooltip"]').tooltip();
    $( document ).tooltip({
      position: {
        my: "center bottom-20",
        at: "center top",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      }
    });
    
      rflag = 0;
      $('.moreread').click(function(){
        if(rflag == 0){
          $(this).parent('.readmore_wrap').prev('.ovheight').addClass('showall');
          $(this).text("Read Less");
          rflag = 1;
        }
        else{
           $(this).parent('.readmore_wrap').prev('.ovheight').removeClass('showall');
          $(this).text("Read More");
          rflag = 0;
          return;
        }
      });  

});

//Tab Wizard
function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
    reg_text='Signing up for alitbbe is fast and free';
    
    $('#reg_text').text(reg_text);
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
     var reg_text='Let’s create your account.';
    
    $('#reg_text').text(reg_text);
}