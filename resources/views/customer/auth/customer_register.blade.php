@extends('layouts.master')

@section('content')
<div id="colorlib-contact">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="contact-wrap p-4 p-md-5 shadow-sm rounded bg-white">
                    <h3 class="mb-4 text-center" style="font-weight:600;">Customer Registration</h3>
                    <p class="text-center text-muted mb-4">
                        Create your account to start shopping with us.
                    </p>

                    <form method="POST" action="{{ route('customer.register.submit') }}">
                        @csrf

                        <!-- Name -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autofocus
                                   placeholder="Enter your name">
                            @error('name')
                                <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required
                                   placeholder="Enter your email">
                            @error('email')
                                <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label fw-semibold">Phone</label>
                            <input id="phone" type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{ old('phone') }}" required
                                   placeholder="Enter your phone number">
                            @error('phone')
                                <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group mb-3">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <input id="address" type="text"
                                   class="form-control @error('address') is-invalid @enderror"
                                   name="address" value="{{ old('address') }}" required
                                   placeholder="Enter your address">
                            @error('address')
                                <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>

                        <!-- District -->
                        <div class="form-group mb-3">
                            <label for="district" class="form-label fw-semibold">District</label>
                            <select name="district" class="form-select form-control" id="district" required>
                                <option selected disabled>Select your district</option>
                                @foreach($districts as $district)
                                    <option class="dist dist{{ $district->division_id }}"
                                            value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('district'))
                                <span class="text-danger"> {{ $errors->first('district') }}</span>
                            @endif
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required placeholder="Enter your password">
                            @error('password')
                                <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group mb-4">
                            <label for="password-confirm" class="form-label fw-semibold">Confirm Password</label>
                            <input id="password-confirm" type="password"
                                   class="form-control" name="password_confirmation" required
                                   placeholder="Confirm your password">
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary px-5 py-2"
                                    style="border-radius: 50px; font-weight: 600;">
                                Register
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center mt-3">
                            <p class="mb-0">
                                Already have an account?
                                <a href="{{ route('customer.login') }}" class="text-primary fw-semibold">
                                    Login Here
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
        min-height: 85vh;
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

    label {
        color: #444;
    }
</style>
@endsection

@push('scripts')
<script>
    function fetchDistricts(divisionId) {
        document.querySelectorAll('.dist').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.dist' + divisionId).forEach(el => el.style.display = 'block');
    }
</script>
@endpush
