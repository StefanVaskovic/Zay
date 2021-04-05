@extends("layout")

@section("content")

    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @foreach($slider as $i => $item)
                @include("partials.home.carousel",["item" => $item,"i" => $i])
            @endforeach
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->


    <!-- Start Categories of The Month -->
   {{-- <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Categories of The Month</h1>
                <p>
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
        <div class="row">
            @foreach($categories as $i => $item)
                @if($i <= 2)
                @include("partials.home.categoryOfTheMonth")
                @endif
            @endforeach
        </div>
    </section>--}}
    <!-- End Categories of The Month -->

    <!-- Start Featured Product -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Newest Product</h1>
                    <p>
                        There are out newest products, take a better look by clicking on any product
                    </p>
                </div>
            </div>
            <div class="row">

                @foreach($products as $i => $item)
                        @include("partials.home.product")
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Featured Product -->
@endsection
