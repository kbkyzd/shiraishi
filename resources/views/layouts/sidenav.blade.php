<a href="#" data-activates="fixed-nav" class="button-collapse"><i class="material-icons">menu</i></a>
<ul id="fixed-nav" class="side-nav fixed">
    <li>
        <div class="user-view">
            <div class="background grey darken-4 z-depth-1"></div>
            <a href="#!user"><img class="circle" src="https://picsum.photos/200"></a>
            <a href="#!name"><span class="name">{{ auth()->user()->name }}</span></a>
            <a href="#!email"><span class="email">{{ auth()->user()->email }}</span></a>
        </div>
    </li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header active">Main</a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="#"><i class="material-icons">person</i>Profile</a></li>
                        <li><a href="#"><i class="material-icons">chat</i>Chat</a></li>
                        <li><a href="{{ route('store.index') }}"><i class="material-icons">shopping_cart</i>Products</a></li>
                        <li><a href="">Orders</a></li>
                    </ul>
                </div>
            </li>
            @role('root|merchant')
            <li>
                <a class="collapsible-header active">Admin</a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="">Orders</a></li>
                        <li><a href="{{ route('users.index') }}">Users</a></li>
                    </ul>
                </div>
            </li>
            @endrole
        </ul>
    </li>
    @role('admin')
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header">Administration</a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="#"><i class="material-icons">view_list</i>Test</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    @endrole
</ul>
