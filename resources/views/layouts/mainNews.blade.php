@extends('layouts.main')

  @section('categories')
    @foreach($categories as $item)
      <a class="p-2 link-secondary" href="/news/{{$item->id}}">{{ $item->name }}</a>
    @endforeach
  @endsection

@section('content')
    
<div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
  <div class="col-md-6 px-0">
    <h1 class="display-4 fst-italic">{{$topNews0->title}}</h1>
    <p class="lead my-3">{{$topNews0->description}}</p>
    <p class="lead mb-0"><a href="{{ route('news.item', ['category_id'=>$topNews0->category_id,'id'=>$topNews0->id]) }}" class="text-white fw-bold">Read full article </a></p>
  </div>
</div>

<div class="row">
  <div class="col">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">{{$topNews1->category}}</strong>
        <h3 class="mb-0">{{$topNews1->title}}</h3>
        <div class="mb-1 text-muted">{{$topNews1->date}}</div>
        <p class="card-text mb-auto">{{$topNews1->description}}</p>
        <a href="{{ route('news.item', ['category_id'=>$topNews1->category_id, 'id'=>$topNews1->id]) }}" class="stretched-link">Continue reading</a>
      </div>
      <div class="col-auto d-none d-lg-block">
        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
      </div>
    </div>
  </div>
  
</div>
<div class="row">
<div class="col">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">{{$topNews2->category}}</strong>
        <h3 class="mb-0">{{$topNews2->title}}</h3>
        <div class="mb-1 text-muted">{{$topNews2->date}}</div>
        <p class="card-text mb-auto">{{$topNews2->description}}</p>
        <a href="{{ route('news.item', ['category_id'=>$topNews2->category_id, 'id'=>$topNews2->id]) }}" class="stretched-link">Continue reading</a>
      </div>
      <div class="col-auto d-none d-lg-block">
        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
      </div>
    </div>
  </div>
</div>
@endsection