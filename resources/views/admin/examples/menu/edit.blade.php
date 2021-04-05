@extends('admin.layout')

@section('content')
    <div class="content">
    <form class="col-md-9 m-auto" method="post" role="form" action="{{route('menus.update',$oneMenu->id)}}">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control mt-1" id="name" name="name" value="{{$oneMenu->name}}"
                   placeholder="Name">
        </div>
        <div class="mb-3">
            <label for="name">Route</label>
            <input type="text" class="form-control mt-1" id="route" name="route" value="{{$oneMenu->route}}"
                   placeholder="Route">
        </div>
        <div class="mb-3">
            <label for="name">Order</label>
            <input type="text" class="form-control mt-1" id="order" name="order" value="{{$oneMenu->order}}"
                   placeholder="Order">
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
        <div class="row">
            <div class="col text-end mt-2 mb-3">
                <button type="submit" class="btn btn-success btn-fill px-3">Update</button>
            </div>
        </div>
    </form>
    </div>
@endsection
