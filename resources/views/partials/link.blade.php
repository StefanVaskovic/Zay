@if(!session()->has('user'))
    @if($item['name'] != 'Logout')
        <li class="nav-item">
            <a class="nav-link" id="{{$item['name']}}" href="{{route($item['route'])}}">{{$item['name']}}</a>
        </li>
    @endif
@else
    @if($item['name'] != 'Register' && $item['name'] != 'Login')
        <li class="nav-item">
            <a class="nav-link" id="{{$item['name']}}" href="{{route($item['route'])}}">{{$item['name']}}</a>
        </li>
    @endif
@endif
