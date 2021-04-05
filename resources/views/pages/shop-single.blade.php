@extends('layout')
{{--{{dd($product)}}--}}
@section("additionalMeta")
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick-theme.css')}}">
@show


  @section('content')
      <!-- Open Content -->

      <section class="bg-light">
          <div class="container pb-5">
              <div class="row" id="product">
                  <div class="col-lg-5 mt-5">
                      <div class="card mb-3" id="cover">
                          <img class="card-img img-fluid" src="{{asset('/storage/products/cover/'.$product->cover)}}" alt="{{$product->name}}"
                               id="product-detail">
                      </div>
                      <div class="row">
                          <!--Start Controls-->

                          <div class="col-1 align-self-center">
                              @if(count($product->images)/3 > 1)
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

                                  @for($i = 0; $i < count($product->images)/3; $i++)
                                        @include('partials.shop-single.slider',['images'=>$product->images->skip($i * 3)->take(3)
                                        ])
                                  @endfor
                              </div>
                              <!--End Slides-->
                          </div>
                          <!--End Carousel Wrapper-->
                          <!--Start Controls-->
                          <div class="col-1 align-self-center">
                              @if(count($product->images)/3 > 1)
                              <a href="#multi-item-example" role="button" data-bs-slide="next">
                                  <i class="text-dark fa fa-chevron-right"></i>
                                  <span class="sr-only">Next</span>
                              </a>
                              @endif
                          </div>

                          <!--End Controls-->
                      </div>
                  </div>
                  <!-- col end -->
                  <div class="col-lg-7 mt-5">
                      <div class="card">
                          <div class="card-body">
                              <h1 class="h2">{{$product->name}}</h1>
                              <p class="h3 py-2">${{$product->current_price}}</p>
                              <p class="py-2">
                                  Rating:
                                  @if($product->rate!=0)
                                      <i class="fa fa-star text-warning"></i> {{$product->rate}}
                                      {{--@for($i = 0;$i<$product->rate;$i++)
                                      <i class="fa fa-star text-warning"></i>
                                      @endfor
                                      @for($i = 0;$i<5-$product->rate;$i++)
                                          <i class="fa fa-star text-secondary"></i>
                                      @endfor--}}
                                  @else
                                      Not rated yet.
                                  @endif
                                  <span class="list-inline-item text-dark" >| Comments: <span id="numOfComments"></span>
                                      {{--{{count
                                  ($newComments)}}--}}
                                      </span>
                              </p>
                              <ul class="list-inline">
                                  <li class="list-inline-item">
                                      <h6>Brand: </h6>
                                  </li>
                                  <li class="list-inline-item">
                                      <p class="text-muted"><strong>{{$product->brand->name}}</strong></p>
                                  </li>
                              </ul>
                              <ul class="list-inline">
                                  <li class="list-inline-item">
                                      <h6>Color :</h6>
                                  </li>
                                  <li class="list-inline-item">
                                      <p class="text-muted"><strong>{{$product->color}}</strong></p>
                                  </li>
                              </ul>
                              <h6>Description:</h6>
                              <p>{{$product->description}}</p>

                                  <input type="hidden" name="product-title" value="Activewear">
                                  <div class="row">
                                      <div class="col-auto">
                                          <ul class="list-inline pb-3">
                                              <li class="list-inline-item">Size :
                                                  <input type="hidden" name="product-size" id="product-size" value="">
                                              </li>
                                              @foreach($product->sizes as $i => $s)
                                                  @if($s->pivot->quantity != 0)
                                                      <li class="list-inline-item"><span class="btn btn-success
                                                    btn-size">{{$s->size}}</span></li>
                                                  @endif
                                              @endforeach
                                          </ul>
                                      </div>
                                      <div class="col-auto">
                                          <ul class="list-inline pb-3">
                                              <li class="list-inline-item text-right">
                                                  Quantity
                                                  <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                              </li>
                                              <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                              <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                              <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="row pb-3">
                                      <div class="col d-grid">
                                          @if(session()->has('user'))
Rate this product: <p>
                                             {{-- @dd(session('user'))--}}
                                              @php
                                              $rate=0;
                                              @endphp

                                              @php


                                              foreach (session('user')->ratings as $r)
                                                {
                                                    if($product->id == $r->id){
                                                        $rate = $r->pivot->grade;
                                                        break;
                                                    }
                                                }
                                              @endphp

                                            {{--@dd(session('user'))--}}
                                            @for($i=1;$i<=5;$i++)
                                                  @if($rate >= $i)
                                                  <a href="#"  class="ratings" data-rate="{{$i}}"><i class="fa fa-star
                                                  text-warning starsWarning stars"></i></a>
                                                  @else
                                                      <a href="#"  class="ratings" data-rate="{{$i}}"><i class="fa fa-star
                                                  text-secondary starsSecondary stars"></i></a>
                                                  @endif
                                              @endfor
                                              @endif

                                          </p>
                                          {{--<select class="form-control btn btn-success btn-lg" id="rate">
                                              <option value="0">Rate This Product</option>
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                          </select>--}}


                                         {{-- <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>--}}
                                      </div>
                                      <div class="col d-grid">
                                          <button type="button" class="btn btn-success btn-lg" name="submit"
                                                  value="addtocard" id="btnAddToCart">Add To Cart</button>
                                            <div id="snackbar"></div>
                                      </div>
                                    <span id="errors"></span>
                                  </div>
                              <div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Close Content -->
      <!-- Blog Details Section Begin -->
      <section class="blog-details-section">
          <div class="container">
              <div class="row">
                  <div class="col-lg-10 offset-lg-1">
                      <div class="blog-details-text">
                          {{--@dd($newUsers)--}}
                          <div class="comment-option" id="comments">

                              {{--<h4>--}}{{--{{count($comments)}}--}}{{--4 Comments</h4>
                              --}}{{--@dd($comments)--}}{{--



                              @foreach($comments as $i => $item)
                                          @include('partials.shop-single.comment',['comment' => $item,
                                          'subComments'=>$item->users,'i'=> $i ])
                              @endforeach--}}

                          </div>

                          <div class="leave-comment">
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
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Blog Details Section End -->
  @endsection




@section("additionalScripts")
    <!-- Start Slider Script -->
    <script type="text/javascript">
        const id = '{{$product->id}}';
        const idUser = '{{session()->has('user') ? session('user')->id : ''}}';
        console.log(idUser)
    </script>


    <script src="{{asset('assets/js/shop-single.js')}}"></script>
    <script src="{{asset('assets/js/slick.min.js')}}"></script>


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
    <!-- End Slider Script -->
@endsection

