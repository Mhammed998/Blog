@extends('layouts.admin')
@section('admin-title', 'Dashboard | Comments')
@section('content-admin')
<div class="container-fluid">

   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Comments Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Comments</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->


  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Comment</th>
        <th scope="col">Status</th>
        <th scope="col">User</th>
        <th scope="col">Post</th>
        <th scope="col">Parent</th>
        <th scope="col">Controls</th>
      </tr>
    </thead>
    <tbody>

        @if($comments)
            @foreach($comments->where('parent_id','=','0') as $comment)

            <tr class="comment-{{ $comment->id }} bg-secondary">
                <th scope="row">{{ $comment->id }}</th>
                <td>{{ $comment->comment }}</td>
                <td><span class="badge badge-primary">{{ $comment->status }}</span></td>
                <td>{{ $comment->user->full_name }}</td>
                <td>{{ $comment->post->title }}</td>
                <td>{{ $comment->parent_id == "0" ? "Main Comment" : "Sub-comment" }}</td>
                <td>
                  <a  comment-id={{ $comment->id }} class="btn btn-danger rounded-circle  delete-comment">
                      <i class="fas fa-trash"></i>
                  </a>
                </td>

            </tr>

            @if($comments->where('parent_d','!=','0'))
                @foreach($comments->where('parent_id','=',$comment->id) as $subcomment)
                <tr class="comment-{{ $subcomment->id }}">
                    <th scope="row">{{ $subcomment->id }}</th>
                    <td>{{ $subcomment->comment }}</td>
                    <td><span class="badge badge-primary">{{ $subcomment->status }}</span></td>
                    <td>{{ $subcomment->user->full_name }}</td>
                    <td>{{ $subcomment->post->title }}</td>
                    <td>Sub of : {{ $subcomment->parent_id }}</td>
                    <td>
                      <a  comment-id={{ $subcomment->id }} class="btn btn-danger rounded-circle  delete-comment">
                          <i class="fas fa-trash"></i>
                      </a>
                    </td>

                </tr>
                @endforeach
            @endif

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

$(".delete-comment").click(function(e){

e.preventDefault();

var  $commentID = $(this).attr('comment-id');

    $.ajax({
        type:'POST',
        url:"{{ route('admin.comments.delete') }}",
        data:{
        '_token': "{{ csrf_token() }}" ,
        'comment_id' : $commentID
        },
        success:function(data){
            if(data.status == 200){
          $('.comment-'+data.id).remove();
        }
    }



});


});








</script>
@endsection






