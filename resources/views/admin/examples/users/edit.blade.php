@extends('admin.layout')

@section('content')
    <div class="content">
        <h2 class="text-center">Edit user</h2>
        <form class="col-md-9 m-auto" method="post" role="form" action="{{route("users.update",$user->id)}}">
            @method('put')
            @csrf
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Name"
                           value="{{$user->name}}">
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Email"
                           value="{{$user->email}}">
                </div>

            </div>
            <div class="row">
                <div class="form-group col-md-12 mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control mt-1" id="address" name="address" placeholder="Address"
                           value="{{$user->address}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12 mb-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control mt-1" id="city" name="city" placeholder="City"
                           value="{{$user->city}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12 mb-3">
                    <label for="postal_code">Postal Code</label>
                    <input type="text" class="form-control mt-1" id="postal_code" name="postal_code"
                           placeholder="Postal Code"
                           value="{{$user->postal_code}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12 mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control mt-1" id="phone" name="phone" placeholder="Phone"
                           value="{{$user->phone}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12 mb-3">
                    <label for="role">Role</label>
                    <select class="form-control mt-1" id="role" name="role">
                        @foreach($roles as $r)
                        <option value="{{$r->id}}" @if($r->id == $user->role_id) selected @endif>{{$r->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
            @if(session()->has('success'))
                <div class="alert alert-success mt-1">{{ session('success') }}</div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger mt-1">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
@endsection
