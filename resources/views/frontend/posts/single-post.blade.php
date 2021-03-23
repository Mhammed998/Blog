@extends('layouts.app')
@section('content')
<div class="container-fluid">
 <div class="main-dashboard">

{{--   <div class="row">--}}

{{--   <div class="col-md-8">--}}
{{--        <div class="single-post" style="background-color: #fff;border-radius:10px;padding:10px">--}}

{{--                <div class="post-image">--}}
{{--                    @if(!empty($post->image))--}}
{{--                    <a href="{{ asset('uploads/posts/' . $post->image) }}" target="_blank">--}}
{{--                    <img class="img-thumbnail" width="100%" height="167px" src="{{ asset('uploads/posts/' . $post->image) }}" alt="">--}}
{{--                    </a>--}}
{{--                    @else--}}
{{--                        <img class="img-thumbnail"  style="width:100%" height="167px" src="https://via.placeholder.com/200">--}}
{{--                    @endif--}}
{{--                </div>--}}

{{--                <div class="post-details mt-2">--}}



{{--                    <h3>{{  $post->title }}</h3>--}}
{{--                    <p style="line-height: 25px; color:#555"> {{ $post->content }} </p>--}}

{{--                    <div class="mb-2">--}}
{{--                         Tags:--}}
{{--                        @foreach($post->tags as $tag)--}}
{{--                        <a class="link-action badge badge-secondary" href="#">--}}
{{--                            {{ $tag->name }}--}}
{{--                        </a>--}}
{{--                        @endforeach--}}
{{--                        <br>--}}
{{--                        Category:--}}
{{--                        <a class="link-action badge badge-info text-white" href="#">--}}
{{--                            {{ $post->category->title }}--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class=" d-flex justify-content-between align-items-center">--}}
{{--                        <span> Created by: <a href="#">{{ $post->user->full_name }}</a> </span>--}}
{{--                        <span style="color:#777"> <i class="far fa-calendar"></i> {{ $post->created_at->format('d/m/Y')}}</span>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="actions pr-1 pl-1">--}}
{{--                    <a class="link-action" href="#">--}}
{{--                        <i class="far fa-comments"></i> {{ $post->comments->count() }} comments--}}
{{--                    </a>--}}

{{--                    <a class="link-action" href="#">--}}
{{--                    <i class="far fa-thumbs-up"></i> 260 Likes--}}
{{--                    </a>--}}

{{--                    <a class="link-action" href="#">--}}
{{--                    <i class="far fa-thumbs-down"></i> 36 Dislike--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <div class="add-comment">--}}
{{--                    @if(!empty($post->user->avatar))--}}
{{--                    <img src="{{ asset('uploads/users/' . $post->user->avatar) }}" height="30" width="30" class="rounded-circle">--}}
{{--                   @else--}}
{{--                    <img src="https://picsum.photos/200" height="30" width="30" class="rounded-circle">--}}
{{--                   @endif--}}

{{--                  @auth--}}
{{--                    <!-- START ADD Main COMMENT FORM HERE -->--}}
{{--                     <form class="form-group AddCommentForm" id="addMainCommentForm">--}}
{{--                    <input type="text" class="form-control" name="comment" placeholder="Type your comment here.." required>--}}
{{--                    <input type="hidden" class="form-control" name="user_id" value="{{auth()->user()->id}}" required>--}}
{{--                    <input type="hidden" class="form-control" name="post_id" value="{{$post->id}}" required>--}}
{{--                    <input type="hidden" class="form-control" name="parent_id" value="0" required>--}}
{{--                    <input type="hidden" class="form-control" name="status" value="pending" required>--}}
{{--                    <button id="saveMainCommentBtn"  class="btn btn-outline-primary  rounded-circle d-inline-block"><i class="fas fa-paper-plane"></i></button>--}}
{{--                 </form>--}}
{{--                 <!-- End ADD Main COMMENT FORM HERE -->--}}
{{--                @endauth--}}

{{--                </div>--}}

{{--                 <div class="post-comments p-4">--}}
{{--                    --}}{{--comments--}}
{{--                   @if($mainComments->count() > 0)--}}
{{--                    @foreach($mainComments as $Maincomment)--}}
{{--                      <div class="single-main-comment mb-2  comment-{{$Maincomment->id}}" comment-id="{{$Maincomment->id}}">--}}

