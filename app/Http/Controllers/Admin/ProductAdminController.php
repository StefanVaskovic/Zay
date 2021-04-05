<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductAdminController extends ParentAdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->data['categories'] = Category::all();
        $this->data['brands'] = Brand::all();
        $this->data['genders'] = ['Male','Female'];
        $this->data['sizes'] = Size::all();
    }

    public function index(Request $request)
    {
        $this->data['data'] = Product::getProductsAndPagesAdmin($request);
        return view('admin.examples.products.table',$this->data);
    }

    public function edit($id)
    {
        $this->data['data'] = Product::getProduct($id);
        return view('admin.examples.products.edit',$this->data);
    }

    public function update(UpdateProductRequest $request,$id)
    {
        try {
            $product = Product::find($id);
            $product->name = $request->name;
            $product->current_price = $request->current_price;
            $product->gender = $request->gender;
            $product->description = $request->description;
            $product->color = $request->color;
            $product->category_id = $request->category;
            $product->brand_id = $request->brand;

            $idSizes = Size::select('id')->get();
            /*dd($request->quantitySizes);*/
            $product->sizes()->detach();
            foreach ($request->quantitySizes as $i=>$q)
            {
                $qnt = 0;
                if($q != null)
                    $qnt = $q;

                $product->sizes()->attach($idSizes[$i],['quantity' => $qnt]);
            }

            $product->save();
            return redirect()->back()->with('success','You have successfully updated a product!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','There was an error updating your product');
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);

            $product->sizes()->detach();

            $images = ProductImage::where('product_id',$id)->get();
            Product::deleteAllImages($images);
            Product::deleteCover($product->cover);
            $product->images()->delete();

            $product->delete();

            return redirect()->route('products.index')->with('success','You have successfully deleted a product!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','There was an error deleting your product');
        }
    }

    public function show($id)
    {
        $this->data['data'] = Product::getProduct($id);
        return view('admin.examples.products.single-product',$this->data);
    }

    public function create()
    {

        return view('admin.examples.products.create',$this->data);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $product = new Product();
            $product->name = $request->name;
            $product->current_price = $request->current_price;
            $product->gender = $request->gender;
            $product->description = $request->description;
            $product->color = $request->color;
            $product->category_id = $request->category;
            $product->brand_id = $request->brand;

            $cover = Product::uploadCoverImage($request->cover);
            $product->cover = $cover;

            $product->save();
            $idProduct = Product::latest()->first()->id;


            if($request->images != null) {
                $images = Product::uploadImages($request->images);

                $productImages = [];
                foreach ($images as $image) {
                    $productImage = new ProductImage();
                    $productImage->product_id = $idProduct;
                    $productImage->image = $image;
                    $productImages[] = $productImage;
                }
                $product->images()->saveMany($productImages);
            }


            $idSizes = Size::select('id')->get();
            foreach ($request->quantitySizes as $i=>$q)
            {
                $qnt = 0;
                if($q != null)
                    $qnt = $q;

                $product->sizes()->attach($idSizes[$i],['quantity' => $qnt]);
            }
            return redirect()->back()->with('success','You have successfully inserted a product!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','There was an error inserting your product');
        }

       // The attach() method is only for many-to-many, for other relationships there's save() or saveMany() and
        // associate()
    }
}
