@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todos App</div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('todos.store')}}">
                        @csrf
                        <div class="mb-3"> 
                          <label  class="form-label">Title</label>
                          <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for="description" class="form-label">Description</label>
                          <textarea name="description" class="form-control" id="description" cols="5" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="due_date">Due Date</label>
                            <input type="date" name="due_date" class="form-control">
                        </div>
                        <div>
                            <label for="priority">Priority</label>
                            <select name="priority" id="" class="form-control">
                            <option disabled selected>Select Option</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary my-3">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
