@extends('layouts.app')

@section('page-title', 'Create comic')

@section('main-content')
    <div class="container-md">
        <h1 class="text-center p-3">Create new comic</h1>
        <form action="{{ route('comics.store') }}" method="POST" class="row g-3">
            @csrf

            <div class="col-12">
              <label for="input-title" class="form-label">Titolo</label>
              <input type="text" class="form-control" id="input-title" name="title">
            </div>
            <div class="col-12">
              <label for="input-thumb" class="form-label">Thumb URL</label>
              <input type="url" class="form-control" id="input-thumb" name="thumb">
            </div>
            <div class="col-md-6">
              <label for="input-series" class="form-label">Serie</label>
              <input type="text" class="form-control" id="input-series" name="series">
            </div>
            <div class="col-md-6">
              <label for="input-type" class="form-label">Tipo</label>
              <input type="text" class="form-control" id="input-type" name="type">
            </div>
            <div class="col-12">
              <label for="input-description" class="form-label">Descrizione</label>
              <textarea type="text" class="form-control" id="input-description" name="description"></textarea>
            </div>
            <div class="col-12">
              <label for="input-writers" class="form-label">Scrittori</label>
              <input type="text" class="form-control" id="input-writers" placeholder="I primi due scrittori compariranno all'indice" name="writers">
            </div>
            <div class="col-12">
              <label for="input-artists" class="form-label">Artisti</label>
              <input type="text" class="form-control" id="input-artists" placeholder="" name="artists">
            </div>
            <div class="col-md-3">
              <label for="input-sale-date" class="form-label">Data di uscita</label>
              <input type="date" class="form-control" id="input-sale-date" name="sale_date">
            </div>
            <div class="col-md-3">
              <label for="input-price" class="form-label">Prezzo</label>
              <input type="number" class="form-select" id="input-price" name="price" min="0" step="0.01">
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                  Check me out
                </label>
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Crea</button>
              <button type="reset" class="btn btn-warning">Cancella campi</button>
            </div>
          </form>
    </div>
@endsection
