@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-12 m-auto">
                <div class="text-left">
                    <a href="{{route('tasks.index')}}" class="btn btn-primary my-2">
                        <i class="fa fa-list"></i>
                        Tasks
                    </a>
                </div>
                <h4 class="text-center">
                    {{$title??'Project For Test'}}
                </h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <td>id</td>
                            <td>{{$task->id}}</td>
                        </tr>
                        <tr>
                            <td>username</td>
                            <td>{{$task->User->name}}</td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td>{{$task->User->email}}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{$task->name}}</td>
                        </tr>
                        <tr>
                            <td>Note</td>
                            <td>
                                <p class="text-justify">
                                    {{$task->note}}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>created at</td>
                            <td>{{$task->created_at}}</td>
                        </tr>
                        <tr>
                            <td>updated at</td>
                            <td>{{$task->updated_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

