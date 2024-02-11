@extends('template.login')
@section('container')
    <style>
        #login .container #login-row #login-column #login-box {
            margin-top: 120px;
            max-width: 600px;
            height: 330px;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
        }

        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }

        #login .container #login-row #login-column #login-box #login-form #register-link {
            margin-top: -85px;
        }
    </style>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <h3 class="text-center ">{{env("APP_NAME")}}</h3>
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12  object">
                        <form id="login-form" class="form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <h3 class="text-center text-info">Login</h3>

                            <div class="form-group">
                                <label for="email" class="text-info">Username:</label><br>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label>
                                {{-- <button class="btn-sm btn-secondary" onclick="showPass();">show</button> --}}
                                <br>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-check-label" for="remember">
                                    <span>
                                        {{ __('Remember Me') }}
                                    </span>      <span>
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                    </span>
                                </label><br>

                                <button type="submit" class="btn btn-info btn-md">
                                    {{ __('Login') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                            {{-- <div id="register-link" class="text-right">
                                <a href="{{ route('register') }}" class="text-info">Register here</a>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header">{{ __('Login') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div> --}}
@endsection
