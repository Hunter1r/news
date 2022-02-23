@extends('layouts.adminMain');

@section('content')
    <form method="POST"
        @if($feedback->id)
        action="{{ route('admin.feedbacks.update',['feedback'=>$feedback]) }}"
        @else
          action="{{ route('admin.feedbacks.store') }}"
        @endif
    >
    @csrf    
    @if($feedback->id)
        @method('PUT')
    @endif

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{$feedback->id ? 'Update':'Create'}} feedbacks</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="submit" class="btn btn-success float-sm-end">{{$feedback->id ? 'Update': 'Create'}}</button>
            </div>
        </div>
        
        <div class="row my-2">
            <label for="name" class="col-sm-1 col-form-label">Name</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="name" name="name" value="{{$feedback->name}}" required>
            </div>
        </div>

        <div class="row my-2">
            <label for="email" class="col-sm-1 col-form-label">E-mail</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="email" name="email" value="{{$feedback->email}}" required>
            </div>
        </div>

        <div class="row my-2">
            <label for="feedback" class="col-sm-1 col-form-label">Feedback</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="feedback" name="feedback" value="{{$feedback->feedback}}" required>
            </div>
        </div>

    </form>
@endsection
