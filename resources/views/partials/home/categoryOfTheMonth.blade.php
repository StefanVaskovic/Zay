<div class="col-12 col-md-4 p-5 mt-3">
    <a href="{{route('products',["idCat" => $item['idCategory'],"idProd" => 'all'])}}"><img src="{{$item['image']}}" class="rounded-circle img-fluid border"></a>
    <h5 class="text-center mt-3 mb-3">{{$item['name']}}</h5>
    <p class="text-center"><a href="{{route('products',["idCat" => $item['idCategory'],"idProd" => 'all'])}}" class="btn btn-success">Go Shop</a></p>
</div>
