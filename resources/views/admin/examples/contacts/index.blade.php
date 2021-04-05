@extends('admin.layout')


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Contacts</h4>
                            {{--<p class="card-category">Here is a subtitle for this table</p>--}}
                        </div>
                        @if(session()->has('success'))
                            <div class="alert alert-success mt-1">{{ session('success') }}</div>
                        @endif
                        @if(session()->has('error'))
                            <div class="alert alert-danger mt-1">{{ session('error') }}</div>
                        @endif
                        <div class="card-body table-full-width table-responsive">

                            <table class="table table-hover table-striped">
                                <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Delete</th>
                                </thead>
                                <tbody>
                                @foreach($contacts as $c)
                                    <tr>
                                        <td>{{$c->id}}</td>
                                        <td>{{$c->name}}</td>
                                        <td>{{$c->email}}</td>
                                        <td>{{$c->subject}}</td>
                                        <td>{{$c->message}}</td>
                                        <td>
                                            <form action="{{route('contacts.destroy',$c->id)}}" method="post">
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
