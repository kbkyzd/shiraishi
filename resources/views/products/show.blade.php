@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h3 class="center light"> {{ $product->name }}</h3>
                <h6 class="center">
                    @foreach ($product->tags as $tag)
                        <span class="tags">{{ $tag->name }}</span>
                    @endforeach
                </h6>
                <br>
                <h6 class="center">Available: <span class="tags">{{ $product->stock }}</span></h6>
            </div>
        </div>
        <div class="row">
            <div class="col s12 push-l4 l4 center">
                <img src="{{ $product->image }}" class="materialboxed responsive-img">
            </div>
            <div class="col s12">
                <div class="card-panel">
                    {{ $product->description }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <h4>Similar Products</h4>
                <div class="divider"></div>
                @foreach ($similar as $product)
                    <div class="col s12 m4">
                        <div class="card horizontal small">
                            <div class="card-image">
                                <a href="{{ route('store.show', ['store' => $product->id]) }}"><img src="{{ $product->image }}"></a>
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <h4>{{ $product->name }}</h4>
                                </div>
                                <div class="card-action">
                                    @foreach ($product->tags as $tag)
                                        <span class="tags">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
