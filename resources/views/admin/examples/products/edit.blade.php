@extends('admin.layout')

@section('content')
    <h3 class="text-center">Edit product</h3>
    @if(session()->has('success'))
        <div class="alert alert-success mt-1">{{ session('success') }}</div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger mt-1">{{ session('error') }}</div>
    @endif
    <form class="col-md-9 m-auto" method="post" role="form" action="{{route("products.update",$data['product']->id)}}"
          enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control mt-1" id="name" name="name" value="{{$data['product']->name}}"
                   placeholder="Name">
        </div>
        <div class="mb-3">
            <label for="current_price">Price</label>
            <input type="number" class="form-control mt-1" id="current_price" name="current_price"
                   value="{{$data['product']->current_price}}" placeholder="Price">
        </div>
        <div class="mb-3">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" class="form-control mt-1">
                @foreach($genders as $g)
                    <option value="{{$g}}" @if($data['product']->gender == $g) selected @endif>{{$g}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="color">Color</label>
            <input type="text" class="form-control mt-1" id="color" name="color" value="{{$data['product']->color}}"
            placeholder="Color">
        </div>
        <div class="mb-3">
            <label for="category">Category</label>
            <select id="category" name="category" class="form-control mt-1">
                @foreach($categories as $c)
                    <option value="{{$c->id}}" @if($c->id == $data['product']->category->id) selected @endif
                    >{{$c->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="brand">Brand</label>
            <select id="brand" name="brand" class="form-control mt-1">
                @foreach($brands as $b)
                    <option value="{{$b->id}}" @if($b->id == $data['product']->brand->id) selected
                        @endif>{{$b->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="color">Description</label>
            <textarea class="form-control mt-1" id="description" name="description"
                      placeholder="Description">{{$data['product']->description}}</textarea>
        </div>
        <div class="mb-3">
            <label for="color">Sizes</label><br>
            @foreach($sizes as $s)
                @foreach($data['product']->sizes as $size)
                    @if($s->id == $size->id)
                <span class="form-check-sign">{{$s->size}}</span>
                <input type="number" name="quantitySizes[]" class="form-control" placeholder="quantity"
                       value="{{$size->pivot->quantity}}"/><br>
                        @break
                    @endif
                @endforeach
            @endforeach

            {{--@php
                $newSizes = $sizes;
            @endphp
            @foreach($sizes as $i=>$s)
                @foreach($data['product']->sizes as $size)
                    @if($s->id == $size->id)
                        @php
                            unset($newSizes[$i]);
                        @endphp
                        <span class="form-check-sign">{{$s->size}}</span>
                        <input type="number" name="quantitySizes[]" class="form-control" placeholder="quantity"
                               value="{{$size->pivot->quantity}}"/><br>
                        @break
                    @endif
                @endforeach
            @endforeach
            @foreach($newSizes as $s)
                <span class="form-check-sign">{{$s->size}}</span>
                <input type="number" name="quantitySizes[]" class="form-control" placeholder="quantity"
                       value="0"/><br>
            @endforeach--}}
        </div>
        <div class="row">
            <div class="col text-end mt-2 mb-3">
                <button type="submit" class="btn btn-success btn-fill px-3">Update</button>
            </div>
        </div>
    </form>


    @if ($errors->any())
        <div class="alert alert-danger mt-5">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
