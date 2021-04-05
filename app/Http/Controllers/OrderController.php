<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetOrderDetailsRequest;
use App\Models\Activity;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function show(GetOrderDetailsRequest $request)
    {
        try {
            $orders = Order::with('orderDetails')->where('id',$request->idOrder)->get();

            return response()->json(['orders'=>$orders],
                Response::HTTP_ACCEPTED);
        }
        catch (\PDOException $e)
        {
            return response()->json(['message'=>$e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store()
    {

        if(session()->has('products')){
            $user = session('user');
            DB::beginTransaction();
            try {
                $sumPrice = 0;
                $products = session('products');

                foreach ($products as $p)
                {
                    $sumPrice += $p->price * $p->quantity;
                }

                $order = new Order();
                $order->sumPrice = $sumPrice;
                $order->user_id = session('user')->id;
                $order->date = date('Y-m-d H:i:s',time());
                $order->save();



                foreach ($products as $p)
                {
                    $product = Product::find($p->id);
                    $query = $product->sizes()->where('size',$p->size);
                    $productSize = $query->first();
                    $currentQuantityForSpecificSize = $productSize->pivot->quantity;

                    $query->update(['quantity'=>$currentQuantityForSpecificSize - $p->quantity]);
                    $order->orderDetails()->attach($p->id,['quantity'=>$p->quantity,'price'=>$p->price *
                        $p->quantity,'size'=>$p->size]);
                }

                $idActivity = Activity::where('name','Order')->first()->id;
                $user->activities()->attach($idActivity,['date'=>date('Y-m-d H:i:s',time())]);
                session()->remove('products');

                DB::commit();

                return response()->json(['message'=>'You have successfully made an order!'],
                    Response::HTTP_ACCEPTED);
            }
            catch (\PDOException $e)
            {
                DB::rollBack();
                return response()->json(['message'=>$e->getMessage()],
                    Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

    }
}
