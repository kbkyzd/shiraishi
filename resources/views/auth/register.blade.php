@extends('layouts.minimal')

@section('content')
    <div class="container white z-depth-2">
        <ul class="tabs tabs-fixed-width pink darken-3">
            <li class="tab col s6"><a class="white-text" target="_self" href="{{ route('login') }}">login</a></li>
            <li class="tab col s6"><a class="white-text active">register</a></li>
        </ul>
        <div id="register" class="col s12 grey darken-4">
            <form class="col s12" action="{{ route('register') }}" method="POST">
                @csrf
                {!! app('captcha')->render() !!}
                <div class="form-container">
                    <h3 class="white-text">Hello.</h3>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="name" type="text" name="name" class="validate white-text {{ $errors->has('name') ? 'invalid' : '' }}">
                            <label for="name">Name</label>
                            @if($errors->has('name'))
                                <p class="error">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" name="email" class="validate white-text {{ $errors->has('email') ? 'invalid' : '' }}">
                            <label for="email">Email</label>
                            @if($errors->has('email'))
                                <p class="error">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" name="password" class="validate white-text {{ $errors->has('password') ? 'invalid' : '' }}">
                            <label for="password">Password</label>
                            @if($errors->has('password'))
                                <p class="error">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password-confirm" type="password" class="validate white-text" name="password_confirmation">
                            <label for="password-confirm">Password Confirmation</label>
                        </div>
                    </div>
                    <div class="center">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
