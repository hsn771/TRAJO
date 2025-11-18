<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reset Password</title>

  <link rel="shortcut icon" type="image/png" href="{{asset('admin_assets/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('admin_assets/css/styles.min.css')}}" />
</head>

<body>
  <!--  Body Wrapper  -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" 
       data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

    <div class="position-relative overflow-hidden text-bg-light min-vh-100 
                d-flex align-items-center justify-content-center">

      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">

            <div class="card mb-0">
              <div class="card-body">

                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{ asset('admin_assets/images/logos/logo.svg') }}" alt="">
                </a>

                <p class="text-center">Create a New Password</p>

                <form method="POST" action="{{ route('password.update') }}">
                  @csrf

                  <input type="hidden" name="token" value="{{ $token }}">

                  <!-- Email -->
                  <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" 
                           value="{{ $email ?? old('email') }}" 
                           required autocomplete="email" autofocus>

                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <!-- New Password -->
                  <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           name="password" required autocomplete="new-password">

                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <!-- Confirm Password -->
                  <div class="mb-4">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" 
                           class="form-control" 
                           name="password_confirmation" required autocomplete="new-password">
                  </div>

                  <!-- Submit Button -->
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                    {{ __('Reset Password') }}
                  </button>

                  <div class="d-flex align-items-center justify-content-center">
                    <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">
                      Back to Login
                    </a>
                  </div>

                </form>

              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>


  <script src="{{asset('admin_assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('admin_assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

</body>
</html>
