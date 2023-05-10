@extends('layouts.full')

@section('lib-style')
@endsection

@section('page-style')
<style>
    .bg-login {
        position: relative;
		widows: 100%;
		height: 100%;
		z-index: 1;
		background: linear-gradient(hsla(155,74%,5%,.4), hsla(155,74%,5%,.4)), url('../img/bg-login.jpg');
		background-attachment: fixed;
		background-position: center center;
		background-repeat: no-repeat;
		background-size: cover;
		overflow: auto;
    }
    .h2, .lead {
		color: #fff;
	}
</style>
@endsection

@section('content')
<div class="row vh-100">
    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">
            <div class="text-center mt-4">
                <h1 class="h2">Comodities Price Predict</h1>
                <p class="lead mb-5">
                    Please, login with username and password!
                </p>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="m-sm-4">
                        <div class="text-center">
                            <img src="/img/logo.png" alt="Logo" class="img-fluid mb-4" width="160" height="160"/>
                        </div>
                        <form action="POST">
                            {{-- @csrf --}}
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Username</label>
                                    <input class="form-control @error('username') is-invalid @enderror" type="text"
                                        name="username" id="username" value="{{ old('username') }}" autofocus>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="login-password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input class="form-control @error('password') is-invalid @enderror"
                                            type="password" id="login-password" name="password" required
                                            autocomplete="current-password" aria-describedby="login-password-button" />
                                        <button class="btn btn-light" type="button" id="login-password-button">
                                            <i data-feather="eye" id="login-password-icon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="d-flex align-item-center justify-content-between">
                                        <label class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="form-check-label">
                                                Remember me
                                            </span>
                                        </label>
                                        @if (Route::has('password.request'))
                                        <small>
                                            <a href="{{ route('password.request') }}"> Forgot password?</a>
                                        </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary"
                                            style="min-width: 150px">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('lib-script')
@endsection

@section('page-script')
<script>
    window.onload = function () {
			var loginPassBtn = document.getElementById('login-password-button');
			var loginPassInput = document.getElementById('login-password');
			var loginPassicon  = document.getElementById('login-password-icon');
			loginPassBtn.addEventListener("click", function() {
				if(loginPassInput.type === "password") {
					lsoginPassInput.type = "text";
					loginPassicon.innerHTML = feather.icons['eye-off'].toSvg();
				} else {
					loginPassInput.type = "password";
					loginPassicon.innerHTML = feather.icons['eye'].toSvg();
				}

			})
		}
</script>
@endsection