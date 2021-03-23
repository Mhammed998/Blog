@extends('layouts.admin')
@section('admin-title', 'Dashboard | Tags')
@section('content-admin')
<div class="container-fluid">

   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tags</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#createTagModal">
  Create A New Tag
</button>



  <table class="table table-bordered">
    <div id="success" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;margin: 5px 10px 10px 10px;">
        Tag has been updated successfully
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Link</th>
        <th scope="col">Created_at</th>
        <th scope="col">Updated_at</th>
        <th scope="col">Controls</th>
      </tr>
    </thead>
    <tbody>

        @if($tags)
            @foreach($tags as $tag)
            <tr class="tag-{{ $tag->id }}">
                <th scope="row">{{ $tag->id }}</th>

                <td>{{ $tag->name }}</td>
                <td>{{ $tag->link }}</td>
                <td>{{ $tag->created_at }}</td>
                <td>{{ $tag->updated_at }}</td>
                <td>
                  <a data-toggle="modal" data-target="#editTagModal"  tag-id={{ $tag->id }}  class="btn btn-info rounded-circle mr-1 edit-tag">
                      <i class="fas fa-pen"></i>
                  </a>
                  <a  tag-id={{ $tag->id }} class="btn btn-danger rounded-circle  delete-tag">
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
            </tr>


        @endif



    </tbody>
  </table>








  <!--- CREATE TAG MODAL ---->

<div class="modal fade" id="createTagModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create A New Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger print-error-msg" style="display: none">
            <ul> </ul>
          </div>
           <form id="createTagForm"  class="form-horizontal">
                @csrf
                <div class="card-body">


                  <div class="form-group">
                    <label for="name">Name</label>
                      <input name="name" type="text" class="form-control" id="name" placeholder="Tag Name Here..">
                  </div>


                  <div class="form-group">
                    <label for="link">Link</label>
                      <input name="link" type="text" class="form-control" id="link" placeholder="Tag Link here..">
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button id="saveTagBtn" class="btn btn-info">Add Tag</button>
                </div>
                <!-- /.card-footer -->
              </form>
      </div>

    </div>
  </div>
</div>


  <!-- EDIT TAG MODAL -->
  <div class="modal fade" id="editTagModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Tag

          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="editTagForm"  class="form-horizontal">
              @csrf
                <div class="card-body">
                      <input name="id" type="hidden"  id="oldtag_id">


                  <div class="form-group">
                    <label for="name">Name</label>
                      <input name="name" type="text" class="form-control" id="oldname" placeholder="Tag Name Here..">
                  </div>


                  <div class="form-group">
                    <label for="link">Link</label>
                      <input name="link" type="text" class="form-control" id="oldlink" placeholder="Tag Link here..">
                  </div>




                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button id="saveTagUpdatesBtn" class="btn btn-info">Save updates</button>
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



/*****************DELETE TAG *****************/

$(document).on('click','.delete-tag',function(e){

e.preventDefault();

var  tagID = $(this).attr('tag-id');

    $.ajax({
        type:'POST',
        url:"{{ route('admin.tags.delete') }}",
        data:{
        '_token': "{{ csrf_token() }}" ,
        'tag_id' : tagID
        },
        success:function(data){
            if(data.status == 200){
          $('.tag-'+data.id).remove();
        }
    }



});


});


/****************************EDIT TAG *********************************/


$(document).on('click','.edit-tag',function(e){

e.preventDefault();

var  tag_id = $(this).attr('tag-id');

    $.ajax({
        type:'POST',
        url:"{{ route('admin.tags.edit') }}",
        data:{
            '_token': '{{ csrf_token() }}',
            'tag_id' : tag_id
        },
        success:function(data){
            if(data.status == 200){
                //show modal & fill inputs with data
                $('#oldtag_id').val(data.tag[0].id);
                $('#oldname').val(data.tag[0].name);
                $('#oldlink').val(data.tag[0].link);
            }
        }
    });



});

/****************************UPDATE A  TAG ***************************/

$(document).on('click','#saveTagUpdatesBtn',function(e){

        e.preventDefault();

        var formData = new FormData($('#editTagForm')[0]);

        $.ajax({
        type:'post',
        url:"{{ route('admin.tags.update') }}",
        data: formData,
          processData: false,
          cache: false,
          contentType: false,
        success:function(data){
           if(data.status == 200){
               $('#editTagModal').modal('hide');
              $('#success').show();
           }

        }

        });

});

/***************************SAVE A NEW TAG *******************************/


$(document).on('click','#saveTagBtn',function(e){

        e.preventDefault();

        var formData = new FormData($('#createTagForm')[0]);

        $.ajax({
        type:'post',
        url:"{{ route('admin.tags.save') }}",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
           if(data.status == 200){
               $('#createTagModal').modal('hide');
              $('#success').show();
              $('#createTagForm')[0].reset();
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






