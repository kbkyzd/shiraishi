@extends('layouts.minimal')

@section('content')
    <div class="container white z-depth-2">
        <div id="login" class="col s12 grey darken-4">
            <form class="col s12" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-container">
                    <h3 class="white-text">Password Reset</h3>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="email">E-Mail Address</label>
                            <input id="email" type="email" class="white-text {{ $errors->has('email') ? 'invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <p class="error">{{ $errors->first('email') }}</p>
                            @endif
                            @if (session('status'))
                                <p class="green-text">{{ session('status') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="center">
                        <button class="btn waves-effect waves-light" type="submit">Send Password Reset Link</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
