@extends('layouts.app')

@section('content')
    <div class="header-shell">
        <h4><i class="fa fa-user"></i> User Management</h4>
        <span class="tags"><i class="fa fa-users"></i>{{ $users->total() }} Users</span>
        <span class="tags"><i class="fa fa-shopping-cart"></i>{{ shiraishi\User::role('merchant')->count() }} Merchants</span>
        <span class="tags"><i class="fa fa-user-o"></i>{{ shiraishi\User::role('user')->count() }} Uesrs</span>
    </div>
    <div class="container with-table">
        <div class="data-table">
            <table class="data-table highlight">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr class="trigger">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @switch($role = $user->getRoleNames()[0])
                                @case('root')
                                <span class="tags pink white-text">{{ ucfirst($role) }}</span>
                                @break
                                @case('merchant')
                                <span class="tags lime text-darken-3">{{ ucfirst($role) }}</span>
                                @break
                                @default
                                <span class="tags blue white-text">{{ ucfirst($role) }}</span>
                            @endswitch
                        </td>
                        <td class="center">
                            <a href="{{ route('users.edit', ['users' => $user->id]) }}"><i class="fa fa-pencil tooltipped" data-tooltip="View"></i></a>
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
                <li>
                    <a class="btn-floating red"><i class="fa fa-bar-chart tooltipped" data-tooltip="View User Statistics"></i></a>
                </li>
                <li><a class="btn-floating green"><i class="fa fa-plus tooltipped" data-tooltip="Add User"></i></a></li>
            </ul>
        </div>
    </div>
@endsection
