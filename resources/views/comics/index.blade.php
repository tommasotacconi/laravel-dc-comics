@extends('layouts.app')

@section('page-title', 'Comics table')

@section('main-content')

<div id="index" class="container-md mb-4">
  <h1 class="text-center p-3">
	  Comics libraries
  </h1>
  <div class="row gy-3">
	@foreach ($comics as $id => $comic)
	  <div class="col">
		<div class="card m-auto" style="width: 18rem; height: 30rem">
		  <img src="{{ $comic['thumb'] }}" class="card-img-top" alt="...">
		  <div class="card-body">
			<a href="{{ route('comics.show', $id) }}">
				<h1>{{ $comic['title'] }}</h1>
			</a>
			<div class="card-text">
			  Series: {{ $comic['series'] }}<br>
			  Scrittori:
			  <ul class="">
				@for ($i = 0; $i < 2; $i++)
				{{-- Define value to check before insertion --}}
				@if (isset($comic['writers'][$i]))
				<li>{{ $comic['writers'][$i] }}</li>
				@endif
				@endfor ($comic['writers'] as $artist)
			  </ul>
			  <div class="buttons-wrapper">
				<a href="{{ route('comics.edit', $id) }}" class="btn edit-btn btn-primary">Edit</a>
			  </div>
			  <div class="price-wrapper">
				{{ $comic['price'] }}<br>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	@endforeach
  </div>
</div>
@endsection

