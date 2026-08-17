<!--jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset("js/bootstrap.min.js")}}"></script>
<script src="{{ asset("js/owl.carousel.min.js")}}"></script>
<script src="{{ asset("js/parallax.min.js")}}"></script>
<script src="{{ asset("js/sticky-menu.js")}}"></script>
<script src="{{ asset("js/custom.js") }}"></script>
<script src="{{ asset('js/readMoreJS.min.js') }}"></script>
<script src="{{ asset('js/enscroll-0.6.1.min.js') }}"></script>
<!-- wow animation -->
<script src="{{ asset("js/wow.js") }}"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  $('#xray_mechine').selectpicker();

  $('#datepicker').datepicker({
    dateFormat:'yy-mm-dd'
  });

  $('#datetime2').datepicker({
    dateFormat:'yy-mm-dd'
  });


</script>
<script>
  wow = new WOW(
    {
      animateClass: 'animated',
      offset:       100,
      callback:     function(box) {
      console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
      }
    }
  );
  wow.init();

  



  $(document).ready(function() {

    $readMoreJS.init({
      target: '.dummy p',
      numOfWords: 50,
      toggle: true,
      moreLink: 'read more ...',
      lessLink: 'read less'
    });

  } );

  $(document).ready( function() {

    $('#datepicker3').datepicker({
      dateFormat:'yy-mm-dd'
    });
      
    $('#switch').on('change', function(){
      if($('#switch').prop("checked") == true)
      {
        $('#branch-div').css('display','block');
        $('.operating_location').append('<li class="brn_1"></li>');
        $('.brn_1').hide();
      }else{
        $('#branch-div').css('display','none');
        $('.brn_1').remove();
      }
    });

    var op_locate = $('#operator_location').val();
    $('.operating_location').append('<li class="brn">'+op_locate+'</li>');

    $('#operator_location').on('blur', function(){
      var op_locate = $('#operator_location').val();
      if(op_locate!=''){
        $('.brn').show();
       $('.brn').html(op_locate);
      }else{
        $('.brn').hide();
      }
    });


    var i=2;
    var j=2;

    $('#addbranch').click( function(){

      var idd="'"+"brn_"+j+"'";
       $('#showbranch').append('<div class="groupinner" id="branch_'+i+'"><i class="fa fa-search"></i> <a class="removebtn" onclick="remove('+i+','+idd+')">x</a><input type="text" class="form-control" value="" name="branch[]" onblur="showbanchlist('+idd+',this.value)">             </div>');
       $('.operating_location').append('<li class="brn_'+j+'"></li>');
        $('.brn_'+j).hide();
       i++;
       j++;
    });

    $('#send-otp').click( function(){
      var phoneno = $('#phoneno').val();
      if(phoneno=='')
      {
        $('#phoneno').focus();
      }
      if(phoneno.length<10 || phoneno.length>10)
      {
        $('#error-phn').html('Please enter 10 digit valid mobile number');
      }else{
        $('#error-phn').html('');

        $.ajax({
          url: "{{url("/sendotp")}}",
          type:'GET',
          data:{'phoneno':phoneno },
          success: function(resultData){
            $("#input-otp").val(resultData);
          }
        });
        $('#success-phn').html('OTP Send Successfully');

      }
    });


    $('#phoneno').keypress(function (event) {
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
    });

  });

  function remove(val, br_id){
    $('#branch_'+val).remove();
    $('.'+br_id).remove();
  }

  function showbanchlist(br_id, val)
  {
   // alert(br_id);
    if(val!='')
    {
      $('.'+br_id).html(val);
      $('.'+br_id).show();
    }else{
      $('.'+br_id).hide();
    }
  }

  function loadequipment(val)
  {
    $.ajax({
      url:'{{ url('/getmenufacturer')}}',
      type:'get',
      data:{'xray_id':val},
      success: function(data)
      {
        $result = jQuery.parseJSON(data);
        $('#manufacturer').html('<option>'+$result.menufacturer.machine_type+'</option>');
      }
    })
  }

