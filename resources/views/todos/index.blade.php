@extends('layouts.app')

@section('styles')
<style>
#outer
{
    width:auto;
    text-align: center;
}
.inner
{
    display: inline-block;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">TODOs</div>

                <div class="card-body">
                        @if(Session::has('alert-success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('alert-success')}}
                        </div>
                        @endif

                        @if(Session::has('alert-info'))
                        <div class="alert alert-info" role="alert">
                            {{ Session::get('alert-info')}}
                        </div>
                        @endif

                        @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error')}}
                        </div>
                        @endif
                    <a class="btn btn-info" href="{{ route('todos.create')}}">Create a todo</a>
                    <hr>
                    <br>
                    <br>

                    @if (count($todos) > 0)
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Completed</th>
                            <th scope="col" class="outer">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($todos as $todo)
                          <tr>
                            <td class="col-md-2">{{$todo->title}}</td>
                            <td class="col-md-5">{{ $todo->description }}</td>
                            <td>
                                @if ($todo->priority == 'Low')
                                <a href="?priority={{ $todo->priority }}" class="btn btn-success btn-sm">{{$todo->priority}}</a>
                               @elseif ($todo->priority == "Medium")
                                <a href="?priority={{ $todo->priority }}" class="btn btn-warning btn-sm">{{$todo->priority}}</a>
                                @else
                                <a href="?priority={{ $todo->priority }}" class="btn btn-danger btn-sm">{{$todo->priority}}</a>
                               @endif
                            </td>
                            <td>{{ $todo->due_date}}</td>
                            <td>
                                @if ($todo->is_completed == 'Completed')
                                 <a href="?is_completed={{$todo->is_completed}}" class="btn btn-success btn-sm">{{$todo->is_completed}}</a>
                                @else
                                 <a href="?is_completed={{$todo->is_completed}}" class="btn btn-danger btn-sm">{{$todo->is_completed}}</a>
                                @endif
                            </td>
                            <td class="outer" class="col-md-4">
                                <a href="{{ route('todos.show', $todo->id)}}" class="inner btn btn-success btn-sm">View</a>
                                <a href="{{ route('todos.edit', $todo->id)}}" class="inner btn btn-info btn-sm">Edit</a>
                                <form method="POST" action="{{ route('todos.destroy')}}" class="inner">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    @else
                        <h3>Please create a Todo Activity</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
