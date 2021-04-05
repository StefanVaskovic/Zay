@extends("layout")


@section("content")



    <!-- Start Content Page -->
    <div class="container-fluid bg-light py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1">Contact Us</h1>
            <p>
                If you have any questions, please do not hesitate to contact us!
            </p>
        </div>
    </div>



    <!-- Start Contact -->
    <div class="container py-5">
        <div class="row py-5">
            <form class="col-md-9 m-auto" method="post" role="form" action="{{route("contact.store")}}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputname">Name</label>
                        <input type="text" class="form-control mt-1" id="name" name="name" value="{{session()->has
                        ('user') ? session('user')->name : ''}}"
                        placeholder="Name">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputemail">Email</label>
                        <input type="email" class="form-control mt-1" id="email" name="email" value="{{session()->has
                        ('user') ? session('user')->email : ''}}"
                               placeholder="Email">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputsubject">Subject</label>
                    <input type="text" class="form-control mt-1" id="subject" name="subject" placeholder="Subject">
                </div>
                <div class="mb-3">
                    <label for="inputmessage">Message</label>
                    <textarea class="form-control mt-1" id="message" name="message" placeholder="Message" rows="8"></textarea>
                </div>
                <div class="row">
                    <div class="col text-end mt-2">
                        <button type="submit" class="btn btn-success btn-lg px-3">Let’s Talk</button>
                    </div>
                </div>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger col-md-9 m-auto mt-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (request()->session()->has("error"))
                <div class="alert alert-danger col-md-9 m-auto mt-2">
                    <h4>{{request()->session()->pull("error")}}</h4>
                </div>
            @elseif(request()->session()->has("success"))
                <div class="alert alert-success col-md-9 m-auto mt-2">
                   {{-- @if($message != "")
                        {{$message}}
                    @endif--}}
                    <h4>{{request()->session()->pull("success")}}</h4>
                </div>
            @endif
        </div>
    </div>
    <!-- End Contact -->
@endsection
