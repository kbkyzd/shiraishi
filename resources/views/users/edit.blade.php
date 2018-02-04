@extends('layouts.app')
@section('title', "Editing {$user->email}")

@section('content')
    <div class="header-shell">
        <h4><i class="fa fa-pencil" title="Editing"></i> {{ $user->email }}
            <small>{{ me()->id === $user->id ? '(This is you!)' : '' }}</small>
        </h4>
        @foreach($user->getRoleNames() as $role)
            <span class="tags"><i class="fa fa-user-o"></i>{{ ucfirst($role) }}</span>
        @endforeach
    </div>
    <div class="container">
        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="section">
                <div class="row">
                    <div class="col s12 m2">
                        <h5 class="form-header">Profile</h5>
                    </div>
                    <div class="col s12 m10">
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input id="name" type="text" class="validate {{ $errors->has('name') ? 'invalid' : '' }}" name="name" value="{{ $user->name }}" required>
                                <label for="name">Name</label>
                                @if($errors->has('name'))
                                    <p class="red-text">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="email" type="text" class="validate {{ $errors->has('email') ? 'invalid' : '' }}" name="email" value="{{ $user->email }}" required>
                                <label for="email">Email</label>
                                @if($errors->has('email'))
                                    <p class="red-text">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="contact" type="text" class="validate {{ $errors->has('contact') ? 'invalid' : '' }}" name="contact" value="{{ $user->contact }}" required>
                                <label for="contact">Contact</label>
                                @if($errors->has('contact'))
                                    <p class="red-text">{{ $errors->first('contact') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
            </div>

            <div class="section">
                <div class="row">
                    <div class="col s12 m2">
                        <h5 class="form-header">ACL</h5>
                    </div>
                    <div class="col s12 m10">
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <select name="roles[]" multiple class="{{ $errors->has('roles') ? 'invalid' : '' }}">
                                    <option disabled>Select a Role</option>
                                    @foreach ($availableRoles as $role)
                                        <option value="{{ $role }}" {{ $user->hasRole($role) ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                                    @endforeach
                                </select>
                                <label>Roles</label>
                                @if($errors->has('roles'))
                                    <p class="red-text">{{ $errors->first('roles') }}</p>
                                @endif
                            </div>
                        </div>
                        <button class="btn waves-effect waves-light">Update</button>
                    </div>
                </div>
                <div class="divider"></div>
            </div>

            <div class="section">
                <div class="row">
                    <div class="col s12 m2">
                        <h5 class="form-header">Orders</h5>
                    </div>
                    <div class="col s12 m10">
                        <table class="data-table highlight">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Transaction</th>
                                <th class="center">Processed</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($user->processedOrders as $order)
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
            </div>
        </form>
    </div>
@endsection
