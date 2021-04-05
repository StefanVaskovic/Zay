@extends('admin.layout')

@section('content')
    <div class="content">
        <h3 class="text-center">Edit Size</h3>
    <form class="col-md-9 m-auto" method="post" role="form" action="{{route('sizes.update',$size->id)}}">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="size">Size</label>
            <input type="text" class="form-control mt-1" id="size" name="size" value="{{$size->size}}"
                   placeholder="Size">
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
