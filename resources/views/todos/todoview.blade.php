@extends('layouts.app');
@section('title', 'Todos');

@section('action-content')
<a href="{{ route('todos.create')}}" class="btn btn-success mx-4 my-3">Add Task</a>
@endsection

@section('content')
<body>

    <section style="padding-top: 60px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </section>
    {!! $dataTable->scripts() !!}
</body>
</html>
@endsection