{{--                            @if(!empty( $Maincomment->user->avatar))--}}
{{--                                 <img style="float: left;margin-right:12px;" src="{{ asset('uploads/users/' . $Maincomment->user->avatar) }}" height="30" width="30" class="rounded-circle">--}}
{{--                            @else--}}
{{--                                <img style="float: left;margin-right:12px;" src="https://picsum.photos/200" height="30" width="30" class="rounded-circle">--}}
{{--                            @endif--}}
{{--                                <div class="comment-details">--}}
{{--                                    <span>--}}
{{--                                        {{$Maincomment->user->full_name}}--}}
{{--                                        <a comment-id="{{$Maincomment->id}}" class="delete-comment">--}}
{{--                                            <i class="fas fa-trash-alt"></i>--}}
{{--                                        </a>--}}
{{--                                    </span>--}}
{{--                                    <p class="l-dark">--}}
{{--                                     {{ $Maincomment->comment }}--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                                <div class="user-actions" style="margin-left: 40px;font-size:12px;">--}}
{{--                                    <a style="text-decoration: none" class="link-action" href="#">--}}
{{--                                    <i class="far fa-thumbs-up"></i> 0 Likes--}}
{{--                                    </a>--}}

{{--                                    <a style="text-decoration: none" class="link-action" href="#">--}}
{{--                                    <i class="far fa-thumbs-down"></i> 0 Dislike--}}
{{--                                    </a>--}}

{{--                                    <a comment-id="{{$Maincomment->id}}" href="#" style="text-decoration: none" class="link-action showSubCommentForm">--}}
{{--                                        <i class="far fa-share"></i> 0 reply--}}
{{--                                    </a>--}}

{{--                                </div>--}}

{{--                                <!-- form to add sub comments -->--}}

{{--                                <form style="display: none" class="form-group AddCommentForm  AddSubCommentForm pl-4" form-for="{{$Maincomment->id}}">--}}
{{--                                    <input type="text" class="form-control" name="comment" placeholder="Type your reply here.." required>--}}
{{--                                    <input type="hidden" class="form-control" name="user_id" value="{{auth()->user()->id}}" required>--}}
{{--                                    <input type="hidden" class="form-control" name="post_id" value="{{$post->id}}" required>--}}
{{--                                    <input type="hidden" class="form-control" name="parent_id" value="{{$Maincomment->id}}" required>--}}
{{--                                    <input type="hidden" class="form-control" name="status" value="pending" required>--}}
{{--                                    <button id="saveSubCommentBtn"  class="btn btn-outline-primary  rounded-circle d-inline-block"><i class="fas fa-paper-plane"></i></button>--}}
{{--                                </form>--}}

{{--                                --}}{{--sub comments--}}
{{--                                <div class="sub-comments-{{$Maincomment->id}}">--}}

{{--                                    @if($subComments)--}}
{{--                                        @foreach($subComments->where('parent_id','=',$Maincomment->id) as $subComment)--}}
{{--                                            <div class="single-sub-comment comment-{{$subComment->id}} pl-5 mb-2 " comment-id="{{$subComment->id}}" >--}}
{{--                                                @if(!empty( $subComment->user->avatar))--}}
{{--                                                    <img style="float: left;margin-right:12px;" src="{{ asset('uploads/users/' . $subComment->user->avatar) }}" height="30" width="30" class="rounded-circle">--}}
{{--                                                @else--}}
{{--                                                    <img style="float: left;margin-right:12px;" src="https://picsum.photos/200" height="30" width="30" class="rounded-circle">--}}
{{--                                                @endif--}}
{{--                                                <div class="comment-details">--}}
{{--                                                    <span>--}}
{{--                                                        {{$subComment->user->full_name}}--}}
{{--                                                        <a comment-id="{{$subComment->id}}" class="delete-comment">--}}
{{--                                                            <i class="fas fa-trash-alt"></i>--}}
{{--                                                        </a>--}}
{{--                                                    </span>--}}
{{--                                                    <p class="l-dark">--}}
{{--                                                        {{ $subComment->comment }}--}}
{{--                                                    </p>--}}
{{--                                                </div>--}}
{{--                                                <div class="user-actions" style="margin-left: 40px;font-size:12px;">--}}
{{--                                                    <a style="text-decoration: none" class="link-action" href="#">--}}
{{--                                                        <i class="far fa-thumbs-up"></i> 0 Likes--}}
{{--                                                    </a>--}}

{{--                                                    <a style="text-decoration: none" class="link-action" href="#">--}}
{{--                                                        <i class="far fa-thumbs-down"></i> 0 Dislike--}}
{{--                                                    </a>--}}


{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}

{{--                                </div>--}}