function getequipmentdtls(val)
{
  $.ajax({
            url: "{{url('user/getequipmentdtls')}}",
            data: {
                    term : val
             },
            dataType: "json",
            success: function(data){
               var resp = $.map(data,function(obj){
                    console.log(obj.brand);
                    $("#equipment_1").val(obj.equipment);
                    $("#brand_1").val(obj.brand);
                    $("#model_1").val(obj.model);
                    $("#branch_1").val(obj.branch_id);
               });                
            }
});
}
</script>

<!-- <script type="text/javascript">
    var path = "{{ url('user/getequipment') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script> -->

<script>
$(document).ready(function(){

  $("#sregister-form").validate({
      rules: {
        name: "required",
        mobileno: {
          required: true,
          minlength: 10
        },
        email: {
          required: true,
          email: true
        },
        password: "required",
        company_name: "required",
        gstin: "required",
        pincode:{
          required: true,
          minlength: 6
        },
        address:"required",
        country: "required",
        state: "required",
        number_of_serv_eng: "required",
        name_of_serv_eng: "required",
      },
      messages: {
        name: "Please enter your name",
        username: {
          required: "Please enter valid mobile number",
          minlength: "Your mobile no must consist of 10 digit"
        },
        password: "Please provide a password",
        email: "Please enter a valid email address",
        company_name: "Please enter business/company name",
        gstin: "Please enter company GSTIN number",
        pincode: "Please enter pincode",
      }
    });




  $( "#search_equipment" ).autocomplete({
 
        source: function(request, response) {
            $.ajax({
            url: "{{url('user/getequipment')}}",
            data: {
                    term : request.term
             },
            dataType: "json",
            success: function(data){
               var resp = $.map(data,function(obj){
                    //console.log(obj.model_title);
                    return obj.machine_type;
               }); 
 
               response(resp);
            }
        });
    },
    minLength: 1
 });
 var count=1;
$("#add-equipment").click( function(){
  var equipment = $("#equipment").val();
  var manufacturer = $("#manufacturer").val();
  var loadmodel = $("#loadmodel").val();
  var branch = $("#branch").val();
  var equipment_1 = $("#equipment_1").val();
  var brand_1 = $("#brand_1").val();
  var model_1 = $("#model_1").val();
  var branch_1 = $("#branch_1").val();
  var number_equip = $("#number_equip").val();

  // var inputs = $(".wizardform").serializeArray();
  // var formObj = {};
  // $.each(inputs, function (i, input) {
  //       formObj[input.name] = input.value;
  //   });
  //   console.log(formObj);
 
  if(equipment!='' & manufacturer!='' & loadmodel!='' & branch!=''){
  var id1="'"+"equipmentbox"+count+"'";
  $("#addlistequipment").append(
    '<div class="equipmentbox" id="equipmentbox'+count+'"><dl class="dl-horizontal"><dt>Type of equipment:</dt><dd>'+equipment+'</dd><dt>Manufacturer:</dt><dd>'+manufacturer+'</dd><dt>Model Name:</dt><dd>'+loadmodel+'</dd><dt>Branch:</dt><dd>'+branch+'</dd><dt>Quality:</dt><dd>'+number_equip+' Nos</dd></dl><div class="actiongroup"><a class="trashbtn" href="javascript:void();" onclick="removeeq('+id1+')">x</a></div> </div>');
  $(".equipmentdtls").append('<li>'+equipment+'</li>');

  $("#equipment").val('');
  $("#manufacturer").val('');
  $("#loadmodel").val('');
  $("#branch").val('');
}
count++;
if(equipment_1!='' & brand_1!='' & model_1!='' & branch_1!=''){
  var id2="'"+"equipmentbox"+count+"'";
  $("#addlistequipment").append(
    '<div class="equipmentbox" id="equipmentbox'+count+'"><dl class="dl-horizontal"><dt>Type of equipment:</dt><dd>'+equipment_1+'</dd><dt>Manufacturer:</dt><dd>'+brand_1+'</dd><dt>Model Name:</dt><dd>'+model_1+'</dd><dt>Branch:</dt><dd>'+branch_1+'</dd><dt>Quality:</dt><dd>'+number_equip+' Nos</dd></dl><div class="actiongroup"><a class="trashbtn" onclick="removeeq('+id2+')" href="javascript:void();">x</a></div> </div>');
  $(".equipmentdtls").append('<li>'+equipment_1+'</li>');
  $("#equipment_1").val('');
  $("#brand_1").val('');
  $("#model_1").val('');
  $("#branch_1").val('');
}
count++;

//   var arr = $('#equipments-all div').map(function(){
//       var  correctAnswer = $(this).closest('.form-control').find('#equipment').val();
//   alert(correctAnswer);
// });

  // for(i=0; i < arr.length; i++)
  //   alert(arr[i]);
});

 // $('#search_equipment').keyup(function(){ 
 //        var query = $(this).val();
 //        if(query != '')
 //        {
 //         $.ajax({
 //          url:"{{ url('user/getequipment') }}",
 //          method:"get",
 //          data:{query:query},
 //          success:function(data){
 //            //console.log(data);
 //           $('#search_result').fadeIn();  
 //           $('#search_result').html(data);
 //          }
 //         });
 //        }
 //    });

 //    $('.slist').click( function(){
 //      console.log('chk');
 //        $('#search_equipment').val($(this).text());  
 //        $('#search_result').fadeOut();  
 //    });  


    // $("#step1").attr('disabled','true');
    // $("#step2").attr('disabled','true');

    // $("form").bind("keypress", function(e) {
    //         if (e.keyCode == 13) {
    //             return false;
    //         }
    //     });

});

