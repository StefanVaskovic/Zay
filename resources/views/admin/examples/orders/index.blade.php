@extends('admin.layout')


@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Orders</h4>
                            {{--<p class="card-category">Here is a subtitle for this table</p>--}}

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
                        <div class="card-body table-full-width table-responsive">

                            <table class="table table-hover table-striped">
                                <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Sum Price</th>
                                <th>Info</th>
                                <th>Delete</th>
                                </thead>
                                <tbody>
{{--                                @dd($orders)--}}
                                @foreach($orders as $o)
                                    <tr>
                                        <td>{{$o->id}}</td>
                                        <td>{{$o->user->name}}</td>
                                        <td>{{$o->date}}</td>
                                        <td>{{$o->sumPrice}}</td>
                                        <td><a href="{{route('orders.show',$o->id)}}" class="btn btn-warning btn-fill
                                        btn-xs
">Info</a></td>
                                        <td>
                                            <form action="{{route('orders.destroy',$o->id)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <input type="submit" class="btn btn-danger btn-fill btn-xs" value="Delete" />
                                            </form>
                                        </td>
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
