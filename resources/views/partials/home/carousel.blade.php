
@if($i == 0)
<div class="carousel-item active">
    <div class="container">
        <div class="row p-5">
            <div class="mx-auto d-flex justify-content-center align-items-center col-md-8 col-lg-6 order-lg-last">
                <img class="img-fluid" src="{{asset('assets/img/'.$item['image'])}}" alt="">
            </div>
            <div class="col-lg-6 mb-0 d-flex align-items-center">
                <div class="text-align-left align-self-center">
                    <h1 class="h1 text-success">{{$item['title']}}</h1>
                    <h3 class="h2">{{$item['subtitle']}}</h3>
                    <p>
                        {{$item['description']}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="carousel-item">
    <div class="container">
        <div class="row p-5">
            <div class="mx-auto d-flex justify-content-center align-items-center col-md-8 col-lg-6 order-lg-last">
                <img class="img-fluid" src="{{asset('assets/img/'.$item['image'])}}" alt="">
            </div>
            <div class="col-lg-6 mb-0 d-flex align-items-center">
                <div class="text-align-left">
                    <h1 class="h1">{{$item['title']}}</h1>
                    <h3 class="h2">{{$item['subtitle']}}</h3>
                    <p>
                        {{$item['description']}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
