<div class="col-12 col-md-4 mb-4">
    <div class="card h-100">
        <a href="{{route('product',["id" => $item->id])}}">
            <img src="{{asset('storage/products/cover/'.$item->cover)}}" class="card-img-top" alt="...">
        </a>
        <div class="card-body">
            <ul class="list-unstyled d-flex justify-content-between">
                <li>
                    Rate:
                    @if(count($item->ratingUsers))
                        @for($i = 0; $i < $item->rate;$i++)
                            <i class="text-warning fa fa-star"></i>
                        @endfor
                        @for($i = 0; $i< 5 - $item->rate;$i++)
                            <i class="text-muted fa fa-star"></i>
                        @endfor
                    @else
                        Not rated yet.
                    @endif
                </li>
                <li class="text-muted text-right">${{$item->current_price}}</li>
            </ul>
            <a href="shop-single.html" class="h2 text-decoration-none text-dark">{{$item->name}}</a>
            <p class="card-text">
                {{$item->description}}
            </p>
            <p class="text-muted">Comments: <b>{{count($item->comments)==0?'No comments yet.':count($item->comments)
            }}</b></p>
        </div>
    </div>
</div>
