<div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{route('admin')}}" class="simple-text">
                Menu
            </a>
        </div>
        <ul class="nav">
            @foreach($menu as $m)
                <li class="nav-item @if(request()->routeIs($m->route)) active @endif">
                    <a class="nav-link" href="{{route($m->route)}}">
                        <p>{{$m->name}}</p>
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
</div>
