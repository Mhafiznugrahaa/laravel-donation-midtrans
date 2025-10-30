@extends('master')
@section('content')
  <form action="/ngamal" method="get">
    <div class="input-group mt-5">
      <select class="form-select" name="category">
        <option value="">Semua Kategori</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id == request()->category ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-primary">Terapkan</button>
    </div>
  </form>

  <section class="py-4 my-5">
    <div class="row justify-content-center g-3">
      @foreach ($donations as $donation)
        <div class="col-12 col-md-6">
          <div class="card shadow border-0">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{ asset('storage/' . $donation->image) }}" class="img-fluid rounded-start"
                  alt="{{ $donation->title }}">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <h5 class="card-title">{{ $donation->title }}</h5>
                    <span
                      class="badge bg-secondary d-flex align-self-start text-white inter-regular me-2">{{ $donation->category->name }}</span>
                  </div>
                  <p class="card-text">{{ \Illuminate\Support\Str::words($donation->description, 10, '...') }}</p>
                  <a href="/ngamal/{{ $donation->id }}" class="btn btn-primary">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>
@endsection
