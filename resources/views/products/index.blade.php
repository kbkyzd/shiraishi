@extends('layouts.app')

@section('content')
    <div class="header-shell">
        <div class="row">
            <div class="col s6">
                <h3>Products</h3>
                <span class="tags">{{ $products->total() }} Items</span>
                @if (request()->tags)
                    @foreach (explode(',', request()->tags) as $tag)
                        <span class="tags">{{ ucfirst($tag) }}</span>
                    @endforeach
                    <a href="{{ route('store.index') }}"><i class="fa fa-times grey-text"></i></a>
                @endif
            </div>
            <form>
                <div class="input-field col s4">
                    <input id="first_name" type="text" class="validate" name="s" value="{{ request()->s ?? '' }}">
                    <input type="hidden" name="tags" value="{{ request()->tags }}">
                    <label for="first_name">Query</label>
                </div>
                <div class="col s2">
                    <button type="submit" class="btn-flat waves-light waves-effect">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col s12 m6 xl4">
                    <div class="card large hoverable">
                        <div class="card-image">
                            <div class="darken-tint">
                                <img class="responsive-img" src="{{ $product->image }}">
                            </div>
                        </div>
                        <a class="btn-floating btn-large halfway-fab waves-effect waves-light" href="{{ route('store.show', ['store' => $product->id]) }}"><i class="material-icons">visibility</i></a>
                        <div class="card-content">
                            <span class="card-title">{{ $product->name }}</span>
                            @foreach ($product->tags as $tag)
                                <span class="tags">
                                    <a class="black-text" href="{{ route('store.index', ['tags' => $tag->slug] ) }}">{{ $tag->name }}</a> | <a href="{{ route('store.index', ['tags' => $tag->slug . ',' . request()->tags]) }}"><i class="fa fa-plus grey-text" style="margin-right: 0"></i></a>
                                </span>
                            @endforeach
                            &nbsp;
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="center">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
