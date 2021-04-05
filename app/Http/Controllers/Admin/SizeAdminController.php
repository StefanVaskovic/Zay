<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSizeRequest;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SizeAdminController extends ParentAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['sizes'] = Size::all();
        return view('admin.examples.sizes.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }


    public function store(StoreSizeRequest $request)
    {
        try {
            $size = new Size();
            $size->size = $request->size;
            $size->save();

            $products = Product::get();

            foreach ($products as $p){
                $p->sizes()->attach($size->id,['quantity'=>0]);
            }

            return redirect()->back()->with('successInsert','You have successfully inserted size!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errorInsert','There was an error inserting size!');
        }
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['size'] = Size::find($id);
        return view('admin.examples.sizes.edit',$this->data);
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
        try {
            $size = Size::find($id);
            $size->size = $request->size;
            $size->save();

            return redirect()->back()->with('successUpdate','You have successfully updated size!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errorUpdate','There was an error updating size!');
        }
    }

    public function destroy($id)
    {
        try {
            $count = DB::table('product_size')->where('size_id',$id)->where('quantity','!=',0)->count();
            if($count)
                return redirect()->back()->with('errorDelete','There is products with this size, so you cannot delete it!');

            DB::table('product_size')->where('size_id',$id)->delete();
            Size::destroy([$id]);
            return redirect()->back()->with('successDelete','You have successfully deleted size!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errorDelete','There was an error deleting size!');
        }
    }
}
