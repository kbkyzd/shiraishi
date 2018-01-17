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
                <a class="collapsible-header">Main</a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="#">Test 2</a></li>
                    </ul>
                </div>
            </li>
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
