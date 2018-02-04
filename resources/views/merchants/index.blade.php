@extends('layouts.app')

@section('content')
    <div class="header-shell">
        <div class="row">
            <div class="col s6">
                <h3>Merchants</h3>
                <span class="tags">{{ $merchants->total() }} Items</span>
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
            @foreach ($merchants as $merchant)
                <div class="col s12 m6 xl4">
                    <div class="card large hoverable">
                        <div class="card-image">
                            <div class="darken-tint">
                                <img class="responsive-img" src="{{ $merchant->image ?? 'https://picsum.photos/400?random' }}">
                            </div>
                        </div>
                        <a class="btn-floating btn-large halfway-fab waves-effect waves-light" href="{{ route('store.show', ['store' => $merchant->id]) }}"><i class="material-icons">visibility</i></a>
                        <div class="card-content">
                            <span class="card-title">{{ $merchant->name }}</span>

                            &nbsp;
                            <p>{{ $merchant->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="center">
            {{ $merchants->links() }}
        </div>
    </div>
@endsection
