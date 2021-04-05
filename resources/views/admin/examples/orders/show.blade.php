@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Order Details</h4>
                            {{--<p class="card-category">Here is a subtitle for this table</p>--}}

                        </div>

                        <div class="card-body table-full-width table-responsive">

                            <table class="table table-hover table-striped">
                                <thead>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                </thead>
                                <tbody>
                                {{--                                @dd($orders)--}}
                                @foreach($order->orderDetails as $od)
                                    <tr>
                                        <td>{{$od->id}}</td>
                                        <td><img src="{{$od->cover}}" alt="{{$od->name}}" width="150px"
                                                 height="150px"/></td>
                                        <td>{{$od->name}}</td>
                                        <td>{{$od->pivot->quantity}}</td>
                                        <td>{{$od->pivot->price}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
