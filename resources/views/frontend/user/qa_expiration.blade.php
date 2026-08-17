@extends('layouts.userinner')
@section('title', 'QA Expiration')
@section('content')

<div class="col-md-9 col-sm-8 col-xs-12 col9flex gfghf">
	<div class="profile_block">
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
	    
		<div class="right-panel">
			<div class="logheading">
				<a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-primary pull-right">+ Add</a>
				<!-- Modal -->
                <div class="modal fade" id="addModal" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form action="{{url('user/qa-expiration')}}" method="post">
                        {{csrf_field()}}
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add QA Expiration</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                            <label>Service</label>
                            <select name="service" class="form-control" required>
                                <option value="">Select Service</option>
                                @if(!empty($services))
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}">{{$service->service_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('service'))
                                <span class="text-danger">{{$errors->first('service')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Expiry Time (Hrs)</label>
                            <input type="number" name="expiry_time" class="form-control" required>
                            @if($errors->has('expiry_time'))
                                <span class="text-danger">{{$errors->first('expiry_time')}}</span>
                            @endif
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
				<h2 class="pull-left">QA Expiration</h2>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Service</th>
						<th>Expiry Time (Hrs)</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				    @if(!empty($qa_expiration_list))
				        @foreach($qa_expiration_list as $qa_list)
				            <tr>
				                <td>{{$qa_list->service_name}}</td>
				                <td>{{$qa_list->time}}</td>
				                <td><a href="#" data-toggle="modal" data-target="#editModal{{$qa_list->id}}" class="btn btn-primary btn-sm">Edit</a> <a href="" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-sm">Delete</a></td>
				            </tr>
				            <!--Edit Modal -->
                            <div class="modal fade" id="editModal{{$qa_list->id}}" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <form action="{{url('user/qa-expiration')}}" method="post">
                                    {{csrf_field()}}
                                <input type="hidden" name="edit_id" value="{{$qa_list->id}}">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit QA Expiration</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                        <label>Service</label>
                                        <select name="service" class="form-control" required>
                                            <option value="">Select Service</option>
                                            @if(!empty($services))
                                                @foreach($services as $service)
                                                    <option value="{{$service->id}}" @if($qa_list->service_id==$service->id) selected @endif>{{$service->service_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if($errors->has('service'))
                                            <span class="text-danger">{{$errors->first('service')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Expiry Time (Hrs)</label>
                                        <input type="number" name="expiry_time" class="form-control" value="{{$qa_list->time}}" required>
                                        @if($errors->has('expiry_time'))
                                            <span class="text-danger">{{$errors->first('expiry_time')}}</span>
                                        @endif
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                  </div>
                                </div>
                                </form>
                              </div>
                            </div>
				        @endforeach
				    @endif
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection