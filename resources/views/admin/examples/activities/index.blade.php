@extends('admin.layout')

{{--@dd($users)--}}
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Activities</h4>
                        </div>

                        <div class="card-body table-full-width table-responsive">

                            <table class="table table-hover table-striped">
                                <thead>
                                <th>ID</th>
                                <th>User</th>
                                <th>Activity</th>
                                <th>Date</th>
                                </thead>
                                <tbody>
                                @foreach($users as $u)
                                    @foreach($u->activities as $a)
                                    <tr>
                                        <td>{{$u->id}}</td>
                                        <td>{{$u->name}}</td>
                                        <td>{{$a->name}}</td>
                                        <td>{{$a->pivot->date}}</td>
                                    </tr>
                                    @endforeach
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
