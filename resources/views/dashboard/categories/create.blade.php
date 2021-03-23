@extends('layouts.admin')
@section('admin-title', 'Dashboard | Categories')
@section('content-admin')
<div class="container-fluid">

   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Categories</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

    <!-- Add New Category Form  -->

        <div class="card card-info ml-5 mr-5">
          <div class="card-header">
            <h3 class="card-title">Create A New Category</h3>
          </div>
          <div id="success" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;margin: 5px 10px 0px 10px;">
              Category has been added successfully
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <!-- form start -->

          <div class="alert alert-danger print-error-msg" style="display: none">
            <ul> </ul>
          </div>


          <form id="createCategoryForm" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="card-body row">

            <div class="col-md-6">
              <div class="form-group">
                <label for="title">Title</label>
                  <input name="title" type="text" class="form-control" id="title" placeholder="title here..">
              </div>


              <div class="form-group">
                <label>Description</label>
                  <textarea name="description" cols="5" rows="5" class="form-control"></textarea>
              </div>
            </div>

            <div class="col-md-6">

              <div class="form-group">
                <label for="image">Image</label>
                  <input name="image" type="file" class="form-control" id="image" placeholder="Image here..">
              </div>

              <div class="form-group">
                <label>Parent</label>
                  <select class="form-control" name="parent_id">
                    <option value="0">Main category</option>
                    @if($cates)
                        @foreach($cates as $cate)
                            <option value="{{ $cate->id }}">{{ $cate->id }}-{{ $cate->title }}</option>
                        @endforeach
                    @endif
                  </select>
              </div>

              <div class="form-group">
                <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="pending">pending</option>
                    <option value="activated">activated</option>
                  </select>
              </div>

            </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button id="saveCategoryBtn" class="btn btn-info">Save category</button>
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

$("#saveCategoryBtn").click(function(e){

        e.preventDefault();

        var formData = new FormData($('#createCategoryForm')[0]);

        $.ajax({
        type:'post',
        url:"{{ route('admin.categories.save') }}",
        enctype: 'multipart/form-data',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
           if(data.status == 200){
              $('#success').show();
              $('#createCategoryForm')[0].reset();
           }
           else if(data.status == 400){
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
