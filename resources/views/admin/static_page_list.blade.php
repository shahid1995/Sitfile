@extends('crudbooster::admin_template')
@section('content')
<h1>
	<i class="fa fa-list-alt"></i>{{ $page_title }}  
   <!--  <a href="{{ url('/') }}/admin/staticpage/list" id="btn_show_data" class="btn btn-sm btn-primary" title="Show Data">
  	<i class="fa fa-table"></i> Show Data
	</a>  -->                
	<a href="{{ url('/') }}/admin/staticpage/add" id="btn_add_new_data" class="btn btn-sm btn-success" title="Add Data">
  	<i class="fa fa-plus-circle"></i> Add Data
	</a>
</h1>
@if(Session::has('success_message'))
<div class="alert {{ Session::get('alert-class', 'alert-success alert-dismissible') }}">{{ Session::get('success_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
@endif



<div class="box">

    <div class="box-header">  
        <div class="box-tools pull-right" style="position: relative;margin-top: -5px;margin-right: -10px">
          <form method="get" style="display:inline-block;width: 260px;" action="{{ url('/') }}/admin/staticpage/list">
              <div class="input-group">
                <input name="q" value="" class="form-control input-sm pull-right" placeholder="Search" type="text">
                
                <div class="input-group-btn">
                <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
          </form>

        </div> 
        <br style="clear:both">
    </div>

    <div class="box-body table-responsive no-padding">
        <form id="form-table" method="post" action="">
	      	<input name="button_name" value="" type="hidden">
	      	<input type="hidden" name="_token" value="{{csrf_token()}}">
	      	<table id="table_dashboard" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr class="active">
                      	<th width="auto">Sl No</th>
                        <th width="auto">Page Name</th>
                      	<th width="auto">Status</th>                   
                        <th style="text-align:right" width="auto">Action</th>
                    </tr>
                </thead>
	            <tbody>
                <?php $i=1;?>
                
                @if(count($pages) > 0)
                @foreach($pages as $page)
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $page->meta_title }}</td>
                  <td>{{ $page->status }}</td>
                  <td>
                    <div class="button_action" style="text-align:right">
                        <!-- <a class="btn btn-xs btn-primary btn-detail" title="Detail Data" href="{{ url('/') }}/admin/package/show/{{ $package->id }}"><i class="fa fa-eye"></i></a> -->
                        @if ($page->seo_url === "about-us")
                          <a class="btn btn-xs btn-success" title="Edit Data" href="{{ url('admin/page-details') }}">  <i class="fa fa-list"></i>
                          </a>  
                        @else
                          <a class="btn btn-xs btn-success btn-edit" title="Edit Data" href="{{ url('/') }}/admin/staticpage/edit/{{ $page->id }}">  <i class="fa fa-pencil"></i>
                          </a>
                        @endif

                        <!-- <a class="btn btn-xs btn-warning btn-delete" title="Delete" href="javascript:;" onclick="swal({   
                        title: 'Are you sure ?',   
                        text: 'You will not be able to recover this record data!',   
                        type: 'warning',   
                        showCancelButton: true,   
                        confirmButtonColor: '#ff0000',   
                        confirmButtonText: 'Yes!',  
                        cancelButtonText: 'No',  
                        closeOnConfirm: false }, 
                        function(){  location.href='{{ url('/') }}/admin/staticpage/delete/{{ $page->id }}' });"><i class="fa fa-trash"></i>
                      </a> --> 
                    </div>
                  </td>
                </tr>
                <?php $i++;?>
	            	@endforeach
                @else
                <tr><td colspan="4">No record found!</td></tr>
                @endif
	            </tbody>
	            <tfoot>
	                <tr>
                        <th>Sl No</th>
                        <th>Page Name</th>
                      	<th>Status</th>
                        <th></th>
                    </tr>
	            </tfoot>               
        	</table>
          {{ $pages->links() }}
    	</form><!--END FORM TABLE-->
    	<p></p>
   	</div>
</div>

@endsection