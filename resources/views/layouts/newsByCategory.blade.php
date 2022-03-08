@extends('layouts.main')

@section('title') @parent -
@if (!@empty($news))
{{ @strtoupper($news[0]['category_name']) }}
@endif
@endsection

@section('categories')
    @foreach($categories['data'] as $item)
    <a class="p-2 link-secondary" href="/news/{{$item['category_id']}}">{{ $item['category_name'] }}</a>
    @endforeach
@endsection

@section('content')

@forelse ($news as $item)
    <div class="row">
        <div class="col">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary">{{$item['category_name']}}</strong>
              <h3 class="mb-0">{{$item['title']}}</h3>
              <div class="mb-1 text-muted">{{$item['date']}}</div>
              <p class="card-text mb-auto">{{$item['description']}}</p>
              <a href="{{route('news.item', ['category'=>$item['category_id'], 'news'=>$item['news_id']])}}" class="stretched-link">Continue reading</a>
            </div>
            <div class="col-auto d-none d-lg-block">
              <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            </div>
          </div>
        </div>
      </div>
      @empty
      <h1>No News yet</h1>
      @endforelse
@endsection