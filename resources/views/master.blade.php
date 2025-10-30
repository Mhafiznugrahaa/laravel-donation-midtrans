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
        {{-- navbar --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
          <div class="container">
            <a class="navbar-brand text-white bg-primary px-3" href="/">NgamalYuk</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('ngamal*') ? 'active' : '' }}" href="/ngamal">Ngamal</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/#terbaru">Terbaru</a>
                </li>
              </ul>
              <div class="d-flex">
                @guest
                  <a href="/login" class="btn btn-primary">Login</a>
                  <a href="/register" class="btn btn-outline-primary ms-2">Register</a>
                @else
                  <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="{{ asset('storage/profile-pictures/default.png') }}" alt="Profile Picture"
                        class="rounded-circle" height="40">
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="/akun">Pengaturan Akun</a></li>
                      <li><a class="dropdown-item" href="/riwayat">Riwayat Ngamal</a></li>
                      <li>
                        <form action="/logout" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                @endguest
              </div>
            </div>
          </div>
        </nav>
        {{-- end navbar --}}
        @yield('content')
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
