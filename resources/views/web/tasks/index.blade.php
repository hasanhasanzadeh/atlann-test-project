@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-12 m-auto">
                <div class="text-left">
                    <a href="{{route('tasks.create')}}" class="btn btn-primary my-2">
                        <i class="fa fa-plus"></i>
                        Add Task
                    </a>
                </div>
                <h4 class="text-center">
                    {{$title??'Project For Test'}}
                </h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>note</th>
                                <th>created_at</th>
                                <th>operation</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{$task->id}}</td>
                                <td><a href="{{route('tasks.show',$task->id)}}" class="nav-link">{{$task->name}}</a></td>
                                <td>{{\Illuminate\Support\Str::limit($task->note, 150, $end='...') }}</td>
                                <td>{{$task->created_at}}</td>
                                <td class="custom-control-inline">
                                    <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-warning">
                                        <i class="fa fa-edit"></i>
                                        Edit
                                    </a>
                                    <form action="{{route('tasks.destroy',$task->id)}}" method="POST">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip" title='Delete'>
                                                <i class="fa fa-trash"></i>
                                                Delete
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="text-center">
                            <td colspan="5">
                                {{$tasks->links()}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('.show_confirm').click(function(e) {
            if(!confirm('Do You delete the record?')) {
                e.preventDefault();
            }
        });
    </script>
@endsection

