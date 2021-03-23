@extends('layouts.admin')
@section('admin-title', 'Dashboard | Users')
@section('content-admin')
<div class="container-fluid">

   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->


 <div class="row">

    <div class="col-md-4">
      <div id="profile-left">

        <div class="top text-center">
            @if(!empty($profile->avatar))
            <a href="{{ asset('uploads/users/' . $profile->avatar  ) }}">
                <img  style="width:100%" height="400px" src="{{ asset('uploads/users/' . $profile->avatar  ) }}"  >
            </a>
                @else
                <img  style="width:100%" src="https://via.placeholder.com/200">
            @endif
        </div>

        <div class="details text-center p-1">
            <h5>{{ $profile->full_name }}</h5>
            <p>{{ $profile->email }}</p>
        </div>

      </div>
    </div>

    <div class="col-md-8">
       <div id="profile-right">

        <div id="success" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;margin: 5px 10px 0px 10px;">
            Profile has been added successfully <a href="">refresh now</a>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="alert alert-danger print-error-msg" style="display: none; margin: 20px 20px 0px 20px;">
            <ul> </ul>
          </div>

       <form id="updateProfileForm" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <div class="row">

        <div class="col-md-6">

            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input name="full_name" value="{{ $profile->full_name }}" type="text" class="form-control" id="fullname"  required="required">
            </div>


            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" value="{{ $profile->email }}" class="form-control" id="email">
            </div>


            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" required>
                    <option {{ $profile->status =="pending" ? "selected" : "" }} value="pending">pending</option>
                    <option {{ $profile->status =="activated" ? "selected" : "" }} value="activated">activated</option>
                </select>
            </div>




        </div>

            <div class="col-md-6">



                <div class="form-group">
                    <label for="avatar">Image</label>
                    <input name="avatar" type="file" class="form-control" id="avatar">
                </div>


                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input name="mobile" type="text" value="{{ $profile->mobile }}" class="form-control" id="mobile">
                </div>


                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" name="type" required>
                        <option {{ $profile->type =="SuperAdmin" ? "selected" : "" }} value="SuperAdmin">SuperAdmin</option>
                        <option {{ $profile->type =="author" ? "selected" : "" }} value="author">Author</option>
                        <option {{ $profile->type =="user" ? "selected" : "" }} value="user">User</option>
                    </select>
                </div>




                <div class="form-group hidden">
                <input type="hidden" value={{$profile->id}} name="profile_id"  />
                </div>



            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>About Me</label>
                    <textarea name="description" cols="5" rows="5" class="form-control" required>{{ $profile->description }}</textarea>
                </div>
            </div>


        </div>
              <button id="saveProfileUpdates" class="btn btn-info">Update profile</button>

       </form>


       </div>
    </div>


 </div>

 <hr>

 <div class="row">

    <div class="col-md-12">
        <h4 class="mb-3 mt-2">User posts [{{ $profile->posts->count() }}]  </h4>
        <div class="user-posts row">
          @if($profile->posts->count() > 0)
              @foreach($profile->posts as $post)
              <div class="col-md-6">
              <div class="card single-post-{{ $post->id }} mb-3 ">
                  <div class="row no-gutters">
                    <div class="col-md-4">
                        @if(!empty($post->image))
                        <img width="100%" height="150px" src="{{ asset('uploads/posts/' . $post->image) }}" alt="">
                            @else
                            <img  style="width:100%" height="150px" src="https://via.placeholder.com/200">
                        @endif
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ substr($post->content,0,100) }}..</p>
                        <p class="card-text"><small class="text-muted">{{ $post->created_at }}</small></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                @endforeach
          @endif




        </div>
      </div>

      <hr>

      <div class="col-md-12">
        <h4 class="mb-3 mt-2">User comments [{{ $profile->comments->count() }}]  </h4>
          <div class="user-comments row">

          @if(!empty($profile->comments))
           @foreach($profile->comments as $comment)
           <div class="col-md-4">
            <div class="card border-secondary mb-3 comment-{{ $comment->id }}">
                <div class="card-header">{{ $comment->post->title }}</div>
                <div class="card-body text-secondary">
                  <p class="card-text">  {{ $comment->comment }}</p>
                </div>
              </div>
           </div>
           @endforeach
          @endif





          </div>
      </div>


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

$("#saveProfileUpdates").click(function(e){

        e.preventDefault();

        var formData = new FormData($('#updateProfileForm')[0]);

        $.ajax({
        type:'post',
        url:"{{ route('admin.profile.update') }}",
        enctype: 'multipart/form-data',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
           if(data.status == 200){
              $('#success').show();
              $('#updateProfileForm')[0].reset();
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
