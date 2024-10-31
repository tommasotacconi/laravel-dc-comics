@extends('layouts.app')

@section('page-title', 'Comics table')

@section('main-content')

<div id="index" class="container-lg mb-4">
  <h1 class="text-center p-3">
      Comics libraries
  </h1>
  <div class="row gy-3">
    @foreach ($comics as $id => $comic)
      <div class="col">
        <a href="{{ route('comics.show', $id) }}">
          <div class="card" style="width: 18rem; height: 30rem">
            <img src="{{ $comic['thumb'] }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h1>{{ $comic['title'] }}</h1>
                <div class="card-text">
                  Series: {{ $comic['series'] }}<br>
                  Scrittori:
                  <ul class="">
                    @for ($i = 0; $i < 2; $i++)
                    {{-- Define value to check before insertion --}}
                    @if (isset($comic['artists'][$i]))
                    <li>{{ $comic['artists'][$i] }}</li>
                    @endif
                    @endfor ($comic['writers'] as $artist)
                  </ul>
                  <div class="price-wrapper">
                    {{ $comic['price'] }}<br>
                  </div>
                </div>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>
</div>
@endsection

