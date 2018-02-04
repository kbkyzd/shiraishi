@extends('layouts.app')

@section('content')
    <div class="header-shell">
        <h4><i class="fa fa-compass"></i> Welcome back, {{ auth()->user()->name }}.</h4>
    </div>
@endsection
