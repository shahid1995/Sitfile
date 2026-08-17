@extends('crudbooster::admin_template')
@section('content')

@push('head')
<link rel="stylesheet" type="text/css" href="{{asset('vendor/crudbooster/assets/summernote/summernote.css')}}">
@endpush
@push('bottom')
<script type="text/javascript" src="{{asset('vendor/crudbooster/assets/summernote/summernote.min.js')}}"></script>
<script type="text/javascript">
  $(function() {
    $('.textarea-content').summernote({
      height: ($(window).height() - 400),
    });
  })
</script>
@endpush


  <section class="content-header">
    <h1>
      <i class="fa fa-list-alt"></i>Manage CMS Page &nbsp;&nbsp;
    </h1>


    <ol class="breadcrumb">
      <li><a href="{{ url('/admin/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Manage Page</li>
    </ol>
  </section>  

  <!-- Main content -->
  <section id="content_section" class="content">
  <!-- Your Page Content Here -->

    @if(Session::has('success_message'))
    <div class="alert {{ Session::get('alert-class', 'alert-success alert-dismissible') }}">{{ Session::get('success_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
    @endif

    @if(Session::has('err_message'))
    <div class="alert {{ Session::get('alert-class', 'alert-danger alert-dismissible') }}">{{ Session::get('err_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
    @endif

    <div>
      <p><a title="Return" href="{{ url('/admin/staticpage/list') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Page List</a></p>       

      <div class="panel panel-default">
        <div class="panel-heading">
          <strong><i class="fa fa-list"></i> {{ $page_title }}</strong>
        </div> 

        <div class="panel-body" style="padding:20px 0px 0px 0px">
          <form class="form-horizontal" method="post" id="form" enctype="multipart/form-data" action="{{ $action }}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">    
            <div class="box-body" id="parent-form-area">

              
              <div class="form-group header-group-0 " id="form-group-page_name" style="">
                <label class="control-label col-sm-2">Page Name <span class="text-danger" title="This field is required">*</span></label>
                <div class="col-sm-10">
                  <input title="Page Name" required="" class="form-control" name="page_title" id="page_title" value="{{ (($page_details->page_title) ? $page_details->page_title : '') }}" type="text" placeholder="Enter page name ">
                  @if ($errors->has('page_title'))
                    <div class="text-danger">
                      <strong>{{ $errors->first('page_title') }}</strong>
                    </div>
                  @endif
                </div>
              </div>
             

              
              <div class="form-group header-group-0 " id="form-group-description_code" style="">
                <label class="control-label col-sm-2">Page Content  <span class="text-danger" title="This field is required">*</span></label>
                <div class="col-sm-10">
                <textarea class="form-control textarea-content" placeholder="Enter content (in {{ $language->language_code }})" name="page_content" id="page_content" required="">{{ (($page_details->page_content) ? $page_details->page_content : '') }}</textarea>
                <p class="help-block"></p>
                </div>
              </div> 
              

              <div class="form-group header-group-0 " id="form-group-page_name" style="">
                <label class="control-label col-sm-2">Meta Title<span class="text-danger" title="This field is required">*</span></label>
                <div class="col-sm-10">
                  <input title="page Name" required="" class="form-control" name="meta_title" id="meta_title" value="{{ (($pages->meta_title) ? $pages->meta_title : old('meta_title')) }}" type="text" placeholder="Enter meta title">
                  @if ($errors->has('meta_title'))
                    <div class="text-danger">
                      <strong>{{ $errors->first('meta_title') }}</strong>
                    </div>
                  @endif
                </div>
              </div>

              <div class="form-group header-group-0 " id="form-group-description_code" style="">
                <label class="control-label col-sm-2">Meta Keywords </label>
                <div class="col-sm-10">
                <textarea class="form-control" placeholder="Enter keywords" name="meta_keywords" id="meta_keywords">{{ (($pages->meta_keywords) ? $pages->meta_keywords : old('meta_keywords')) }}</textarea>
                <p class="help-block"></p>
                </div>
              </div> 

              <div class="form-group header-group-0 " id="form-group-description_code" style="">
                <label class="control-label col-sm-2">Meta Description </label>
                <div class="col-sm-10">
                <textarea class="form-control" placeholder="Enter Meta Description" name="meta_description" id="meta_description">{{ (($pages->meta_description) ? $pages->meta_description : old('meta_description')) }}</textarea>
                <p class="help-block"></p>
                </div>
              </div> 

              <div class="form-group header-group-0 " id="form-group-status" style="">
                <label class="col-sm-2 control-label">Status <span class="text-danger" title="This field is required">*</span></label>
                <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                    <option value="">** Please select a status</option>
                    <option value="ACTIVE" @if($pages->status=='ACTIVE') selected @elseif(old('status') =='ACTIVE') selected @endif>ACTIVE</option>
                    <option value="INACTIVE" @if($pages->status=='INACTIVE') selected @elseif(old('status') =='INACTIVE') selected @endif>INACTIVE</option>
                  </select>
                  @if ($errors->has('status'))
                    <div class="text-danger">
                      <strong>{{ $errors->first('status') }}</strong>
                    </div>
                  @endif
                </div>
              </div>

            </div><!-- /.box-body -->

            <div class="box-footer" style="background: #F5F5F5">  
              <div class="form-group">
                <label class="control-label col-sm-2"></label>
                <div class="col-sm-10">
                  <a href="{{ url('/admin/staticpage/list') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                  <input name="submit" value="Save" class="btn btn-success" type="submit">
                </div>
              </div>                             
            </div><!-- /.box-footer-->
          </form>
        </div>
      </div>
    </div><!--END AUTO MARGIN-->

  </section><!-- /.content -->


@endsection