<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Session;

class TodoController extends Controller
{
    
    public function index() 
    {
        
        
        return view('todos.index', [
            'todos' =>  Todo::latest()->filter(request(['priority', 'is_completed']))->get()
        ]);

    }

    public function edit($id)
    {
        $todo = Todo::find($id);
        if (!$todo)
        {
            request()->session()->flash('error', 'Unable to locate the activity');
            return to_route('todos.index')->withErrors([
                'error'=> 'Unable to locate the activity'
            ]);
        }
        return view('todos.edit', [
            'todo' => $todo
        ]);
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(TodoRequest $request)
    {
        //$request->validated();  
        //dd($request->priority);
        Todo::create([
            'title' => $request-> title,
            'description' => $request-> description,
            'due_date' => $request->due_date,
            'priority' => $request-> priority,
            'is_completed' => 'Pending',

        ]);

        $request->session()->flash('alert-success', 'Todo Created Successfully');

        return to_route('todos.index');
    }

    public function show($id)
    {
       
       $todo = Todo::find($id);
       if ($todo)
       {
        return view('todos.show', [
            'todo' => $todo
        ]);
       }
       else
       {
        request()->session()->flash('error', 'Unable to locate the activity');
        return to_route('todos.index')->withErrors([
            'error'=> 'Unable to locate the activity'
        ]);
       }
    }
    public function update (TodoRequest $request)
    {
        $todo = Todo::find($request->todo_id);
        if (!$todo || Session::has('error'))
        {
            request()->session()->flash('error', 'Unable to Update');
            return to_route('todos.index')->withErrors([
                'error'=> 'Unable to Update'
            ]);
        }
        
        $todo->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'is_completed'=>$request->is_completed,
            'due_date'=>$request->due_date,
            'priority'=>$request->priority

        ]);

        $request->session()->flash('alert-info', 'Todo Updated Successfully');

        return to_route('todos.index');
    }

    public function destroy(Request $request)
    {
        $todo = Todo::find($request->todo_id);
        if (!$todo)
        {
            request()->session()->flash('error', 'Unable to Delete');
            return to_route('todos.index')->withErrors([
                'error'=> 'Unable to Delete'
            ]);
        }
        $todo->delete();
        $request->session()->flash('alert-info', 'Todo Deleted Successfully');

        return to_route('todos.index');
    }
}