function removeeq(id)
{
  $("#"+id).remove();
}


function monthDiff(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months -= d1.getMonth();
    months += d2.getMonth();
    return months <= 0 ? 0 : months;
}

function calcDate(date1,date2) {
    // var diff = Math.floor(date1.getTime() - date2.getTime());
    // var day = 1000 * 60 * 60 * 24;

    // var days = Math.floor(diff/day);
    // var months = Math.floor(days/31);
    // var years = Math.floor(months/12);

    // var days = date1.getDate()-date2.getDate();
    // var months = date1.getMonth()-date2.getMonth();
    // var years = date1.getFullYear()-date2.getFullYear();
    
    
   //var diffDate1 =  diffDate(date1, date2);
   
   //alert(diffDate1);
        
        if(date1.getDate() > date2.getDate()){
            
            var days = date1.getDate()-date2.getDate();
        }else{
            
            var days = date2.getDate()-date1.getDate();
        }
        
        if(date1.getMonth() > date2.getMonth()){
            
            var months = date1.getMonth()-date2.getMonth();
            
        }else{
            
         var months = date2.getMonth()-date1.getMonth();
        }
        
        if(date1.getFullYear() > date2.getFullYear()){
            
            var years = date1.getFullYear()-date2.getFullYear();
            
        }else{
            
            var years = date2.getFullYear()-date1.getFullYear();
        }
        
        /*var month_d = date1.getMonth();
        var month_d2 = date2.getMonth();
        
        console.log(month_d);
        
        
        date1 = date1.getDate()+'-'+month_d+'-'+date1.getFullYear();
        date2 = date2.getDate()+'-'+month_d2+'-'+date2.getFullYear();*/
        
        //alert(date1.getMonth());
        
       
        /*var date_1 = moment(new Date(date1.substr(0, 16)));
          var  date1 =  date_1.format("DD-MMM-YYYY");
        
        var date_2 = moment(new Date(date2.substr(0, 16)));
          var  date2 =  date_2.format("DD-MMM-YYYY");*/
        
        
         $.ajax({
                  type     : "POST",
                 
                  url      :'<?php echo url(''); ?>/date-calculation',
                  data     : {_token : '{{csrf_token()}}', date1 : date1, date2:date2},
                  cache    : false,

                  success  : function(data) {

                      //alert(data.msg);
                    
                      if(data.msg)
                      {
                        $('#newsletter_succ_msg').text(data.msg);
                      }
                      if(data.errmsg)
                      {
                        $('#newsletter_succ_msg').text(data.errmsg);
                      }
                      
                  }
              });
        
        
        
    
     
    //var months = date1.getMonth()-date2.getMonth();
    
    

    var message='';
    message += parseInt(days) + " days "
    message += parseInt(months) + " months "
    message += parseInt(years) + " years "

    return message
}

