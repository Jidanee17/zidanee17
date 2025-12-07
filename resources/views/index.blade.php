<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - IF7MART</title>

  <link href="{{asset('assets/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    /* Variabel Warna Coklat Pastel Kustom */
    :root {
      --pastel-brown: #B7A19D;
      /* Coklat Pastel Utama */
      --pastel-light: #EBE5E4;
      /* Warna Background Penuh */
      --pastel-dark: #8C7570;
      /* Hover/Fokus */
    }

    body,
    html {
      height: 100%;
      background-color: var(--pastel-light);
    }

    .login-container {
      height: 100vh;
    }

    .card {
      border-radius: 12px;
      background-color: white;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(183, 161, 157, 0.4);
      border: none;
    }

    .card-header-custom {
      background-color: var(--pastel-brown);
      color: white;
      padding: 1.5rem;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
      margin-bottom: 1.5rem;
    }

    .btn-primary {
      background-color: var(--pastel-brown);
      border-color: var(--pastel-brown);
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover,
    .btn-primary:focus {
      background-color: var(--pastel-dark);
      border-color: var(--pastel-dark);
    }

    .input-group-text-custom {
      background-color: var(--pastel-light);
      color: var(--pastel-dark);
      border: 1px solid #ced4da;
      border-right: none;
    }

    .form-control:focus {
      border-color: var(--pastel-brown);
      box-shadow: 0 0 0 0.25rem rgba(183, 161, 157, 0.25);
    }

    /* Tambahan style agar border error override warna pastel */
    .form-control.is-invalid:focus {
      border-color: #dc3545;
      box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
    }

    .logo-placeholder {
      height: 60px;
      width: 60px;
      background-color: white;
      border-radius: 50%;
      margin: 0 auto 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 24px;
      color: var(--pastel-brown);
      border: 3px solid white;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center login-container">
    <div class="card shadow" style="min-width: 300px; max-width: 400px; width: 100%;">

      <div class="card-header-custom text-center">
        <div class="logo-placeholder">
          <i class="fas fa-shopping-basket"></i>
        </div>
        <h4 class="mb-0">Login</h4>
      </div>

      <div class="p-4 pt-0">
        <form action="{{ route('Login.store') }}" method="POST">
          @csrf

          <!-- INPUT USERNAME -->
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group has-validation">
              <span class="input-group-text input-group-text-custom"><i class="fas fa-user"></i></span>

              {{-- Menggunakan komentar Blade agar aman --}}
              <input type="text"
                class="form-control @error('username') is-invalid @enderror"
                id="username"
                name="username"
                placeholder="Masukkan Username"
                value="{{ old('username') }}"
                required />
            </div>
          </div>

          <!-- INPUT PASSWORD -->
          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <div class="input-group has-validation">
              <span class="input-group-text input-group-text-custom"><i class="fas fa-lock"></i></span>

              {{-- Logika validasi class error --}}
              <input type="password"
                class="form-control @error('password') is-invalid @enderror"
                id="password"
                name="password"
                placeholder="Masukkan Password"
                required />

              {{-- Pesan Error Password --}}
              @error('password')
              <div class="invalid-feedback">
                <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="fas fa-sign-in-alt me-2"></i> Login
          </button>
        </form>
      </div>

    </div>
  </div>
  <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
</body>

</html>