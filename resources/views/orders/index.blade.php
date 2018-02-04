@extends('layouts.app')

@section('content')
    <div class="header-shell">
        <h4><i class="fa fa-user"></i> Orders</h4>
        <span class="tags"><i class="fa fa-shopping-cart"></i>{{ $orders->count() }} Orders Processed</span>
    </div>
    <div class="container with-table">
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
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            @foreach ($order->transactions as $transaction)
                                {{ $transaction->product->name }} <span class="grey-text text-darken-1">(x{{ $transaction->quantity }})</span><span class="right">{{ toDollars($transaction->product->price * $transaction->quantity) }} SGD</span>
                                @if(! $loop->last)
                                    <br>
                                @endif
                            @endforeach
                        </td>
                        <td class="center" title="{{ $order->processed_at }}">{{ $order->processed_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