$(document).ready( function(){
    
    
    //$('#myModalyes').show();
    
   $("#myModalyes").modal('show');
    
    

  $("#datepicker").on('change', function(){
    var radioValue = $("input[name='response']:checked").val();
    
    var month;
    if(radioValue==1)
    {
       month = 12;
       total_year = 1;
    }else{
       month = 24;
       total_year = 2;
       
    }
    
    //alert(total_year);
    
    //return false;

    d1 = new Date();
    d1.setDate(d1.getDate() + 365);
    d2 = new Date($("#datepicker").val());
    
    //alert("The difference between two dates is: " +monthDiff(d1, d2));
    var datediff = monthDiff(d1, d2);
    
    //alert(month +'----'+ datediff);
    
    //return false;

    var a ='';
    
    //var a = calcDate(d1,d2);
    var date1 = $("#datepicker").val()
    
    $.ajax({
                  type     : "POST",
                 
                  url      :'<?php echo url(''); ?>/date-calculation',
                  data     : {_token : '{{csrf_token()}}', date1 : date1, total_year:total_year},
                  cache    : false,

                  success  : function(data) {

                      //alert(data.msg);
                    
                      if(data)
                      {
                         $('#msgresp').html(data);
                         
                      }
                      
                      
                  }
              });
    
    
    
    
    
    /*if(month > datediff)
    {
      $("#msgresp").html('<div class="alert alert-warning">Your last QA has already expired. Please click on “Get Quote” to proceed</div><div class="bookbtns"><a href="{{url("/")}}" class="bookbtn">Get Quote</a></div>');
    }else if(datediff < month)
    {
      $("#msgresp").html('<div class="alert alert-warning">Your last QA will be expired in <span id="succes_data"> </span> </div><div class="bookbtns"><a href="{{url("/register")}}" class="bookbtn">Remind Me</a></div>');
    }else{
      $("#msgresp").html('');
    }*/

  });


  $("#shedulecall").submit( function(e){
  	e.preventDefault();
  	$.ajax({
            url: "{{url('/schedulecall')}}",
            type:'POST',
            data: $(this).serialize(),
            dataType: "json",
            success: function(data){
               if(data.success){
                 $("#response-msg").html('<div class="alert alert-success">'+data.success+'</div>');
                 $("#datetime2").val('');
                 $("#time").val('');
                 $("#mobile").val('');
               }else{
                $("#response-msg").html('<div class="alert alert-danger">'+data.error+'</div>');
               }

            }
        });
  });
  
  $("#testreminder").submit( function(e){
  	e.preventDefault();
  	$.ajax({
            url: "{{url('/testreminder')}}",
            type:'POST',
            data: $(this).serialize(),
            dataType: "json",
            success: function(data){
               if(data.success){
                 $("#response-msgt").html('<div class="alert alert-success">'+data.success+'</div>');
                 $("#datepicker").val('');
                 $("#datet").val('');
                 $("#mobilet").val('');
                 $("#emailt").val('');
               }else{
                $("#response-msg").html('<div class="alert alert-danger">'+data.error+'</div>');
               }

            }
        });
  });
  
  
  


$("#second-step").hide();
$("#btn-step-1").click(function(){
  $("#first-step").hide();
  $("#second-step").show();
});
$("#btn-step-2").click(function(){
  $("#first-step").show();
  $("#second-step").hide();
});

$("#sp-step-2").hide();
$("#sp-btn-step-1").click( function(){
  $("#sp-step-1").hide();
  $("#sp-step-2").show();
});
$("#sp-btn-step-2").click( function(){
  $("#sp-step-1").show();
  $("#sp-step-2").hide();
});

});
</script>

<!-- 22012021(zohoForm) -->

