@extends('layouts.site')

@section('title', __('Confirm Password'))

@section('content')
<div class="container">
    <div class="row justify-center">
        <div class="col s11 m4">
            <div class="card">
                <h2 class="title animate">{{ __('Confirm Password') }}</h2>
                <p>{{ __('Please confirm your password before continuing.') }}</p>

                <form class="auth-form" method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col s12">
                            <input id="password" type="password" class="form-field @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <label for="password">{{ __('Password') }}</label>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col s12">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Confirm Password') }}
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
@endsection
