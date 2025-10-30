@extends('master')
@section('content')
  <section class="terbaru py-4 my-5" id="terbaru">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="{{ asset('storage/' . $donation->image) }}" class="w-100" alt="{{ $donation->title }}">
      </div>
      <div class="col-md-8 px-3">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h5 class="card-title">{{ $donation->title }}</h5>
            <span
              class="badge bg-secondary d-flex align-self-start text-white inter-regular me-2">{{ $donation->category->name }}</span>
          </div>
          <p class="card-text">{{ $donation->description }}</p>
          <form action="/ngamal/{{ $donation->id }}" method="post">
            @csrf
            <div class="mb-3">
              <label for="nominal" class="form-label">Nominal</label>
              <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" placeholder="minimal Rp10.000" required value="@old('nominal')">
              @error('nominal')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary d-block">Ngamal Sekarang</a>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
