@extends('layouts.admin')
@section('admin-title', 'Social | Dashboard')
@section('content-admin')
    <div class="container-fluid">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $categories->count() }}</h3>

                                <p>Categories</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $posts->count() }}</h3>

                                <p>Posts</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $users->count() }}</h3>

                                <p>Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion people"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $comments->count() }}</h3>

                                <p>Comments</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-comment"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-6">
                        <!-- TO DO List -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ion ion-clipboard mr-1"></i>
                                    To Do List
                                </h3>

                                <div class="card-tools">
                                    <ul class="pagination pagination-sm">
                                        <li class="page-item"><a class="page-link">{{ $tasks->count() }} Tasks</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <ul class="todo-list" data-widget="todo-list">

                                    @if ($tasks)
                                        @foreach ($tasks as $task)
                                            <li class="task-{{ $task->id }}">
                                                <!-- drag handle -->
                                                <span class="handle">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </span>
                                                <!-- checkbox -->
                                                <div class="icheck-primary d-inline ml-2">
                                                    <input {{ $task->done == 'yes' ? 'checked' : ' ' }} type="checkbox">
                                                    <label task-id={{ $task->id }} class="done-task"></label>
                                                </div>
                                                <!-- todo text -->
                                                <span class="text">{{ $task->task }}</span>
                                                <!-- Emphasis label -->
                                                <small class="badge badge-danger"><i class="far fa-clock"></i>
                                                    {{ $task->created_at }}</small>
                                                <!-- General tools such as edit or delete-->
                                                <div class="tools">
                                                    <a task-id={{ $task->id }} href="" class='delete-task'><i
                                                            class="fas fa-trash"></i></a>
                                                </div>
                                            </li>



                                        @endforeach
                                    @endif



                                </ul>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <button type="button" data-toggle="modal" data-target="#createTaskModal"
                                    class="btn btn-info float-right"><i class="fas fa-plus"></i> Add item</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                   <div class="col-md-6">
                      <div class="row">
                        <!-- small box -->
                        <div class="col-md-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $users->where('type','=','author')->count() }}</h3>

                                <p>Authors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-people"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        </div>

                        <!-- small box -->
                        <div class="col-md-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $tags->count() }}</h3>

                                    <p>Tags</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-people"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                            </div>


                      </div>
                   </div>




                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->


        <!-- Modal -->
        <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create A New Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="success" class="alert alert-success alert-dismissible fade show" role="alert"
                            style="display: none;margin: 5px 10px 10px 10px;">
                            Task has been created successfully
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-danger print-error-msg" style="display: none">
                            <ul> </ul>
                          </div>

                        <form id="createTaskForm" class="form-horizontal">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Description</label>
                                    <input name="task" type="text" class="form-control" id="task">
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button id="saveTaskBtn" class="btn btn-info">Add Task</button>
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
        /***************************SAVE A NEW TAG *******************************/


        $(document).on('click', '#saveTaskBtn', function(e) {

            e.preventDefault();

            var formData = new FormData($('#createTaskForm')[0]);

            $.ajax({
                type: 'post',
                url: "{{ route('admin.tasks.save') }}",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.status == 200) {
                        $('#createTaskModal').modal('hide');
                        $('#success').html(data.msg);
                        $('#createTaskForm')[0].reset();

                        var taskItem = `
                                <li class="task-${data.task.id}">
                                    <!-- drag handle -->
                                    <span class="handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                    </span>
                                    <!-- checkbox -->
                                    <div  class="icheck-primary d-inline ml-2" >
                                        <input ${data.task.done == "yes" ? 'checked': ''}  type="checkbox"  >
                                        <label task-id="${data.task.id}" class="done-task"></label>
                                    </div>
                                    <!-- todo text -->
                                    <span class="text">${data.task.task}</span>
                                    <!-- Emphasis label -->
                                    <small class="badge badge-danger"><i class="far fa-clock"></i>${data.task.created_at}</small>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <a task-id="${data.task.id}" href="" class='delete-task'><i class="fas fa-trash"></i></a>
                                    </div>
                                </li>
            `;

                        var todoList = $('.todo-list');
                        todoList.append(taskItem);



                    }else if(data.status == 400){
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

        /***********************************Delete Task **********************************/


        $(document).on('click', '.delete-task', function(e) {

            e.preventDefault();

            var task_id = $(this).attr('task-id');

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.tasks.delete') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'task_id': task_id
                },
                success: function(data) {
                    if (data.status == 200) {
                        $('.task-' + data.id).remove();
                    }
                }



            });


        });

        /***********************************update Task status **********************************/


        $(document).on('click', '.done-task', function(e) {

            e.preventDefault();

            var task_id = $(this).attr('task-id');

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.tasks.done') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'task_id': task_id
                },
                success: function(data) {
                    if (data.task.done == "yes") {
                        console.log(data.task_id);
                        $('.task-' + data.task_id + ' input[type="checkbox"]').attr("checked", true);
                        //  $('.task-' + data.task_id + ' .text' ).css('text-decoration','line-through');
                        $('.task-' + data.task_id).addClass('done')
                    } else {
                        $('.task-' + data.task_id + ' input[type="checkbox"]').removeAttr("checked");
                        //  $('.task-' + data.task_id + ' .text' ).css('text-decoration','none');
                        $('.task-' + data.task_id).removeClass('done')

                    }
                }



            });


        });

    </script>




@endsection
