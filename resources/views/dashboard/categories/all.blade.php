@extends('layouts.admin')
@section('admin-title', 'Dashboard | Categories')
@section('content-admin')
<div class="container-fluid">

   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Categories Management</h1>
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

<a class="btn btn-primary mb-2" href="{{ route('admin.categories.create') }}">Create Category</a>
  <table class="table table-bordered">
    <div id="success" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;margin: 5px 10px 10px 10px;">
        Category has been updated successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Parent</th>
        <th scope="col">Controls</th>
      </tr>
    </thead>
    <tbody>

        @if($categories)
            @foreach($categories->where('parent_id','=','0') as $category)
            <tr class="category-{{ $category->id }} bg-secondary">
                <th scope="row">{{ $category->id }}</th>
                <td>
                    @if(!empty($category->cate_image))
                    <img height="40" width="40" class="rounded-circle" src="{{ asset('uploads/categories/' . $category->cate_image  ) }}"  >
                    @else
                    <img height="40" width="40" class="rounded-circle" src="https://via.placeholder.com/150"  >
                    @endif
                </td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->description }}</td>
                <td><span class="badge badge-primary">{{ $category->status }}</span></td>
                <td>{{ $category->parent_id=="0" ? "Main Category" : "Sub" }}</td>
                <td>
                  <a data-toggle="modal" data-target="#editCategoryModal" href="#" cate-id={{ $category->id }}  class="btn btn-info rounded-circle mr-1 edit-category">
                      <i class="fas fa-pen"></i>
                  </a>
                  <a  cate-id={{ $category->id }} class="btn btn-danger rounded-circle  delete-category">
                      <i class="fas fa-trash"></i>
                  </a>
                </td>

            </tr>


            @if($categories->where('parent_id','!=','0'))
             @foreach($categories->where('parent_id','=',$category->id) as $subCategory)
             <tr class="category-{{ $subCategory->id }} ">
                <th scope="row">{{ $subCategory->id }}</th>
                <td>
                    @if(!empty($subCategory->cate_image))
                    <img height="40" width="40" class="rounded-circle" src="{{ asset('uploads/categories/' . $subCategory->cate_image  ) }}"  >
                    @else
                    <img height="40" width="40" class="rounded-circle" src="https://via.placeholder.com/150"  >
                    @endif
                </td>
                <td>{{ $subCategory->title }}</td>
                <td>{{ $subCategory->description }}</td>
                <td><span class="badge badge-primary">{{ $subCategory->status }}</span></td>
                <td>{{ $subCategory->parent_id=="0" ? "Main Category" : "Sub-category" }}</td>
                <td>
                  <a data-toggle="modal" data-target="#editCategoryModal" href="#" cate-id={{ $subCategory->id }}  class="btn btn-info rounded-circle mr-1 edit-category">
                      <i class="fas fa-pen"></i>
                  </a>
                  <a  cate-id={{ $subCategory->id }} class="btn btn-danger rounded-circle  delete-category">
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









  <!-- Modal -->
  <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Category

          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="editCategoryForm" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="card-body row">



                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Title</label>
                      <input name="title" type="text" class="form-control" id="title" placeholder="title here..">
                  </div>

                 <div class="form-group">
                      <input id="cateID" name="category_id" type="hidden" class="form-control">
                  </div>


                  <div class="form-group">
                    <label>Description</label>
                      <textarea id="description" name="description" cols="5" rows="5" class="form-control"></textarea>
                  </div>
                </div>

                <div class="col-md-6">

                  <div class="form-group">
                    <label for="image">Image</label>
                      <input name="image" type="file" class="form-control" id="image" placeholder="Image here..">
                  </div>

                  <div class="form-group">
                    <label>Parent</label>
                      <select  id="parent_id" class="form-control" name="parent_id">
                        <option value="0">Main category</option>
                        @if($categories)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->id }}-{{ $category->title }}</option>
                            @endforeach
                        @endif
                      </select>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                      <select id="status" class="form-control" name="status">
                        <option value="pending">pending</option>
                        <option value="activated">activated</option>
                      </select>
                  </div>

                </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button id="saveCategoryUpdatesBtn" class="btn btn-info">Save updates</button>
                </div>
                <!-- /.card-footer -->
              </form>
        </div>

      </div>
    </div>
  </div>



</div>
@endsection
@section('ajax-backend')

<script>

/*****************DELETE CATEGORY *****************/

$(document).on("click",".delete-category",function(e){

  e.preventDefault();

   var  $cateID = $(this).attr('cate-id');

    $.ajax({
        type:'POST',
        url:"{{ route('admin.categories.delete') }}",
        data:{
        '_token': "{{ csrf_token() }}" ,
        'category_id' : $cateID
        },
        success:function(data){
            if(data.status == 200){
          $('.category-'+data.id).remove();
        }
    }



     });


});



/***************************Edit Category ****************************/


$(document).on('click','.edit-category',function(e){

   e.preventDefault();

    var  $cateID = $(this).attr('cate-id');

    $.ajax({
        type:'POST',
        url:"{{ route('admin.categories.edit') }}",
        data:{
        '_token': "{{ csrf_token() }}" ,
        'category_id' : $cateID
        },
        success:function(data){
            if(data.status == 200){
             //show modal & fill inputs with data
             $('#cateID').val(data.category.id);
             $('#title').val(data.category.title);
             $('#description').val(data.category.description);
             $('#parent_id').val(data.category.parent_id);
             $('#status').val(data.category.status);
        }
    }



   });


});

/******************************Update Category ********************************/

$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
});

$(document).on('click','#saveCategoryUpdatesBtn',function(e){

        e.preventDefault();

        var formData = new FormData($('#editCategoryForm')[0]);

        $.ajax({
        type:'post',
        url:"{{ route('admin.categories.update') }}",
        enctype: 'multipart/form-data',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
           if(data.status == 200){
               $('#editCategoryModal').modal('hide');
              $('#success').show();
              $('#editCategoryForm')[0].reset();
           }

        }

        });

});











</script>
@endsection