<script>
    var mndFileds=new Array('First Name','LastName','Email','Mobile');
    var fldLangVal=new Array('First Name','LastName','Email','Mobile'); 
    var name='';
    var email='';
    function privacyAlert()
    {
      if(document.getElementById('privacyTool') !=undefined && !document.getElementById('privacyTool').checked )
      {
        document.getElementById('privacyErr').style.visibility='visible';
        document.getElementById('privacyTool').focus();
        return false;
      }
      return true;
    }
    function disableErr()
    {
      if(document.getElementById('privacyTool') !=undefined &&document.getElementById('privacyTool').checked &&document.getElementById('privacyErr') !=undefined )
      {
        document.getElementById('privacyErr').style.visibility='hidden';
      }
    }
  function validateEmail()
  {
    var emailFld = document.querySelectorAll('[ftype=email]');
    var i;
    for (i = 0; i<emailFld.length; i++)
    {
      var emailVal = emailFld[i].value;
      if((emailVal.replace(/^\s+|\s+$/g, '')).length!=0 )
      {
        var atpos=emailVal.indexOf('@');
        var dotpos=emailVal.lastIndexOf('.');
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=emailVal.length)
        {
          alert('Please enter a valid email address. ');
          emailFld[i].focus();
          return false;
        }
      }
    }
    return true;
  }

    function checkMandatory4672655000000300040() {
    for(i=0;i<mndFileds.length;i++) {
      var fieldObj=document.forms['WebToContacts4672655000000300040'][mndFileds[i]];
      if(fieldObj) {
      if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length==0) {
      if(fieldObj.type =='file')
        { 
        alert('Please select a file to upload.'); 
        fieldObj.focus(); 
         return false;
        } 
      alert(fldLangVal[i] +' cannot be empty.'); 
      fieldObj.focus();
        return false;
      }  else if(fieldObj.nodeName=='SELECT') {
      if(fieldObj.options[fieldObj.selectedIndex].value=='-None-') {
        alert(fldLangVal[i] +' cannot be none.'); 
        fieldObj.focus();
        return false;
         }
      } else if(fieldObj.type =='checkbox'){
      if(fieldObj.checked == false){
        alert('Please accept  '+fldLangVal[i]);
        fieldObj.focus();
        return false;
         } 
       } 
       try {
      if(fieldObj.name == 'Last Name') {
        name = fieldObj.value;
          }
      } catch (e) {}
        }
    }
    trackVisitor();
    if(!validateEmail()){return false;}
    
    if(!privacyAlert()){return false;}
    document.querySelector('.crmWebToEntityForm .formsubmit').setAttribute('disabled', true);
  }

function tooltipShow(el){
  var tooltip = el.nextElementSibling;
  var tooltipDisplay = tooltip.style.display;
  if(tooltipDisplay == 'none'){
    var allTooltip = document.getElementsByClassName('zcwf_tooltip_over');
    for(i=0; i<allTooltip.length; i++){
      allTooltip[i].style.display='none';
    }
    tooltip.style.display = 'block';
  }else{
    tooltip.style.display='none';
  }
}
</script><script type='text/javascript' id='VisitorTracking'>var $zoho= $zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode:'44a601eeefb35d9db676fb608d3b776995d6bcc3480aa8637996385972d9adb96d6460c327834253d2a1bb2c3985c671', values:{},ready:function(){$zoho.salesiq.floatbutton.visible('hide');}};var d=document;s=d.createElement('script');s.type='text/javascript';s.id='zsiqscript';s.defer=true;s.src='https://salesiq.zoho.com/widget';t=d.getElementsByTagName('script')[0];t.parentNode.insertBefore(s,t);function trackVisitor(){try{if($zoho){var LDTuvidObj = document.forms['WebToContacts4672655000000300040']['LDTuvid'];if(LDTuvidObj){LDTuvidObj.value = $zoho.salesiq.visitor.uniqueid();}var firstnameObj = document.forms['WebToContacts4672655000000300040']['First Name'];if(firstnameObj){name = firstnameObj.value +' '+name;}$zoho.salesiq.visitor.name(name);var emailObj = document.forms['WebToContacts4672655000000300040']['Email'];if(emailObj){email = emailObj.value;$zoho.salesiq.visitor.email(email);}}} catch(e){}}</script>


<script>
    
   
    
    $( document ).ready(function() {
     
});
    
</script>

<script type="text/javascript">
    
     $( ".remove_order" ).click(function() {
        
        var result = confirm("Press OK To  Cancel Order."); 
            if (result == true) { 
                
                return true;
                
            } else { 
                return false;
            } 
           
    });


</script>