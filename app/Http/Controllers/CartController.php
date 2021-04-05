<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Activity;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends ParentController
{
    public function index()
    {
        //session()->remove('products');
        return view('pages.cart',$this->data);
    }

    public function removeFromCart(Request $request)
    {
        $products = [];
        $product = self::productThatAlreadyExists($products, $request->size, $request->id);
        if($product)
        {

            $newProducts = array_values(array_filter($products,function ($p) use ($product){
                if($p->id == $product->id && $p->size == $product->size){
                    return false;
                }
               return  true;
            }));

            if(count($newProducts) == 0)
                session()->remove('products');
            else
                session()->put('products',$newProducts);
            return response()->json(['cartItems'=>$newProducts,'decrease'=>true],200);
        }
        return response()->json(['cartItems'=>$products,'decrease'=>false],Response::HTTP_NOT_FOUND);
    }

    public static function productThatAlreadyExists(&$products,$size,$idProduct)
    {
        if(session()->has('products')){
            $products = session('products');
            foreach ($products as $item)
            {
                if($item->size == $size && $item->id==$idProduct)
                {
                    return $item;
                }
            }
        }

        return false;
    }

    public function addToCart(AddToCartRequest $request)
    {

        if(session()->has('user'))
        {
            $products = [];
            $user = session('user');

            $size = $request->size;
            $quantity = (int)$request->quantity;
            $idProduct = $request->id;


            $sizeId = Size::where('size',$size)->first()->id;

            $productThatAlreadyExists = self::productThatAlreadyExists($products,$size,$idProduct);
            if($productThatAlreadyExists){
                if(!$request->has('changeQuantity')) {
                    $quantity = $productThatAlreadyExists->quantity + $quantity;
                }
            }

            $checkIfPurchasable = Product::with('sizes')->where('id',$idProduct)->whereHas('sizes', function($query)
            use
            ($quantity,$sizeId){
                return $query->where('quantity','<',$quantity)->where('size_id',$sizeId);
            });

            $leftOnStock = 0;

            if($checkIfPurchasable->first() != null)//proizvod koji nije moguce kupiti
            {
                $neededSize = array_values(array_filter($checkIfPurchasable->first()->sizes->toArray(),function ($item) use ($sizeId){
                    return $item['id'] == $sizeId;
                }));

                $leftOnStock = $neededSize[0]['pivot']['quantity'];
            }


            if($checkIfPurchasable->count() == 0)
            {
                if($productThatAlreadyExists) {
                    $productThatAlreadyExists->quantity = $quantity;
                    return response()->json(['cartItems'=>$products,'message'=>'Quantity is changed!',
                        'increase'=>false], 200);
                }
                $p = Product::find($idProduct);

                $product = new \stdClass();
                $product->id = $p->id;
                $product->cover = $p->cover;
                $product->name = $p->name;
                $product->size = $size;
                $product->quantity = $quantity;
                $product->price = $p->current_price;

                $products[] = $product;

                session()->put('products',$products);

                $idActivity = Activity::where('name','Cart')->first()->id;
                $user->activities()->attach($idActivity,['date'=>date('Y-m-d H:i:s',time())]);
                return response()->json(['cartItems'=>$products,'message' => 'Successfully added to cart!','increase'=>true],
                    200);
            }


            return response()->json(['cartItems'=>$products,'message' => "Sorry, you cannot buy that much products, because there is $leftOnStock left on stock!",
                'increase'=>false,'max'=>$leftOnStock],
                200);
        }
       return response()->json(['message'=>"You need to be logged in to be able to add to cart!"],Response::HTTP_FORBIDDEN);
    }
}
