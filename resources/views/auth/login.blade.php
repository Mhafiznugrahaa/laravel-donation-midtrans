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
                <h1 class="card-title text-center">Login</h1>
                @if (session('error'))
                  <div class="alert alert-danger" role="alert">
                    Periksa Username atau Password anda!
                  </div>
                @endif
                <form method="POST" action="/login">
                  @csrf
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                      required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                      required>
                  </div>
                  <button type="submit" class="btn btn-primary d-block w-100">Login</button>
                  <p class="mt-3 text-center">Belum punya akun? <a href="/register" class="text-secondary">Daftar disini</a></p>
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
