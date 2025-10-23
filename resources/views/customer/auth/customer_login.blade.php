@extends('layouts.master')

@section('content')
<div id="colorlib-contact">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="contact-wrap p-4 p-md-5 shadow-sm rounded bg-white">
                    <h3 class="mb-4 text-center" style="font-weight:600;">Customer Login</h3>
                    <p class="text-center text-muted mb-4">
                        Welcome back! Please login to continue shopping.
                    </p>

                    <form method="POST" action="{{ route('customer.login.submit') }}">
                        @csrf

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="Enter your email">
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password"
                                   placeholder="Enter your password">
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group mb-3 d-flex align-items-center justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary px-5 py-2"
                                    style="border-radius: 50px; font-weight: 600;">
                                Login
                            </button>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center mt-3">
                            <p class="mb-0">New here?
                                <a href="{{ route('customer.register') }}" class="text-primary fw-semibold">
                                    Register Now
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #colorlib-contact {
        background-color: #f8f9fa;
        min-height: 80vh;
        display: flex;
        align-items: center;
    }

    .contact-wrap {
        border-top: 4px solid #88c8bc;
        transition: all 0.3s ease-in-out;
    }

    .contact-wrap:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background: #88c8bc;
        border-color: #88c8bc;
    }

    .btn-primary:hover {
        background: #6fb0a5;
        border-color: #6fb0a5;
    }
</style>
@endsection
