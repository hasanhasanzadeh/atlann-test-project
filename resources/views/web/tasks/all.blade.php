@extends('layouts.app')

@section('content')
    <div class="container">
        <div class"row">
            <div class="col-md-10 col-12 m-auto">
		  <form action="" method="get">
                    <input type="date" name="date" >
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-filter"></i>
                        filter
                    </button>
                </form>            
            </div>        
        </div>
        <div class="row">
            <div class="col-md-10 col-12 m-auto">
                <h4 class="text-center">
                    {{$title??'Project For Test'}}
                </h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>username</th>
                                <th>name</th>
                                <th>note</th>
                                <th>created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->User->name}}</td>
                                <td><a href="{{url('admin/all/'.$task->User->id.'/tasks/'.$task->id)}}" class="nav-link">{{$task->name}}</a></td>
                                <td>{{\Illuminate\Support\Str::limit($task->note, 150, $end='...') }}</td>
                                <td>{{$task->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="text-center">
                            <td colspan="5">
                                {{$tasks->links()}}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

