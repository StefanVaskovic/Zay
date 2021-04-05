@extends('layout')

@section('content')

    <div class="container py-5">
        <h2 class="text-center">Create a new account</h2>
        <div class="row py-5">

            <form class="col-md-9 m-auto" method="post" role="form" action="{{route("register.store")}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control mt-1" id="password" name="password"
                           placeholder="Password">
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control mt-1" id="address" name="address"
                           placeholder="Address">
                </div>
                <div class="mb-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control mt-1" id="city" name="city"
                           placeholder="City">
                </div>
                <div class="mb-3">
                    <label for="postal_code">Postal Code</label>
                    <input type="number" class="form-control mt-1" id="postal_code" name="postal_code"
                           placeholder="Postal Code">
                </div>
                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control mt-1" id="phone" name="phone"
                           placeholder="ex: 0644739047">
                </div>
                {{--<div class="mb-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control mt-1" id="image" name="image">
                </div>--}}
                <div class="row">
                    <div class="col text-end mt-2">
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger col-md-9 m-auto mt-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (request()->session()->has("error"))
                    <div class="alert alert-danger col-md-9 m-auto mt-2">
                        <h4>{{request()->session()->pull("error")}}</h4>
                    </div>
                @elseif(request()->session()->has("success"))
                    <div class="alert alert-success mt-1">{{request()->session()->pull("success")}}</div>
                @endif
            </form>


        </div>
    </div>
@endsection
