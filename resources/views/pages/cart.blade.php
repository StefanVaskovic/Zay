@extends('layout')

@section('content')
   {{-- @dd(session('products'))--}}

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" id="cart">
                    @if(session()->has('products'))
                        <div class="card strpied-tabled-with-hover">
                            <div class="card-header">
                                <h2 class="card-title">Cart</h2>
                                <p class="card-category">Preview of your order</p>
                            </div>

                            <div class="card-body table-full-width table-responsive">

                                <table class="table table-hover table-striped">
                                    <thead>
                                    <th>No.</th>
                                    <th>Picture</th>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Remove</th>
                                    </thead>
                                    <tbody>
                                    @php
                                      $i = 0;
                                        $totalPrice = 0;
                                    @endphp
                                    @foreach(session('products') as $p)
                                        @php
                                        $totalPrice+=$p->price * $p->quantity;
                                        @endphp
                                        <tr>
                                            <td  class="align-middle">{{++$i}}</td>
                                            <td  class="align-middle"><img src="{{asset('storage/products/cover/'.$p->cover)}}" alt="{{$p->name}}"
                                                                           width="150px"
                                                     height="150px"/></td>
                                            <td  class="align-middle"><a href="{{route('product',$p->id)}}">{{$p->name}}</a></td>
                                            <td  class="align-middle">{{$p->size}}</td>
                                            <td  class="align-middle price">${{$p->price * $p->quantity}}</td>
                                            <td  class="align-middle"><input class="form-control quantity"
                                                                             type="number" min="1"
                                                                             data-idproduct="{{$p->id}}"
                                                                             data-size="{{$p->size}}"
                                                       value="{{$p->quantity}}"/></td>
                                            <td  class="align-middle">
                                                <input type="button" id="btnRemoveFromCart"
                                                       data-idproduct="{{$p->id}}" data-size="{{$p->size}}"
                                                       class="btn
                                                btn-danger
                                                btn-xs" value="Remove"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="col-12 float-right">
                                    <p>Total price: <b class="totalPrice">${{$totalPrice}}</b></p>
                                    <input type="button" id="btnOrder" class="btn btn-success btn-lg" value="Buy"/>
                                </div>
                            </div>
                        </div>
                    @else
                        @if(session()->has('user'))
                            <div class="text-center alert alert-info">
                                You cart is empty!
                            </div>
                        @endif
                            <div class="text-center alert alert-info">
                                You need to be logged in to be able to use cart!
                            </div>
                    @endif
                    {{--{{$data['products']->links()}}--}}
                </div>
            </div>
        </div>
    </div>

    <div id="snackbar"></div>
@endsection

@section('additionalScripts')
    <script src="{{asset('assets/js/cart.js')}}"></script>
@endsection
