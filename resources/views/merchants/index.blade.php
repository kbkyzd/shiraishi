@extends('layouts.app')

@section('content')
    <div class="header-shell">
        <h4><i class="fa fa-user"></i> Shops</h4>
        <span class="tags"><i class="fa fa-users"></i>{{ $users->total() }} Users</span>
        <span class="tags red lighten-4"><i class="fa fa-ban"></i>{{ $disabled->count() }} Disabled</span>
    </div>
    <div class="container with-table">
        <div class="data-table">
            <table class="data-table highlight">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="right-align">Credits</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr class="trigger">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="right-align">{{ $user->availableCredit() }}</td>
                        <td>
                            <view-user user-id="{{ $user->id }}"
                                       edit-route="{{ route('users.edit', ['id' => $user->id]) }}"
                                       name="{{ $user->name }}"
                                       email="{{ $user->email }}"></view-user>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="center">
            {{ $users->links() }}
        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
                <i class="large material-icons">mode_edit</i>
            </a>
            <ul>
                <li><a class="btn-floating red"><i class="fa fa-bar-chart tooltipped" data-tooltip="View User Statistics"></i></a></li>
                <li><a class="btn-floating green"><i class="fa fa-plus tooltipped" data-tooltip="Add User"></i></a></li>
            </ul>
        </div>
    </div>
@endsection
