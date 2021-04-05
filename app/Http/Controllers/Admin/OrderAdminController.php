<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderAdminController extends ParentAdminController
{

    public function index()
    {
        $this->data['orders'] = Order::with('user','orderDetails')->get();
        return view('admin.examples.orders.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $this->data['order'] = Order::with('user','orderDetails')->find($id);

        return view('admin.examples.orders.show',$this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        try {
            $order = Order::find($id);
            $order->orderDetails()->detach();
            $order->delete();
            return redirect()->back()->with('success','You have successfully deleted an order!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','There was an error deleting an order!');
        }
    }
}
