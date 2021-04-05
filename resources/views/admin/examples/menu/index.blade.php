@extends('admin.layout')


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Menus</h4>
                            {{--<p class="card-category">Here is a subtitle for this table</p>--}}
                            <span ><a href="{{route('menus.create')}}" class="btn btn-primary
                                   btn-fill
">Add</a></span>
                        </div>

                        <div class="card-body table-full-width table-responsive">

                            <table class="table table-hover table-striped">
                                <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Route</th>
                                <th>Order</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                </thead>
                                <tbody>
                                @foreach($menus as $m)
                                    <tr>
                                        <td>{{$m->id}}</td>
                                        <td>{{$m->name}}</td>
                                        <td>{{$m->route}}</td>
                                        <td>{{$m->order}}</td>
                                        <td><a href="{{route('menus.edit',$m->id)}}" class="btn btn-primary btn-fill btn-xs
">Edit</a></td>
                                        <td>
                                            <form action="{{route('menus.destroy',$m->id)}}" method="post">
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
