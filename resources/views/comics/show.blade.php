@extends('layouts.app')

@section('page-title', $comic['title'])

@section('main-content')
  <div id="show" class="container-md">
	<h1 class="text-center mt-3 ">{{ $comic['title']}} </h1>
	<h2 class="text-center">{{ $comic['type'] }}</h2>
	<div class="jumbotrone">
		<img class="img-fluid" src="{{ $comic['thumb'] }}" alt="{{ $comic['thumb'] }}">
	</div>
	<section class="info-section">
		{{-- Initial description --}}
		<p class="">{{ $comic['description'] }}</p>
		{{-- Writers par. --}}
		<h3>Scrittori</h3>
		<ul class="authors">
			@foreach ($comic['writers'] as $writer)
			<li>{{ $writer }}</li>
			@endforeach
		</ul>
		{{-- Artists par. --}}
		<h3>Artisti</h3>
		<ul class="authors">
			@foreach ($comic['artists'] as $artist)
				<li>{{ $artist }}</li>
			@endforeach
		</ul>
		<div class="wrapper-sdate-price row gx-4 justify-content-center">
			{{-- Data di uscita --}}
			<div class="col-auto sales-date wrapper-item">
				<h4>Data d'uscita</h4>
				{{ $comic['sale_date'] }}
			</div>
			{{-- Prezzo --}}
			<div class="col-auto price wrapper-item">
				<h4>Prezzo</h4>
				{{ $comic['price'] }}
			</div>

		</div>
	</section>
  </div>
@endsection
