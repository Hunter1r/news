@extends('layouts.adminMain');

@section('content')
    <form method="POST"
        @if($category->id)
        action="{{ route('admin.categories.update',['category'=>$category]) }}"
        @else
          action="{{ route('admin.categories.store') }}"
        @endif
    >
    @csrf    
    @if($category->id)
        @method('PUT')
    @endif

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{$category->id ? 'Update':'Create'}} category</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="submit" class="btn btn-success float-sm-end">{{$category->id ? 'Update': 'Create'}}</button>
            </div>
        </div>

        
        <div class="row my-2">
            <label for="name" class="col-sm-1 col-form-label">Name</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="name" name="name" value="{{$category->name}}" required>
            </div>
        </div>
        

    </form>
@endsection
