@extends('layouts.minimal')

@section('content')
    <div class="container white z-depth-2">
        <ul class="tabs tabs-fixed-width pink darken-3">
            <li class="tab col s6"><a class="white-text active">login</a></li>
            <li class="tab col s6"><a class="white-text" target="_self" href="{{ route('register') }}">register</a></li>
        </ul>
        <div id="login" class="col s12 grey darken-4">
            <form class="col s12" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-container">
                    <h3 class="white-text">Welcome back.</h3>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="white-text {{ $errors->has('email') ? 'invalid' : '' }}" type="text" name="email" id="email" required autofocus/>
                            <label class="grey-text text-lighten-1" for="email">Email</label>
                            @if($errors->has('email'))
                                <p class="error">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input class="white-text {{ $errors->has('password') ? 'invalid' : '' }}" type="password" name="password" id="password" required/>
                            <label class="grey-text text-lighten-1" for="password">Password</label>
                            @if($errors->has('password'))
                                <p class="error">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="center">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="grey-text text-lighten-1" for="remember">Remember me</label>
                        <br>
                        <br>
                        <button class="btn waves-effect waves-light" type="submit">Login</button>
                        <br>
                        <br>
                        <a href="{{ route('password.request') }}">Forgot your password?</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
