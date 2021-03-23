@extends('layouts.app')
@section('content')
<div class="container">
<div class="main-dashboard p-4">

<div class="heading d-flex justify-content-between align-items-center mb-4 p-2 " style="border-bottom: 1px solid #ccc;">
<h4> Posts Management </h4>

<a class="btn btn-info text-white" href="{{ route('user.posts.create') }}">Create New Post </a>
</div>
<div class="my-posts">
    <div class="row">

        @if(auth()->user()->posts->count() > 0)
          @foreach(auth()->user()->posts as $post)
       <div class="col-md-4">
            <div class="card mb-3" style="height: 170px;">
                <a href="{{ route('user.posts.single',$post->id) }}" class="my-post d-block">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    @if(!empty($post->image))
                    <img width="100%" height="167px" src="{{ asset('uploads/posts/' . $post->image) }}" alt="">
                        @else
                        <img  style="width:100%" height="167px" src="https://via.placeholder.com/200">
                    @endif                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">{{ $post->title }}</h5>
                      <p class="card-text">{{ substr($post->content,0,100) }}..</p>
                      <p class="card-text date"><small class="">{{ $post->created_at->format('d/m/Y') }}</small></p>
                    </div>
                  </div>
                </div>
            </a>

              </div>
       </div>
         @endforeach
       @endif



    </div>
</div>





</div>
</div>

@endsection
