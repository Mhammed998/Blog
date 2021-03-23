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

  <a class="btn btn-primary mb-2 " href="{{ route('admin.posts.create') }}">Create post</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Title</th>
        <th scope="col">Status</th>
        <th scope="col">Category</th>
        <th scope="col">Tags</th>
        <th scope="col">Author</th>
        <th scope="col">Controls</th>
      </tr>
    </thead>
    <tbody>

        @if($posts)
            @foreach($posts as $post)
            <tr class="post-{{ $post->id }}">
                <th scope="row">{{ $post->id }}</th>
                <td>
                    @if(!empty($post->image))
                    <img height="40" width="40" class="rounded-circle" src="{{ asset('uploads/posts/' . $post->image  ) }}"  >
                    @else
                    <img height="40" width="40" class="rounded-circle" src="https://via.placeholder.com/150"  >
                    @endif
                </td>
                <td>{{ $post->title }}</td>
                <td><span class="badge badge-primary">{{ $post->status }}</span></td>
                <td>{{ $post->category->title }}</td>
                <td>
                    @foreach($post->tags as $tag)
                        <span class="badge badge-success">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td>{{ $post->user->full_name }}</td>
                <td>
                  <a href="{{ route('admin.posts.edit',$post->id) }}" post-id={{ $post->id }}  class="btn btn-info rounded-circle mr-1 edit-post">
                      <i class="fas fa-pen"></i>
                  </a>
                  <a  post-id={{ $post->id }} class="btn btn-danger rounded-circle  delete-post">
                      <i class="fas fa-trash"></i>
                  </a>
                </td>

            </tr>
            @endforeach
            @else
            <tr>
                <th scope="row">#</th>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>


        @endif



    </tbody>
  </table>



</div>
@endsection
@section('ajax-backend')

<script>

/*****************DELETE CATEGORY *****************/

$(".delete-post").click(function(e){

e.preventDefault();

var  $postID = $(this).attr('post-id');

    $.ajax({
        type:'POST',
        url:"{{ route('admin.posts.delete') }}",
        data:{
        '_token': "{{ csrf_token() }}" ,
        'post_id' : $postID
        },
        success:function(data){
            if(data.status == 200){
          $('.post-'+data.id).remove();
        }
    }



});


});








</script>
@endsection






