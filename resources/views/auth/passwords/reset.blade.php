@extends('layouts.minimal')

@section('content')
    <div class="container white z-depth-2">
        <div id="login" class="col s12 grey darken-4">
            <form class="col s12" method="POST" action="{{ route('password.request') }}">
                @csrf
                <div class="form-container">
                    <h3 class="white-text">Password Reset</h3>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="email">E-Mail Address</label>
                            <input id="email" type="email" class="white-text {{ $errors->has('email') ? 'invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>
                            @if($errors->has('email'))
                                <p class="error">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="password">New Password</label>
                            <input id="password" type="password" class="white-text {{ $errors->has('password') ? 'invalid' : '' }}" name="password" required>
                            @if($errors->has('password'))
                                <p class="error">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="password-confirm">Confirm New Password</label>
                            <input id="password-confirm" type="password" class="white-text {{ $errors->has('password_confirmation') ? 'invalid' : '' }}" name="password_confirmation" required>
                            @if($errors->has('password_confirmation'))
                                <p class="error">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="center">
                        <button class="btn waves-effect waves-light" type="submit">Reset Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