{{--                      </div> <!-- Single-Main-Comment  -->--}}
{{--                    @endforeach--}}
{{--                   @endif--}}
{{--                 </div> <!-- post comments -->--}}



{{--        </div>--}}


{{--   </div>--}}









{{--  <div class="col-md-4">--}}
{{--    <div class="categories">--}}
{{--        <ul class="list-group">--}}
{{--            <li class="list-group-item disabled" aria-disabled="true">Categories</li>--}}
{{--             @if($categories)--}}
{{--                 @foreach($categories as $category)--}}
{{--                 <li class="list-group-item d-flex justify-content-between align-items-center">--}}
{{--                    <a href="#" class="">{{ $category->title }}</a>--}}
{{--                    <span class="badge badge-primary badge-pill">{{ $category->posts->count() }}</span>--}}
{{--                </li>--}}
{{--                 @endforeach--}}
{{--             @endif--}}


{{--        </ul>--}}
{{--    </div>--}}
{{--  </div>--}}




{{--  </div>--}}

<!-- ##### Breadcrumb Area Start ##### -->
    <div class="vizew-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Archives</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcrumb Area End ##### -->



     <section class="post-details-area mb-80">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="post-details-thumb mb-50">
                         <img style="width: 100%;border-radius: 5px;" src="{{ asset('uploads/posts/' . $post->image) }}" alt="">
                     </div>
                 </div>
             </div>

             <div class="row justify-content-center">
                 <!-- Post Details Content Area -->
                 <div class="col-12 col-lg-8 col-xl-7">
                     <div class="post-details-content">
                         <!-- Blog Content -->
                         <div class="blog-content">

                             <!-- Post Content -->
                             <div class="post-content mt-0">
                                 <a href="#" class="post-cata cata-sm cata-danger">{{$post->category->title}}</a>
                                 <a href="#" class="post-title mb-2"> {{$post->title}}</a>

                                 <div class="d-flex justify-content-between mb-30">
                                     <div class="post-meta d-flex align-items-center">
                                         <a href="#" class="post-author">By {{$post->user->full_name}}</a>
                                         <i class="fa fa-circle" aria-hidden="true"></i>
                                         <a href="#" class="post-date">{{$post->created_at}}</a>
                                     </div>
                                     <div class="post-meta d-flex">
                                         <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i>{{$post->comments->count()}}</a>
                                         <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 42</a>
                                         <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 7</a>
                                     </div>
                                 </div>
                             </div>

                             <p>{{$post->content}}</p>


                             <h4>Immediate Dividends</h4>

                             <ul class="unordered-list mb-0">
                                 <li>Wash the dal in 3-4 changes of water and soak in room temperature water for 10 mins while you finish the rest of preparation.</li>
                                 <li>Drain and pressure cook with salt, turmeric and water for 2 whistles.</li>
                                 <li>Remove the cooker from heat and open only after all the steam has escaped on its own.</li>
                                 <li>While the dal is cooking, heat ghee in a pan. Add hing and cumin seeds.</li>
                                 <li>When the seeds start to crackle, add ginger, and green chillies. Sauté for a minute.</li>
                                 <li>Add tomatoes and a little salt. Mix well. Cook for about 5 mins with occasional stirring.</li>
                             </ul>

                             <!-- Post Tags -->
                             <div class="post-tags mt-30">
                                 <ul>


                                     @foreach($post->tags as $tag)
                                         <li><a href="#">
                                             {{ $tag->name }}
                                         </a></li>
                                     @endforeach

                                 </ul>
                             </div>

                             <!-- Post Author -->
                             <div class="vizew-post-author d-flex align-items-center py-5">
                                 <div class="post-author-thumb">
                                     <img src="{{asset('uploads/users/' . $post->user->avatar)}}" alt="">
                                 </div>
                                 <div class="post-author-desc pl-4">
                                     <a href="#" class="author-name">{{$post->user->full_name}}</a>
                                     <p>Bio here</p>
                                     <div class="post-author-social-info">
                                         <a href="#"><i class="fa fa-facebook"></i></a>
                                         <a href="#"><i class="fa fa-twitter"></i></a>
                                         <a href="#"><i class="fa fa-pinterest"></i></a>
                                         <a href="#"><i class="fa fa-linkedin"></i></a>
                                         <a href="#"><i class="fa fa-dribbble"></i></a>
                                     </div>
                                 </div>
                             </div>

                             <!-- Related Post Area -->
                                 @if(!empty($relatedPosts))
                                 @foreach($relatedPosts as $relPost )
                             <div class="related-post-area mt-5">
                                 <!-- Section Title -->
                                 <div class="section-heading style-2">
                                     <h4>Related Post</h4>
                                     <div class="line"></div>
                                 </div>

                                 <div class="row">

                                     <!-- Single Blog Post -->

                                     <div class="col-12 col-md-6">
                                         <div class="single-post-area mb-50">
                                             <!-- Post Thumbnail -->
                                             <div class="post-thumbnail">
                                                 <img src="img/bg-img/11.jpg" alt="">

                                                 <!-- Video Duration -->
                                                 <span class="video-duration">05.03</span>
                                             </div>

                                             <!-- Post Content -->
                                             <div class="post-content">
                                                 <a href="#" class="post-cata cata-sm cata-success">Sports</a>
                                                 <a href="single-post.html" class="post-title">{{$relPost->title}}</a>
                                                 <div class="post-meta d-flex">
                                                     <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 22</a>
                                                     <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 16</a>
                                                     <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 15</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                 </div>
                             </div>

                             @endforeach
                         @endif

                             <!-- Comment Area Start -->
                             <div class="comment_area clearfix mb-50">

                                 <!-- Section Title -->
                                 <div class="section-heading style-2">
                                     <h4>Comments</h4>
                                     <div class="line"></div>
                                 </div>

                                 <ul class="ul-comments">
                                     <!-- Single Comment Area -->
                                     <li class="single_comment_area">
                                         <!-- Comment Content -->
                                         @if($mainComments->count() > 0 )
                                             @foreach($mainComments as $mainComment)
                                         <div class="comment-content d-flex">
                                             <!-- Comment Author -->
                                             <div class="comment-author">
                                                 <img style="height: 75px;" src="{{asset('uploads/users/' . $mainComment->user->avatar)}}" alt="author">
                                             </div>
                                             <!-- Comment Meta -->
                                             <div class="comment-meta">
                                                 <a href="#" class="comment-date">{{$mainComment->created_at}}</a>
                                                 <h6>{{$mainComment->user->full_name}}</h6>
                                                 <p>
                                                     {{$mainComment->comment}}
                                                 </p>
                                                 <div class="d-flex align-items-center">
                                                     <a href="#" class="like">like</a>
                                                     <a href="#" class="reply">Reply</a>
                                                 </div>
                                             </div>
                                         </div>


                                         <ol class="children children-{{$mainComment->id}}">
                                             @foreach($subComments->where('parent_id','=',$mainComment->id) as $sub)
                                             <li class="single_comment_area">
                                                 <!-- Comment Content -->
                                                 <div class="comment-content d-flex">
                                                     <!-- Comment Author -->
                                                     <div class="comment-author">
                                                         <img style="height: 65px" src="{{asset('uploads/users/' . $sub->user->avatar)}}" alt="author">
                                                     </div>
                                                     <!-- Comment Meta -->
                                                     <div class="comment-meta">
                                                         <a href="#" class="comment-date">27 Aug 2019</a>
                                                         <h6>{{$sub->user->full_name}}</h6>
                                                         <p>
                                                             {{$sub->comment}}
                                                         </p>
                                                         <div class="d-flex align-items-center">
                                                             <a href="#" class="like">like</a>
                                                             <a href="#" class="reply">Reply</a>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </li>
                                             @endforeach
                                         </ol>

                                             @endforeach
                                         @endif
                                     </li>


                                 </ul>
                             </div>

                             <!-- Post A Comment Area -->
                             <div class="post-a-comment-area">

                                 <!-- Section Title -->
                                 <div class="section-heading style-2">
                                     <h4>Leave a comment</h4>
                                     <div class="line"></div>
                                 </div>

                                 <!-- Reply Form -->
                                 <div class="contact-form-area">

                                     <form id="addMainCommentForm"  method="post">
                                         <div class="row">
                                             <div class="col-12">
                                                 <textarea  name="comment" class="form-control text-white" id="comment" placeholder="Message*"></textarea>
                                                    <input type="hidden" class="form-control" name="user_id" value="{{auth()->user()->id}}" required>
                                                    <input type="hidden" class="form-control" name="post_id" value="{{$post->id}}" required>
                                                    <input type="hidden" class="form-control" name="parent_id" value="0" required>
                                                    <input type="hidden" class="form-control" name="status" value="pending" required>
                                             </div>
                                             <div class="col-12">
                                                 <button class="btn vizew-btn mt-30" id="saveMainCommentBtn">Submit Comment</button>
                                             </div>
                                         </div>
                                     </form>

                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>

                 <!-- Sidebar Widget -->
                 <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                     <div class="sidebar-area">

                         <!-- ***** Single Widget ***** -->
                         <div class="single-widget share-post-widget mb-50">
                             <p>Share This Post</p>
                             <a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                             <a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
                             <a href="#" class="google"><i class="fa fa-google" aria-hidden="true"></i> Google+</a>
                         </div>

                         <!-- ***** Single Widget ***** -->
                         <div class="single-widget p-0 author-widget">
                             <div class="p-4">
                                 <img class="author-avatar" src="{{asset('uploads/users/' . $post->user->avatar)}}" alt="">
                                 <a href="#" class="author-name">{{$post->user->full_name}}</a>
                                 <div class="author-social-info">
                                     <a href="#"><i class="fa fa-facebook"></i></a>
                                     <a href="#"><i class="fa fa-twitter"></i></a>
                                     <a href="#"><i class="fa fa-pinterest"></i></a>
                                 </div>
                                 <p>bio here</p>
                             </div>

                             <div class="authors--meta-data d-flex">
                                 <p>Posted<span class="counter">{{$post->user->posts->count()}}</span></p>
                                 <p>Comments<span class="counter">230</span></p>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </section>




 </div>
