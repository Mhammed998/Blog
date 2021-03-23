@extends('layouts.admin')
@section('admin-title', 'Dashboard | Posts')
@section('content-admin')
<div class="container-fluid">

   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Posts Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Posts</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

    <!-- Add New Post Form  -->

        <div class="card card-info ml-5 mr-5">
          <div class="card-header">
            <h3 class="card-title">Edit Post</h3>
          </div>
          <div id="success" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;margin: 5px 10px 0px 10px;">
              Post has been added successfully
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <!-- form start -->


          <div class="alert alert-danger print-error-msg" style="display: none; margin: 20px 20px 0px 20px;">
            <ul> </ul>
          </div>

          <form id="createPostForm" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="card-body row">

            <div class="col-md-6">
              <div class="form-group">
                <label for="title">Title</label>
                  <input name="title" type="text" value="{{ $post->title }}" class="form-control" id="title" placeholder="title here.." required="required">
              </div>

              <input name="post_id" type="hidden" value="{{ $post->id }}"  class="form-control" id="post_id">


              <div class="form-group">
                <label>Status</label>
                  <select class="form-control" name="status" required>
                    <option {{ $post->status=="pending" ? "selected" : "" }} value="pending">pending</option>
                    <option {{ $post->status=="activated" ? "selected" : "" }} value="activated">activated</option>
                  </select>
              </div>




            </div>

            <div class="col-md-6">

              <div class="form-group">
                <label for="image">Image</label>
                  <input name="image" type="file" class="form-control" id="image" placeholder="Image here..">
              </div>

              <div class="form-group">
                <label>Category</label>
                  <select class="form-control" name="category_id" required>
                    @if($cates)
                        @foreach($cates as $cate)
                            <option {{ $post->category_id == $cate->id ? "selected" : "" }} value="{{ $cate->id }}">{{ $cate->id }}-{{ $cate->title }}</option>
                        @endforeach
                    @else
                      <option disabled value="0">No category exists</option>
                    @endif
                  </select>
              </div>


             <div class="form-group hidden">
               <input type="hidden" value={{Auth::user()->id}} name="user_id"  />
              </div>



            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Content</label>
                      <textarea name="content" cols="5" rows="5" class="form-control" required>{{ $post->content }}</textarea>
                  </div>


                  <div class="form-group">
                    <label>Tags</label>
                      <select class="form-control  js-example-basic-multiple " name="tags[]" required multiple="true" >
                        @if($tags)
                            @foreach($tags as $tag)
                                <option {{ in_array($tag->id,$selectedTags) ? "selected" : "" }}  value="{{ $tag->id }}">{{ $tag->id }}-{{ $tag->name }}</option>
                            @endforeach
                        @else
                          <option disabled value="0">No tag exists</option>
                        @endif
                      </select>
                  </div>

            </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button id="savePostBtn" class="btn btn-info">Save post</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>







</div>
@endsection
@section('ajax-backend')

<script>

$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
});

$("#savePostBtn").click(function(e){

        e.preventDefault();

        var formData = new FormData($('#createPostForm')[0]);

        $.ajax({
        type:'post',
        url:"{{ route('admin.posts.update') }}",
        enctype: 'multipart/form-data',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
           if(data.status == 200){
              $('#success').show();
              $('#createPostForm')[0].reset();
           } else if(data.status == 400){
             printErrors(data.error);
           }

        }

        });

        function printErrors(msg){
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each(msg , function(key,value){
                $('.print-error-msg').find('ul').append('<li>' + value + '</li>');
            })
        }

});

</script>




@endsection
