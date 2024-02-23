@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Activity Details</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="btn btn-sm btn-info my-2 py-2" href="{{ url()->previous() }}">Back</a>
                    <br>
                    <b>Your Activity is:</b> <h2>{{ $todo->title }}</h2>
                    <br>
                    <b>Description:</b> <h3>{{ $todo->description }}</h3>
                    <br>
                    <b>Priority</b> <h3>{{ $todo->priority}}</h3>
                    <div class="row">
                        <div class="col-md-1">
                            <a href="{{ route('todos.edit', $todo->id)}}" class="inner btn btn-info btn-sm py-1 px-3">Edit</a>
                        </div>
                        <div class="col-md-1">
                            <form method="POST" action="{{ route('todos.destroy')}}" class="inner">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                                <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                            </form>
                        </div>
                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
