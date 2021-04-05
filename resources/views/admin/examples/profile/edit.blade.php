@extends('admin.layout')


@section('additionalScripts')
    {{--<script type="text/javascript">
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

            demo.showNotification();

        });
    </script>--}}
@endsection


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('profile.update',$admin->id)}}" method="post">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Name"
                                                   value="{{$admin->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" placeholder="Email"
                                                   value="{{$admin->email}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Home
                                            Address"
                                                   value="{{$admin->address}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" placeholder="City"
                                                   value="{{$admin->city}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-1">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" name="phone" placeholder="Phone
                                            Number"
                                                   value="{{$admin->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-1">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="number" class="form-control"
                                                   placeholder="Postal Code" name="postal_code"
                                                   value="{{$admin->postal_code}}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                <div class="clearfix"></div>
                            </form>
                            @if(session()->has('success'))
                                <div class="alert alert-success mt-1">{{ session('success') }}</div>
                            @endif
                            @if(session()->has('error'))
                                <div class="alert alert-danger mt-1">{{ session('error') }}</div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-user">
                        <form action="{{route('password.update',$admin->id)}}" method="post">
                            @method('put')
                            @csrf
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Current Password</label>
                                                <input type="text" class="form-control" name="currentPassword"
                                                       placeholder="Current Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="text" class="form-control" name="newPassword"
                                                       placeholder="New Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="text" class="form-control" name="confirmPassword"
                                                       placeholder="Confirm Password">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Change
                                        Password</button>
                                    <div class="clearfix"></div>
                                    @if(session()->has('successPasswordChange'))
                                        <div class="alert alert-success mt-1">{{ session('successPasswordChange') }}</div>
                                    @endif
                                    @if(session()->has('errorPasswordChange'))
                                        <div class="alert alert-danger mt-1">{{ session('errorPasswordChange') }}</div>
                                    @endif
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
