<div class="carousel-item @if($i == 0) active @endif">
    <div class="row" style="background: transparent;">
        @foreach($images as $image)
        <div class="col-4">
            <a href="#">
                <img class="card-img img-fluid mb-1" src="{{asset('storage/products/images/'.$image->image)}}" alt="Product Image 1">

            </a>
            @if(session()->has('user') && session('user')->role_id == 1)
            <form action="{{route('image.destroy',$image->id)}}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger d-block m-auto"><i class="fa fa-times
                fa-xs"></i></button>
            </form>
            @endif
        </div>
        @endforeach
    </div>
</div>
