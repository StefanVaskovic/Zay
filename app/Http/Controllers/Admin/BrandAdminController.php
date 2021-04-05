<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandAdminController extends ParentAdminController
{

    public function index()
    {
        $this->data['brands'] = Brand::all();
        return view('admin.examples.brands.index',$this->data);
    }


    public function create()
    {
        //
    }

    public function store(StoreBrandRequest $request)
    {
        try {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->save();

            return redirect()->back()->with('successInsert','You have successfully inserted brand!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errorInsert',$e->getMessage());
        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->data['brand'] = Brand::find($id);
        return view('admin.examples.brands.edit',$this->data);
    }

    public function update(StoreBrandRequest $request, $id)
    {
        try {
            $brand = Brand::find($id);
            $brand->name = $request->name;
            $brand->save();

            return redirect()->back()->with('successUpdate','You have successfully updated brand!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errorUpdate','There was an error updating brand');
        }
    }

    public function destroy($id)
    {
        try {
            $count = DB::table('products')->where('brand_id',$id)->count();
            if($count)
                return redirect()->back()->with('errorDelete','There is products with this category, so you cannot delete it!');

            Brand::destroy([$id]);
            return redirect()->back()->with('successDelete','You have successfully deleted category!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errorDelete','There was an error deleting category!');
        }
    }
}
