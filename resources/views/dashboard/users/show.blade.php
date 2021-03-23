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


  <div class="card mb-3" >
    <div class="row no-gutters">
      <div class="col-md-3">
        @if(!empty($user->avatar))
        <img  style="width:100%" src="{{ asset('uploads/user/' . $user->avatar  ) }}"  >
        @else
        <img  style="width:100%" src="https://via.placeholder.com/200"  >
        @endif
      </div>
      <div class="col-md-9">
        <div class="card-body row">


          <div class="col-md-6">
            <h5 class="card-title">{{ $user->full_name }}</h5>
          <p class="card-text">@if(empty($user->description)) About: [ ] @endif </p>
          <p class="card-text">Mobile: {{ $user->mobile }}</p>
          <p class="card-text">Status: {{ $user->status }}</p>
          <p class="card-text">Role: {{ $user->type }}</p>
          </div>

          <div class="col-md-6">
          <p class="card-text">No.posts: [ {{ $user->posts->count() }} ]</p>
          <p class="card-text">No.comments: [  ]</p>
          <p class="card-text">No.likes: [  ]</p>
          <p class="card-text">No.dislikes: [  ]</p>
          </div>


          <p class="card-text"><small class="text-muted">Joined at: {{ $user->created_at }}</small></p>
        </div>
      </div>
    </div>
  </div>





</div>
@endsection
