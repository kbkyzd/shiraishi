@extends('layouts.app')

@section('content')
    <echo-listen user="{{ auth()->id() }}"></echo-listen>
@endsection
