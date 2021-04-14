<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskAdminController extends Controller
{
    public function index()
    {
        if(!Gate::allows('isAdmin')){
            alert()->error('access not','access');
            abort(403,"access bot");
        }

        $tasks = Task::query();
           if($keyword = request('search')|| $filter=request('date')) {
            $tasks->orWhere('name' , 'LIKE' , "%{$keyword}%")
            ->orWhere('created_at','Like',"%{$filter}%");
        }

        $tasks=$tasks->with('User')
            ->latest()->paginate(10);

        $title='Tasks with User';

        return view('web.tasks.all',
            compact(['title','tasks']));
    }

    public function show($user_id,$task_id)
    {

        if(!Gate::allows('isAdmin')){

            alert()->error('access not','access');

            abort(403,"access bot");
        }

        $task=Task::with('User')
            ->findOrFail($task_id)
            ->whereHas('User',function ($query) use($user_id){
        $query->where('user_id',$user_id);
            })->first();

        $title='task '.$task->name;

        return view('web.tasks.show_user',
            compact(['title','task']));
    }
}
