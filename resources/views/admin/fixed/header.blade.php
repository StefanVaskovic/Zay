<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}"> Click to see preview </a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('profile.edit')}}">
                        <span class="no-icon "><i class="fa fa-user"></i> <label class="font-weight-bold">{{session('user')->name}}</label></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logoutAdmin')}}">
                        <span class="no-icon">Log out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
