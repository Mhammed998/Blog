@extends('layouts.admin')
@section('admin-title', 'Dashboard | Users')
@section('content-admin')
<div class="container-fluid">

   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Users Management</h1>
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


  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Fullname</th>
        <th scope="col">Email</th>
        <th scope="col">Type</th>
        <th scope="col">Status</th>
        <th scope="col">Mobile</th>
        <th scope="col">Posts</th>
        <th scope="col">Last-login</th>
        <th scope="col">Controls</th>
      </tr>
    </thead>
    <tbody>

        @if($users)
            @foreach($users as $user)
            <tr class="user-{{ $user->id }}">
                <th scope="row">{{ $user->id }}</th>
                <td>
                    @if(!empty($user->avatar))
                    <img height="40" width="40" class="rounded-circle" src="{{ asset('uploads/users/' . $user->avatar  ) }}"  >
                    @else
                    <img height="40" width="40" class="rounded-circle" src="https://via.placeholder.com/150"  >
                    @endif
                </td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->email }}</td>
                <td class=" realUserType-{{ $user->id }}  text-danger">  {{ $user->type }} </td>
                <td><span class="badge badge-primary realUserStatus-{{ $user->id }}">{{ $user->status }}</span>

                 <div class="dropdown d-inline-block">
                    <a class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     </a>
                    <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton">
                      <h6 class="dropdown-header">Change User Status</h6>
                        <a  class="dropdown-item update-status"   user-id="{{ $user->id }}" user-status="activated" ><i class="fas fa-check"></i> Activated</a>
                        <a class="dropdown-item update-status"    user-id="{{ $user->id }}" user-status="pending"><i class="far fa-pause-circle"></i> Pending</a>
                        <a class="dropdown-item update-status"    user-id="{{ $user->id }}" user-status="block" ><i class="fas fa-ban"></i> Block</a>
                    </div>
                 </div>

                </td>
                <td>{{ $user->mobile }}</td>
                <td>{{ $user->posts->count() }}</td>
                <td>{{ $user->last_login }}</td>

                <td>
                  <a href="{{ route('admin.users.show' , $user->id) }}"   class="btn btn-sm btn-info rounded-circle mr-1 show-user">
                      <i class="fas fa-eye"></i>
                  </a>
                  <a  user-id={{ $user->id }} class="btn btn-danger btn-sm mr-1 rounded-circle  delete-user">
                      <i class="fas fa-trash"></i>
                  </a>

                  <div class="dropdown  d-inline-block">
                    <a class=" dropdown-toggle text-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-cog"></i>
                     </a>
                    <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton">
                      <h6 class="dropdown-header">Change User Type</h6>
                        <a class="dropdown-item update-type"  user-id="{{ $user->id }}" user-type="user" href="#"><i class="fas fa-user"></i> User</a>
                        <a class="dropdown-item update-type"  user-id="{{ $user->id }}" user-type="author" href="#"><i class="fas fa-user-tie"></i> Author</a>
                        <a class="dropdown-item update-type"  user-id="{{ $user->id }}" user-type="SuperAdmin" href="#"><i class="fas fa-user-shield"></i> SuperAdmin</a>

                    </div>
                 </div>

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
                <td>-</td>
            </tr>


        @endif



    </tbody>
  </table>









</div>
@endsection
@section('ajax-backend')

<script>

/*****************DELETE User *****************/

$(".delete-user").click(function(e){

e.preventDefault();

var  $userID = $('.delete-user').attr('user-id');

    $.ajax({
        type:'POST',
        url:"{{ route('admin.users.delete') }}",
        data:{
        '_token': "{{ csrf_token() }}" ,
        'user_id' : $userID
        },
        success:function(data){
            if(data.status == 200){
          $('.user-'+data.id).remove();
        }
    }



  });


});

/***************** UPDATE USER STATUS *****************/

$(".update-status").click(function(e){

e.preventDefault();


var  $userID =e.target.getAttribute('user-id');
var  $userStatus = e.target.getAttribute('user-status');


    $.ajax({
        type:'POST',
        url:"{{ route('admin.users.status') }}",
        data:{
        '_token': "{{ csrf_token() }}" ,
        'user_id' : $userID,
        'user_status' : $userStatus
        },
        success:function(data){
            if(data.status == 200){
            $('.realUserStatus-' + data.id).html($userStatus)
        }
    }



  });


});

/***************** UPDATE USER Type [permessions] *****************/

$(".update-type").click(function(e){

e.preventDefault();


var  $userID =e.target.getAttribute('user-id');
var  $userType = e.target.getAttribute('user-type');


    $.ajax({
        type:'POST',
        url:"{{ route('admin.users.type') }}",
        data:{
        '_token': "{{ csrf_token() }}" ,
        'user_id' : $userID,
        'user_type' : $userType
        },
        success:function(data){
            if(data.status == 200){
            $('.realUserType-' + data.id).html($userType)
        }
    }



  });


});

/*****************     *****************/






</script>
@endsection






