@extends('master')
@section('content')
  <section class="py-4 my-5">

    <h1 class="h3">Riwayat Donasi Saya</h1>
    @foreach ($mydonations as $donation)
      @if ($loop->iteration == 1)
        <div class="accordion mb-3" id="accordion{{ $loop->iteration }}">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="true"
                aria-controls="collapse{{ $loop->iteration }}">
                {{ $donation->donation->title }} ({{ $donation->created_at->diffForHumans() }})
              </button>
            </h2>
            <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse show"
              data-bs-parent="#accordion{{ $loop->iteration }}">
              <div class="accordion-body">
                <dl class="row">
                  <dt class="col-sm-3">Kategori Donasi</dt>
                  <dd class="col-sm-9">: {{ $donation->donation->category->name }}</dd>
                  <dt class="col-sm-3">Ngamal Untuk</dt>
                  <dd class="col-sm-9">: {{ $donation->donation->title }}</dd>
                  <dt class="col-sm-3">Nominal</dt>
                  <dd class="col-sm-9">: Rp{{ number_format($donation->nominal, 0, ',', '.') }}</dd>
                  <dt class="col-sm-3">Status Ngamal</dt>
                  <dd class="col-sm-9">: {{ $donation->status }}</dd>
                </dl>
                @if ($donation->status != 'settlement' && $donation->status != 'capture')
                  <a href="{{ $donation->checkout_link }}" class="btn btn-primary d-block">Bayar Sekarang</a>
                @endif
              </div>
            </div>
          </div>
        </div>
      @else
        <div class="accordion mb-3" id="accordion{{ $loop->iteration }}">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                aria-controls="collapse{{ $loop->iteration }}">
                {{ $donation->donation->title }} ({{ $donation->created_at->diffForHumans() }})
              </button>
            </h2>
            <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse"
              data-bs-parent="#accordion{{ $loop->iteration }}">
              <div class="accordion-body">
                <dl class="row">
                  <dt class="col-sm-3">Kategori Donasi</dt>
                  <dd class="col-sm-9">: {{ $donation->donation->category->name }}</dd>
                  <dt class="col-sm-3">Ngamal Untuk</dt>
                  <dd class="col-sm-9">: {{ $donation->donation->title }}</dd>
                  <dt class="col-sm-3">Nominal</dt>
                  <dd class="col-sm-9">: Rp{{ number_format($donation->nominal, 0, ',', '.') }}</dd>
                  <dt class="col-sm-3">Status Ngamal</dt>
                  <dd class="col-sm-9">: {{ $donation->status }}</dd>
                </dl>
                @if ($donation->status != 'settlement' && $donation->status != 'capture')
                  <a href="{{ $donation->checkout_link }}" class="btn btn-primary d-block">Bayar Sekarang</a>
                @endif
              </div>
            </div>
          </div>
        </div>
      @endif
    @endforeach

  </section>
@endsection
