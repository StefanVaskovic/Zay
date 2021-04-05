<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;

class CategoryAdminController extends ParentAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['categories'] = Category::all();
        return view('admin.examples.categories.index',$this->data);
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
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->save();

            return redirect()->back()->with('successInsert','You have successfully inserted category!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errorInsert',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $this->data['category'] = Category::find($id);
        return view('admin.examples.categories.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, $id)
    {
        try {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->save();

            return redirect()->back()->with('successUpdate','You have successfully updated category!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errorUpdate','There was an error updating category');
        }
    }


    public function destroy($id)
    {
        try {
            $count = DB::table('products')->where('category_id',$id)->count();
            if($count)
                return redirect()->back()->with('errorDelete','There is products with this category, so you cannot delete it!');

            Category::destroy([$id]);
            return redirect()->back()->with('successDelete','You have successfully deleted category!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errorDelete','There was an error deleting category!');
        }
    }
}
