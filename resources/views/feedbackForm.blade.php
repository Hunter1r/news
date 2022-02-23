@extends('layouts.main')
@section('content')
<h1>Send feedback</h1>
<form method = "POST" action="{{ route('feedback.store')}}">
  @csrf
    <div class="form-group">
      <label for="name">Your name</label>
      <input type="input" class="form-control" id="name" placeholder="Mr. Smith" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>

    <div class="form-group">
      <label for="message">Feedback</label>
      <textarea class="form-control" id="message" rows="3" name="feedback" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary float-sm-end">Send</button>
  </form>
@endsection