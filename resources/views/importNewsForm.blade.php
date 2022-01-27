@extends('layouts.main')
@section('content')
<form method = "POST" action="{{ route('import.store')}}">
  @csrf
    <div class="form-group">
      <label for="name">Your name</label>
      <input type="input" class="form-control" id="name" placeholder="Mr. Smith" name="name" required>
    </div>
    <div class="form-group">
        <label for="phone">Your phone</label>
        <input type="input" class="form-control" id="phone" placeholder="+79845632474" name="phone" required>
      </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>

    <div class="form-group">
      <label for="message">I want...</label>
      <textarea class="form-control" id="message" rows="3" name="message" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary float-sm-end">Submit</button>
  </form>
@endsection