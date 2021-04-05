@extends('admin.layout')


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has('successDelete'))
                        <div class="alert alert-success mt-1">{{ session('successDelete') }}</div>
                    @endif
                    @if(session()->has('errorDelete'))
                        <div class="alert alert-danger mt-1">{{ session('errorDelete') }}</div>
                    @endif
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Sizes</h4>
                            {{--<p class="card-category">Here is a subtitle for this table</p>--}}

                        </div>

                        <div class="card-body table-full-width table-responsive">

                            <table class="table table-hover table-striped">
                                <thead>
                                <th>ID</th>
                                <th>Size</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                </thead>
                                <tbody>
                                @foreach($sizes as $s)
                                    <tr>
                                        <td>{{$s->id}}</td>
                                        <td>{{$s->size}}</td>
                                        <td><a href="{{route('sizes.edit',$s->id)}}" class="btn btn-primary btn-fill
                                        btn-xs
">Edit</a></td>
                                        <td>
                                            <form action="{{route('sizes.destroy',$s->id)}}" method="post">
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
        <form class="col-md-9 m-auto" method="post" role="form" action="{{route('sizes.store')}}">
            @csrf
            <div class="mb-3">
                <label for="size">Size</label>
                <input type="text" class="form-control mt-1" id="size" name="size" value=""
                       placeholder="Size">
            </div>
            @if(session()->has('successInsert'))
                <div class="alert alert-success mt-1">{{ session('successInsert') }}</div>
            @endif
            @if(session()->has('errorInsert'))
                <div class="alert alert-danger mt-1">{{ session('errorInsert') }}</div>
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
            <div class="row">
                <div class="col text-end mt-2 mb-3">
                    <button type="submit" class="btn btn-success btn-fill px-3">Add</button>
                </div>
            </div>
        </form>
    </div>



@endsection
