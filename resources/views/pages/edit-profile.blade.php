@extends('layout')


@section('content')
    <div class="content">
        <div class="container">
            <div class="row mt-5 mb-5">
                <div class="col-md-3 text-center">
                    <ul class="list-group">
                        <a href="#profile-info" class="text-decoration-none section-link"><li
                                class="list-group-item">Profile</li></a>
                        <a href="#orders" class="text-decoration-none section-link"><li class="list-group-item">Orders</li></a>
                    </ul>
                </div>
                <div class="col-md-9 sectionToShow" id="profile-info">
                        <div class="row" >
                            <div class="col-md-7">
                                <form class="" method="post" role="form" action="{{route("profile.update",$user->id)}}">
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
                                            <input type="email" class="form-control mt-1" id="email" name="email"
                                                   placeholder="Email" value="{{$user->email}}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control mt-1" id="address" name="address"
                                               placeholder="Address" value="{{$user->address}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control mt-1" id="city" name="city"
                                               placeholder="City" value="{{$user->city}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="number" class="form-control mt-1" id="postal_code" name="postal_code"
                                               placeholder="Postal Code" value="{{$user->postal_code}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control mt-1" id="phone" name="phone"
                                               placeholder="ex: 0644739047" value="{{$user->phone}}">
                                    </div>
                                    <div class="row">
                                        <div class="col text-end mt-2">
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </div>

                                    @if (request()->session()->has("error"))
                                        <div class="alert alert-danger col-md-9 m-auto mt-2">
                                            <h4>{{request()->session()->pull("error")}}</h4>
                                        </div>
                                    @elseif(request()->session()->has("success"))
                                        <div class="alert alert-success mt-1">{{request()->session()->pull("success")}}</div>
                                    @endif
                                </form>
                                @if(session()->has('success'))
                                    <div class="alert alert-success mt-1">{{ session('success') }}</div>
                                @endif
                                @if(session()->has('error'))
                                    <div class="alert alert-danger mt-1">{{ session('error') }}</div>
                                @endif
                            </div>
                            <div class="col-md-5">

                                <form action="{{route('password.update',$user->id)}}" method="post">
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
                                        <div class="row">
                                            <div class="col text-end mt-2">
                                                <button type="submit" class="btn btn-success">Change Password</button>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        @if(session()->has('successPasswordChange'))
                                            <div class="alert alert-success mt-1">{{ session('successPasswordChange') }}</div>
                                        @endif
                                        @if(session()->has('errorPasswordChange'))
                                            <div class="alert alert-danger mt-1">{{ session('errorPasswordChange') }}</div>
                                        @endif
                                    </div>
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
                <div class="col-md-9 sectionToShow" id="orders">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Orders</h4>
                            {{--<p class="card-category">Here is a subtitle for this table</p>--}}

                        </div>
                        <div class="card-body table-full-width table-responsive" >

                            @if(count($user->orders))

                            <table class="table table-hover table-striped">
                                <thead>
                                <th>Order number</th>
                                <th>Date</th>
                                <th>Sum Price</th>
                                <th>Info</th>
                                </thead>
                                <tbody>
                                {{--                                @dd($orders)--}}
                                @foreach($user->orders as $o)
                                    <tr>
                                        <td class="align-middle">#{{$o->id}}</td>
                                        <td class="align-middle">{{$o->date}}</td>
                                        <td class="align-middle">${{$o->sumPrice}}</td>
                                        <td class="align-middle"><a href="#orderDetails" data-idorder="{{$o->id}}"
                                            class="orderInfo btn
                                        btn-warning btn-fill
                                        btn-xs
">Info</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @else

                                <div class="alert alert-info">
                                    You don't have any orders!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5" id="orderDetails">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Order Details</h4>
                        </div>
                        <div class="card-body table-full-width table-responsive" >

                            <table class="table table-hover table-striped">
                                <thead>
                                <th class="text-center">No.</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Product</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                </thead>
                                <tbody id="orderDetailsData">
                                {{--                                @dd($orders)--}}
                                {{--@foreach($order->orderDetails as $od)
                                    <tr>
                                        <td>{{$od->id}}</td>
                                        <td><img src="{{$od->cover}}" alt="{{$od->name}}" width="150px"
                                                 height="150px"/></td>
                                        <td>{{$od->name}}</td>
                                        <td>{{$od->pivot->quantity}}</td>
                                        <td>{{$od->pivot->price}}</td>
                                    </tr>
                                @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @if ($errors->any())
            <div class="alert alert-danger col-md-12 m-auto mt-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{--<div class="row">
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
        </div>--}}
    </div>

@endsection


@section('additionalScripts')
    <script>
        var section = "#profile-info"
        if(localStorage.getItem('sectionToShow') != null && localStorage.getItem('sectionToShow') != "#profile")
        {
            section = localStorage.getItem('sectionToShow')
        }


    </script>

    <script src="{{asset('assets/js/edit-profile.js')}}"></script>
@endsection
