@extends('admin.layout')

@section('additionalMeta')
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
   {{-- <link rel="stylesheet" href="{{asset("assets/css/templatemo.css")}}">--}}
    <link rel="stylesheet" href="{{asset("assets/css/custom.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick-theme.css')}}">
@show

@section('content')
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row" id="product">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3" id="cover">
                        <img class="card-img img-fluid" src="{{asset('storage/products/cover/'.$data['product']->cover)}}"
                             alt="{{$data['product']->name}}"
                             id="product-detail">
                    </div>
                    <div class="row">
                        <!--Start Controls-->

                        <div class="col-1 align-self-center">
                            @if(count($data['product']->images)/3 > 1)
                                <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                    <i class="text-dark fa fa-chevron-left"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                            @endif
                        </div>

                        <!--End Controls-->
                        <!--Start Carousel Wrapper-->

                        <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                            <!--Start Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">

                                @for($i = 0; $i < count($data['product']->images)/3; $i++)
                                    @include('partials.shop-single.slider',['images'=>$data['product']->images->skip($i * 3)->take(3)
                                    ])

                                @endfor

                            </div>

                            <!--End Slides-->
                        </div>

                        <!--End Carousel Wrapper-->
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            @if(count($data['product']->images)/3 > 1)
                                <a href="#multi-item-example" role="button" data-bs-slide="next">
                                    <i class="text-dark fa fa-chevron-right"></i>
                                    <span class="sr-only">Next</span>
                                </a>
                            @endif
                        </div>

                        <div class="col-lg-12">
                            <form class="col-md-9 m-auto" method="post" role="form" action="{{route("cover.update",
                            $data['product']->id)}}"
                                  enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <input type="file" class="form-control" name="cover" />
                                @error('cover')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                                @if(session()->has('coverSuccess'))
                                    <div class="alert alert-success mt-1">{{ session('coverSuccess') }}</div>
                                @endif
                                <input type="submit" class="form-control btn btn-primary" value="Change Cover">
                            </form>
                            <br>
                            <form class="col-md-9 m-auto" method="post" role="form" action="{{route("images.store",$data['product']->id)}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="file" multiple class="form-control" name="images[]" />
                                @error('images')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                                @error('images.*')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                                @if(session()->has('imagesSuccess'))
                                    <div class="alert alert-success mt-1">{{ session('imagesSuccess') }}</div>
                                @endif
                                <input type="submit" class="form-control btn btn-primary" value="Add Images">
                            </form>
                            <br>
                            <form class="col-md-9 m-auto" method="post" role="form" action="{{route("images.destroy",$data['product']->id
                            )}}"
                                  enctype="multipart/form-data">
                                @method('delete')
                                @csrf
                                @if(session()->has('imagesDeletionSuccess'))
                                    <div class="alert alert-success mt-1">{{ session('imagesDeletionSuccess') }}</div>
                                @endif
                                <input type="submit" class="form-control btn btn-danger" name="deleteAllImages"
                                       value="Delete
                                All
                                Images"/>
                            </form>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{$data['product']->name}}</h1>
                            <p class="h3 py-2">${{$data['product']->current_price}}</p>
                            <del class="text-center text-danger form-control-sm
                            mb-0">{{$data['product']->discount_price != null?
                            '$'.$data['product']->discount_price : ''}}</del>
                            <p class="py-2">
                                Rating:
                                @if($data['product']->rate!=0)
                                    @for($i = 0;$i<$data['product']->rate;$i++)
                                        <i class="fa fa-star text-warning"></i>
                                    @endfor
                                    @for($i = 0;$i<5-$data['product']->rate;$i++)
                                        <i class="fa fa-star text-secondary"></i>
                                    @endfor
                                @else
                                    Not rated yet.
                                @endif
                                <span class="list-inline-item text-dark" >|<span id="numOfComments"></span>
{{--                                    {{(dd($data))}}--}}

                                      Comments</span>
                            </p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Brand: </h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>{{$data['product']->brand->name}}</strong></p>
                                </li>
                            </ul>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Color :</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>{{$data['product']->color}}</strong></p>
                                </li>
                            </ul>
                            <h6>Description:</h6>
                            <p>{{$data['product']->description}}</p>
                            <form action="{{route('products.destroy',$data['product']->id)}}" method="POST">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="product-title" value="Activewear">
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item">Size :
                                                <input type="hidden" name="product-size" id="product-size" value="S">
                                            </li>
                                            {{--@dd($data)--}}
                                            @foreach($data['product']->sizes as $i => $s)
                                                @if($s->pivot->quantity != 0)
                                                    <li class="list-inline-item"><span class="btn btn-success
                                                    btn-size">{{$s->size}}</span></li>
                                                @endif
                                            @endforeach
                                            {{--@foreach($sizes as $size)
                                                @foreach($data['product']->sizes as $i => $s)
                                                    @if($s->id == $size->id)
                                                        <li class="list-inline-item"><span class="btn btn-success
                                                        btn-size">{{$s->size}}</span></li>
                                                    @endif
                                                @endforeach
                                            @endforeach--}}
                                            {{--<li class="list-inline-item"><span class="btn btn-success btn-size">S</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success btn-size">M</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success btn-size">L</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success btn-size">XL</span></li>--}}
                                        </ul>
                                    </div>
                                    <div class="col-auto">
                                        {{--<ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Quantity
                                                <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                            </li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                            <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                        </ul>--}}
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <a href="{{route('products.edit',$data['product']->id)}}" type="submit" class="btn
                                        btn-primary btn-lg" name="submit"
                                                value="buy">Edit</a>
                                    </div>
                                    <div class="col d-grid">
                                        <form action="{{route('products.destroy',$data['product']->id)}}"
                                              method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-lg" name="submit"
                                                    value="addtocard">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="blog-details-text">
                        {{--@dd($newUsers)--}}
                        @if(session()->has('successDelete'))
                            <div class="alert alert-success mt-1">{{ session('successDelete') }}</div>
                        @endif
                        @if(session()->has('errorDelete'))
                            <div class="alert alert-danger mt-1">{{ session('errorDelete') }}</div>
                        @endif
                        <div class="comment-option" id="comments">

                            {{--<h4>--}}{{--{{count($comments)}}--}}{{--4 Comments</h4>
                            --}}{{--@dd($comments)--}}



                            {{--@dd($data['comments'])
                            @foreach($data['comments'] as $i => $item)
                                        @include('partials.shop-single.comment',['comment' => $item,
                                        'subComments'=>$item->users,'i'=> $i ])
                            @endforeach--}}

                        </div>


                        {{--<div class="leave-comment">
                            <h4>Leave A Comment</h4>
                            <form class="comment-form">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <textarea placeholder="Messages"></textarea>
                                        <p class="error text-danger"></p>
                                        <button type="button" id="btnMainComment" class="site-btn">Send
                                            Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section("additionalScripts")
    <!-- Start Slider Script -->


    {{--<script src="{{asset('assets/js/shop-single.js')}}"></script>--}}
    <script src="{{asset('assets/js/slick.min.js')}}"></script>

    {{--<script src="{{asset('assets/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-migrate-1.2.1.min.js')}}"></script>--}}
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/templatemo.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('adminAssets/assets/js/single-product-comments.js')}}"></script>

    <script type="text/javascript">
        const id = '{{$data['product']->id}}';
        const idUser = '{{session()->has('user') ? session('user')->id : null}}';
    </script>





    <script>
        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: true,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                }
            ]
        });
    </script>

@endsection
