@extends("layout")
{{--@dd(session('user'))--}}
@section("content")
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3">
                <h1 class="h2 pb-4">Categories</h1>
                <ul class="list-unstyled templatemo-accordion" id="categories">
                   {{-- <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Gender
                            <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul class="collapse show list-unstyled pl-3">
                            <li><a class="text-decoration-none" href="#">Men</a></li>
                            <li><a class="text-decoration-none" href="#">Women</a></li>
                        </ul>
                    </li>
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Sale
                            <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                            <li><a class="text-decoration-none" href="#">Sport</a></li>
                            <li><a class="text-decoration-none" href="#">Luxury</a></li>
                        </ul>
                    </li>
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Product
                            <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul id="collapseThree" class="collapse list-unstyled pl-3">
                            <li><a class="text-decoration-none" href="#">Bag</a></li>
                            <li><a class="text-decoration-none" href="#">Sweather</a></li>
                            <li><a class="text-decoration-none" href="#">Sunglass</a></li>
                        </ul>
                    </li>--}}
                </ul>
                <h1 class="h2 pb-4">Genders</h1>
                <ul class="list-unstyled templatemo-accordion" id="genders">

                </ul>
                <h1 class="h2 pb-4">Sizes</h1>
                <ul class="list-unstyled templatemo-accordion" id="sizes">

                </ul>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6">
                        {{--<ul class="list-inline shop-top-menu pb-3 pt-1">
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none mr-3" href="#">All</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none mr-3" href="#">Men's</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none" href="#">Women's</a>
                            </li>
                        </ul>--}}
                        <input type="search" class="form-control" placeholder="Search..." id="search"/>
                    </div>
                    <div class="col-md-6 pb-4">
                        <div class="d-flex">
                            <select class="form-control" id="sort">
                                <option value="0">Choose</option>
                                <option value="A-Z">A to Z</option>
                                <option value="Z-A">Z to A</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="products">
                    {{--@foreach($products as $item)
                        @include("partials.products.product")
                    @endforeach--}}
                </div>
                <div div="row">
                    <ul class="pagination pagination-lg justify-content-end" id="pages">
                        {{--<li class="page-item disabled">
                            <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="#" tabindex="-1">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark" href="#">3</a>
                        </li>--}}
                        {{--@for($i = 1; $i <= $pages; $i++)
                            <li class="page-item @if($i==request()->get('page')) disabled @endif">
                                <a class="page-link @if($i==request()->get('page')) active @endif rounded-0 mr-3
                                shadow-sm border-top-0 border-left-0" href="{{route('products').'?page='.$i}}"
                                   tabindex="-1">{{$i}}</a>
                             </li>
                        @endfor--}}
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- End Content -->
@endsection

@section('additionalScripts')
    <script type="text/javascript">
        const baseUrl = "{{url('/')}}";
        //const publicFolder = "{{asset('/')}}";
        const productsShow = baseUrl + "/products";
    </script>
    <script src="{{asset('assets/js/main.js')}}"></script>

@endsection
