<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NgamalYuk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/css/style.css">
  <style>
    body,
    html {
      height: 100%;
    }

    .wrapper {
      min-height: 100%;
      display: flex;
      flex-direction: column;
    }

    .content {
      flex: 1;
    }

    .footer {
      position: relative;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>

<body id="home">
  <div class="wrapper">
    <div class="content">
      <div class="container">
        <div class="row justify-content-center mt-5">
          <div class="col-12 col-md-6">
            <div class="card border-0 shadow">
              <div class="card-body">
                <h1 class="card-title text-center">Register</h1>
                <form method="POST" action="/register">
                  @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" required
                      value="{{ old('name') }}">
                    @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email"
                      required value="{{ old('email') }}">
                    @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password"
                      required>
                    @error('password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password Password</label>
                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password"
                      placeholder="Konfirmasi Password" required>
                    @error('confirm_password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-primary d-block w-100">Daftar</button>
                  <p class="mt-3 text-center">Sudah punya akun? <a href="/login" class="text-secondary">Login
                      disini</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- footer --}}
    <footer class="text-center py-3 mt-5 bg-secondary footer">
      <p class="text-white m-0 p-0">NgamalYuk &copy; 2025</p>
    </footer>
    {{-- end footer --}}
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
