@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h3 class="center light">Order ID: {{ $order->id }}</h3>
                <br>
                <h6 class="center">{!! $order->processed_at ? '<span class="tags green">Processed</span>' : '<span class="tags orange">Pending</span>' !!}</h6>
            </div>
        </div>
        <div class="row">
            <div class="data-table">
                <table class="data-table highlight">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Transaction</th>
                        <th class="center">Processed</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            @foreach ($order->transactions as $transaction)
                                {{ $transaction->product->name }}
                                <span class="grey-text text-darken-1">(x{{ $transaction->quantity }})</span>
                                <span class="right">{{ toDollars($transaction->product->price * $transaction->quantity) }} SGD</span>
                                @if(! $loop->last)
                                    <br>
                                @endif
                            @endforeach
                        </td>
                        <td class="center" title="{{ $order->processed_at }}">{{ $order->processed_at ? $order->processed_at->diffForHumans() : 'N/A'  }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <h4>Products</h4>
                <div class="divider"></div>
                @foreach ($order->transactions as $transaction)
                    <div class="col s12 m4">
                        <div class="card horizontal small">
                            <div class="card-image">
                                <a href="{{ route('store.show', ['store' => $transaction->product->id]) }}"><img src="{{ $transaction->product->image }}"></a>
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <h4>{{ $transaction->product->name }}</h4>
                                </div>
                                <div class="card-action">
                                    @foreach ($transaction->product->tags as $tag)
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
