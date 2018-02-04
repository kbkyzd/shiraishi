@inject('git', 'tsumugi\Foundation\Version')
<nav role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="#" class="brand-logo">
            dess <small style="font-size: 45%">#{{ $git->hash() }} (r{{ $git->revision() }})</small>
        </a>
        <ul class="right hide-on-med-and-down">
            <ul id="userdropdown" class="dropdown-content">
                <li class="divider"></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); $('#logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            <li>
                <a class="dropdown-button" data-activates="userdropdown" data-constraintWidth="false" data-belowOrigin="true">{{ auth()->user()->username }}
                    <i class="material-icons right">more_vert</i></a></li>
        </ul>
        @include('layouts.sidenav')
    </div>
</nav>
