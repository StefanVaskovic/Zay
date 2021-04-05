@extends('layout')

@section('content')

    <div class="container py-5">
        <h2 class="text-center">Login</h2>
        <div class="row py-5">

            <form class="col-md-9 m-auto" method="post" role="form" action="{{route("login.store")}}">
                @csrf
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control mt-1" id="email" name="email"
                           placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control mt-1" id="password" name="password"
                           placeholder="Password">
                </div>
                <div class="row">
                    <div class="col text-end mt-2">
                        <button type="submit" class="btn btn-success btn-lg px-3">Login</button>
                    </div>
                </div>
            </form>

            @if (request()->session()->has("error"))
                <div class="alert alert-danger col-md-9 m-auto mt-2">
                    <h4>{{request()->session()->pull("error")}}</h4>
                </div>
            @elseif(request()->session()->has("success"))
                <div class="alert alert-success col-md-9 m-auto mt-2">
                    {{-- @if($message != "")
                         {{$message}}
                     @endif--}}
                    <h4>{{request()->session()->pull("success")}}</h4>
                </div>
            @endif
        </div>
    </div>
@endsection
