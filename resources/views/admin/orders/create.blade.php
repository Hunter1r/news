@extends('layouts.adminMain');

@section('content')
    <form method="POST"
        @if($order->id)
        action="{{ route('admin.orders.update',['order'=>$order]) }}"
        @else
          action="{{ route('admin.orders.store') }}"
        @endif
    >
    @csrf    
    @if($order->id)
        @method('PUT')
    @endif

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{$order->id ? 'Update':'Create'}} orders</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="submit" class="btn btn-success float-sm-end">{{$order->id ? 'Update': 'Create'}}</button>
            </div>
        </div>
        
        <div class="row my-2">
            <label for="name" class="col-sm-1 col-form-label">Name</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="name" name="name" value="{{$order->name}}" required>
            </div>
        </div>

        <div class="row my-2">
            <label for="email" class="col-sm-1 col-form-label">E-mail</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="email" name="email" value="{{$order->email}}" required>
            </div>
        </div>

        <div class="row my-2">
            <label for="phone" class="col-sm-1 col-form-label">Phone</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="phone" name="phone" value="{{$order->phone}}" required>
            </div>
        </div>

        <div class="row my-2">
            <label for="description" class="col-sm-1 col-form-label">Description</label>
            <div class="col-sm-11">
                <input type="input" class="form-control" id="description" name="description" value="{{$order->description}}" required>
            </div>
        </div>

    </form>
@endsection
