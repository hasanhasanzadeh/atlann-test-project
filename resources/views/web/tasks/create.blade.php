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
                    <form action="{{route('tasks.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" placeholder="Please Enter Name" class="form-control" id="name" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea name="note" placeholder="Please Enter Name" class="form-control" id="note" rows="4">{{old('note')}}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                {{$title}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


