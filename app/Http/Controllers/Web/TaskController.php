<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->check()){
            return  abort('403');
        }
        else{
            $title='Tasks';

            $tasks = Task::query();

        if($keyword = request('search')|| $filter=request('date')) {
            $tasks->orWhere('name' , 'LIKE' , "%{$keyword}%")
            ->orWhere('created_at','Like',"%{$filter}%");
        }
            $tasks=$tasks->where('user_id',auth()->user()->id)
                ->latest()->paginate(10);

            return  view('web.tasks.index',compact(['title','tasks']));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->check()){
            return  abort('403');
        }
        else{
            $title='Task Add';
            return  view('web.tasks.create',compact(['title']));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        if (!auth()->check()){
            return  abort('403');
        }
        else{
            $task=new Task();

            $task->user_id=auth()->user()->id;
            $task->name=$request->name;
            $task->note=$request->note;
            $task->save();

            alert()->success('Task Added','Task Add');

            return  redirect()->route('tasks.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->check()){
            return  abort('403');
        }
        else{
            $task=Task::where('user_id',auth()->user()->id)
                ->findOrFail($id);

            $title='Task '.$task->name;

            return  view('web.tasks.show',compact(['title','task']));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->check()){
            return  abort('403');
        }
        else{
            $task=Task::where('user_id',auth()->user()->id)
                ->findOrFail($id);

            $title='Task Edit '.$task->name;

            return  view('web.tasks.edit',compact(['title','task']));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        if (!auth()->check()){
            return  abort('403');
        }
        else{
            $task=Task::where('user_id',auth()->user()->id)
                ->findOrFail($id);
            $task->name=$request->name;
            $task->user_id=auth()->user()->id;
            $task->note=$request->note;
            $task->save();

            alert()->success('Task Updated','Task Update');

            return  redirect()->route('tasks.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->check()){
            return  abort('403');
        }
        else{
            $task=Task::where('user_id',auth()->user()->id)
                ->findOrFail($id);

            $task->delete();

            alert()->warning('Task Deleted','Task Delete');

            return  redirect()->route('tasks.index');
        }
    }
}
