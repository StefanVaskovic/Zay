@extends('admin.layout')

@section('content')
    <div class="content">
    <form class="col-md-9 m-auto" method="post" role="form" action="{{route('brands.update',$brand->id)}}">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control mt-1" id="name" name="name" value="{{$brand->name}}"
                   placeholder="Name">
        </div>
        @if(session()->has('successUpdate'))
            <div class="alert alert-success mt-1">{{ session('successUpdate') }}</div>
        @endif
        @if(session()->has('errorUpdate'))
            <div class="alert alert-danger mt-1">{{ session('errorUpdate') }}</div>
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
                <button type="submit" class="btn btn-success btn-fill px-3">Update</button>
            </div>
        </div>
    </form>
    </div>
@endsection