</div>
@endsection

@section('ajax-frontend')
    <script>


        // show reply comment form

        $('.showSubCommentForm').on('click',function (e){
            e.preventDefault();
            var mainID = $(this).attr('comment-id');

            // hide all sub forms
            var allForms = $('.AddSubCommentForm').map(function(){
                this.style.display = 'none'
            })

            // show selected form
            $(`form[form-for='${mainID}']`).show(50)

        });


        /********************ADD COMMENT ********************/

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // ADD MAIN COMMENT AJAX

        $(document).on('click','#saveMainCommentBtn',function(e){

            e.preventDefault();

            var formData = new FormData($('#addMainCommentForm')[0]);

            $.ajax({
                type:'post',
                url:"{{ route('user.comments.save') }}",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    if(data.status == 200){
                        $('#addMainCommentForm')[0].reset();
                        var newComment = `

                     <li class="single_comment_area">
                        <div class="comment-content d-flex">
                            <div class="comment-author">
                                <img style="height: 75px;" src=${data.avatarPath} alt="author">
                            </div>

                             <div class="comment-meta">
                                 <a href="#" class="comment-date">${data.comment.created_at}</a>
                                 <h6>${data.user.full_name}</h6>
                                 <p>
                                     ${data.comment.comment}
                                </p>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="like">like</a>
                                    <a href="#" class="reply">Reply</a>
                                </div>
                            </div>
                        </div>
                     </li>

`;


                        var comments=$('.comment_area .ul-comments');
                        comments.append(newComment);
                    }
                }

            })
        });

       /*********************ADD SUB COMMENT *****************/

        var allForms = $('.AddSubCommentForm').map(function(){
            this.addEventListener('submit', e => {
                console.log('submitted: ', this.getAttribute('form-for'))
                e.preventDefault();

                this.style.display = 'none'

                var formData = new FormData(this);

                $.ajax({
                    type:'post',
                    url:"{{ route('user.comments.save') }}",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data){
                        if(data.status == 200){
                            $('.AddSubCommentForm input[name="comment"]').val('');

                            var newSubComment=`
                                <li class="single_comment_area">
                                <div class="comment-content d-flex">
                                <div class="comment-author">
                                <img style="height: 75px;" src=${data.avatarPath} alt="author">
                                </div>

                            <div class="comment-meta">
                                <a href="#" class="comment-date">${data.comment.created_at}</a>
                                <h6>${data.user.full_name}</h6>
                                <p>
                                    ${data.comment.comment}
                                </p>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="like">like</a>
                                    <a href="#" class="reply">Reply</a>
                                </div>
                            </div>
                        </div>
                        </li>

                        `;

                            var comment = $('.comment_area .ul-comments .children-'+data.comment.parent_id );
                            comment.append(newSubComment);

                        }

                    }

                });

            })
        });



        /*********************DELETE COMMENT *****************/

        $(document).on("click",".delete-comment",function(e){

            e.preventDefault();

            var  commentID = $(this).attr('comment-id');

            $.ajax({
                type:'POST',
                url:"{{ route('admin.comments.delete') }}",
                data:{
                    '_token': "{{ csrf_token() }}" ,
                    'comment_id' : commentID
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
