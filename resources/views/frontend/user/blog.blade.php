@extends('layouts.userinner')
@section('title', 'Blog')
@section('content')
<div class="col-md-9 col-sm-8 col-xs-12 col9flex">
  <div class="profile_block myorderouter">
    <div class="logheading">
      <h2>Blog Lists</h2>
    </div>
  </div>
  
  <div class="row">
      <div class="col-sm-12">
          <a href="#" data-toggle="modal" data-target="#addBlog" class="btn btn-primary">+Add</a>
          <!-- Modal -->
            <div id="addBlog" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">
            
                <!-- Modal content-->
                <form action="{{ url('user/blog/add') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Blog</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="content" class="form-control" rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Save">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
                </form>
            
              </div>
            </div>
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @if(!empty($blog_list))
                  @foreach($blog_list as $blog)
                  <tr>
                      <td>{{ $blog->blog_title }}</td>
                      <td><img src="{{ asset($blog->image) }}" height="auto" width="100px"></td>
                      <td></td>
                  </tr>
                  @endforeach
                  @endif
              </tbody>
          </table>
      </div>
  </div>
</div>
@endsection