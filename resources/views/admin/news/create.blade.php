@extends('layouts.adminMain');

@section('content')
    <form method="POST"
        @if($news->id)
        action="{{ route('admin.news.update',['news'=>$news]) }}"
        @else
          action="{{ route('admin.news.store') }}"
        @endif
    >
    @csrf    
    @if($news->id)
        @method('PUT')
    @endif

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{$news->id ? 'Update':'Create'}} news</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="submit" class="btn btn-success float-sm-end">{{$news->id ? 'Update': 'Create'}}</button>
            </div>
        </div>

        <div class="row my-2">
            <label for="date" class="col-sm-1 col-form-label">Date</label>
            <div class="col-sm-11">
                <input type="date" class="form-control" id="date" name="date" value="{{$news->date}}" required>
            </div>
        </div>
        <div class="row my-2">
            <label for="title" class="col-sm-1 col-form-label">Title</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="title" name="title" value="{{$news->title}}" required>
            </div>
        </div>

        <div class="row my-2">
            <label for="description" class="col-sm-1 col-form-label">Description</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="description" name="description" value="{{$news->description}}" required>
            </div>
        </div>

        <div class="row my-2">
          <label for="category" class="col-sm-1 col-form-label">Category</label>
          <div class="col-sm-11">
              <select id="category" name="category_id" class="form-select" aria-label="Default select example" required>
                  <option selected>Select the category</option>
                  @foreach ($categories as $item)
                      <option value="{{ $item->category_id }}" {{$item->category_id == $news->category_id ? 'selected' : ''}}>
                        {{ $item->category_name }}
                      </option>
                  @endforeach
              </select>
          </div>
        </div>

        <div class="row my-2">
            <label for="author" class="col-sm-1 col-form-label">Author</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="author" name="author" value="{{$news->author}}" required>
            </div>
        </div>

        <div class="row my-2">
            <label for="image" class="col-sm-1 col-form-label">Image</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="image" name="image" value="{{$news->image}}" required>
            </div>
        </div>

        <div class="row my-2">
            <label for="active" class="col-sm-1">Active</label>
            <div class="col-sm-11 form-check form-switch">
                <input type="checkbox" class="form-check-input" role="switch" id="active" name="active" {{$news->active ? 'checked' : ''}}>
            </div>
        </div>

    </form>
@endsection
