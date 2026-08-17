<!-- First, extends to the CRUDBooster Layout -->
@push('head')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/crudbooster/assets/summernote/summernote.css')}}">
    

@endpush
@push('bottom')
    <script type="text/javascript" src="{{asset('vendor/crudbooster/assets/summernote/summernote.min.js')}}"></script>
    
    
@endpush


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
@extends('crudbooster::admin_template')
@section('content')
    @if(CRUDBooster::getCurrentMethod() != 'getProfile' && $button_cancel)
            @if(g('return_url'))
                <p><a title='Return' href='{{g("return_url")}}'><i class='fa fa-chevron-circle-left '></i>
                        &nbsp; {{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a>
                </p>
            @else
                <p><a title='Main Module' href='{{CRUDBooster::mainpath()}}'><i class='fa fa-chevron-circle-left '></i>
                        &nbsp; {{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>
            @endif
        @endif
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>{{$page_title}}</div>
    <div class="panel-body" style="padding:20px 0px 0px 0px">
        <?php
                $action = (@$row) ? CRUDBooster::mainpath("edit-save/$row->id") : CRUDBooster::mainpath("add-save");
                $return_url = ($return_url) ?: g('return_url');
                ?>
                                <form class="form-horizontal" method="post" id="form" enctype="multipart/form-data" action="{{url('admin/upload-postcode-excel')}}">
                                  
                    
                    <input type='hidden' name='return_url' value='{{ @$return_url }}'/>
                    <input type='hidden' name='ref_mainpath' value='{{ CRUDBooster::mainpath() }}'/>
                    <input type='hidden' name='ref_parameter' value='{{urldecode(http_build_query(@$_GET))}}'/>
                                        <div class="box-body" id="parent-form-area">
                    {{ csrf_field() }}


                     <div class="form-group header-group-0 " id="form-group-status" style="">
                          <label class="control-label col-sm-2"> Country 
                              <span class="text-danger" title="This field is required">*</span>
                          </label>

                          <div class="col-sm-10">
                              <select class="form-control" id="country" data-value="" required="" name="country">
                                  <option value="">** Please select a Country</option>
                                  @forelse($country as $country_as)
                                  <option value="{{$country_as->id}}">{{ $country_as->country_name_en }}</option>
                                  @empty
                                  @endforelse
                                  
                              </select>

                              <div class="text-danger"></div>
                              <p class="help-block"></p>
                          </div>
                    </div>  


                    <div class="form-group header-group-0 " id="form-group-status" style="">
                          <label class="control-label col-sm-2"> State 
                              <span class="text-danger" title="This field is required">*</span>
                          </label>

                          <div class="col-sm-10">
                              <select class="form-control" id="state" data-value="" required="" name="state">
                                  <option value="">** Please select a State</option>                                                                    
                              </select>

                              <div class="text-danger"></div>
                              <p class="help-block"></p>
                          </div>
                    </div> 



                    <div class="form-group header-group-0 " id="form-group-status" style="">
                          <label class="control-label col-sm-2"> City 
                              <span class="text-danger" title="This field is required">*</span>
                          </label>

                          <div class="col-sm-10">
                              <select class="form-control" id="city" data-value="" required="" name="city">
                                  <option value="">** Please select a City </option>                                                                    
                              </select>

                              <div class="text-danger"></div>
                              <p class="help-block"></p>
                          </div>
                    </div> 







 
                   <div class="form-group header-group-0 " id="form-group-meta_tag_title" style="">
                           <label class="control-label col-sm-2">
                             Upload csv/excel <span class="text-danger" title="This field is required">*</span>                  
                           </label>
                           <div class="col-sm-10">
                            
                             <input title="Ticket No" class="form-control" name="postcode_list" id="postcode_list" value="" type="file" required="" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            <div class="text-danger"></div>

                            <p class="help-block"></p>
                            Please click here to download the demo Excel file -<a href="{{ asset('postcode.xlsx') }}" download> Click here </a>
                          </div>
                   </div> 


      

                    <div class="box-footer" style="background: #F5F5F5">

                        <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">     

                             <a href="{{CRUDBooster::mainpath()}}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>                                                                                           
                                   <input name="submit" value="Save &amp; Add More" class="btn btn-success" type="submit">
                                  <input name="submit" value="Save" class="btn btn-success" type="submit">
                                    
                            </div>
                        </div>


                    </div><!-- /.box-footer-->

                </form>

            </div>
  </div>
@endsection

 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
   $( document ).ready(function() {
    var x=$('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#hall').change(function(e){
      var c_id=$("#hall").val();

      var url_val='../ajax-event/'+c_id;
      $.ajax({
        url: url_val,
        method: 'get',
        success: function(result){
          $("#event").html(result);
        }});
    });
  });
</script> 

<script>
 $( document ).ready(function() {
  var x=$('meta[name="csrf-token"]').attr('content');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#event').change(function(e){
    var event_id=$("#event").val();

    var url_val='../ajax-ticket-genarate/'+event_id;
    $.ajax({
      url: url_val,
      method: 'get',
      success: function(result){

        //alert(result);
        $("#ticket_no").val(result);
        $("#show_date_time").fadeIn();
      }});
  });
});
</script>

<script>
         $( document ).ready(function() {

          var x=$('meta[name="csrf-token"]').attr('content');

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });              
               $('#country').change(function(e){
                var c_id=$("#country").val();                       
                        var url_val='{{ url('/') }}/admin/get-ajax-state/'+c_id;
                         //alert(url_val);
                         $.ajax({
                          url: url_val,
                          method: 'get',
                          success: function(result){
                            console.log(result);

                            //alert(result);
                            $("#state").html(result);
                          }});
                       });
             });
    </script>

    <script>
      $(document).ready(function(){
                                       
            $(".content-header").children("h1").html("Import Postcodes");

          });

    </script>


    <script>
         $( document ).ready(function() {

          var x=$('meta[name="csrf-token"]').attr('content');

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
               // alert(x);



               $('#state').change(function(e){
                var c_id=$("#state").val();
                        //alert(c_id);
                        var url_val='{{ url('/') }}/admin/get-ajax-city/'+c_id;
                         //alert(url_val);
                         $.ajax({
                          url: url_val,
                          method: 'get',
                          success: function(result){
                            console.log(result);

                            //alert(result);
                            $("#city").html(result);
                          }});
                       });
             });
    </script>