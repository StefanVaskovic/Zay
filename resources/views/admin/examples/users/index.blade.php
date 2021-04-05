@extends('admin.layout')


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Users</h4>
                            {{--<p class="card-category">Here is a subtitle for this table</p>--}}
                            {{--<span ><a href="{{route('users.create')}}" class="btn btn-primary
                                   btn-fill
">Add</a></span>--}}
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
                                <th>Email</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                </thead>
                                <tbody>
                                @foreach($users as $u)
                                    <tr>
                                        <td>{{$u->id}}</td>
                                        <td>{{$u->name}}</td>
                                        <td>{{$u->email}}</td>
                                        <td>{{($u->role->name)}}</td>
                                        <td><a href="{{route('users.edit',$u->id)}}" class="btn btn-primary btn-fill
                                        btn-xs
">Edit</a></td>
                                        <td>
                                            <form action="{{route('users.destroy',$u->id)}}" method="post">
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
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
