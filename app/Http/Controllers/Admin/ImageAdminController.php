<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImagesRequest;
use App\Http\Requests\UpdateCoverRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageAdminController extends Controller
{
    public function deleteImage($id)
    {
        $productImage = ProductImage::find($id);
        $image = $productImage->image;
        $productImage->delete();

        Product::deleteImage($image);

        return redirect()->back();
    }

    public function changeCover(UpdateCoverRequest $request,$id)
    {
        try {
            $product = Product::find($id);
            $cover = $product->cover;
            Storage::disk('public')->delete('/products/cover/'.$cover);


            $coverName = Product::uploadCoverImage($request->cover);
            $product->cover = $coverName;
            $product->save();

            return redirect()->back()->with('coverSuccess','Successfuly changed cover image!');
        }
        catch (\PDOException $e)
        {
            return redirect()->back()->with('message',$e->getMessage());
        }
    }

    public function addImages(StoreImagesRequest $request,$id)
    {
        try {
            $product = Product::find($id);
            $images = Product::uploadImages($request->images);

            $productImages = [];
            foreach ($images as $image)
            {
                $productImage = new ProductImage();
                $productImage->product_id = $id;
                $productImage->image = $image;
                $productImages[] = $productImage;
            }

            $product->images()->saveMany($productImages);

            return redirect()->back()->with('imagesSuccess','Successfuly added image(s)!');
        }catch (\PDOException $e)
        {
            return redirect()->back()->with('message',$e->getMessage());
        }
    }

    public function deleteAllImages($id)
    {
        try {
            $query = ProductImage::where('product_id',$id);
            $images = $query->select('image')->get();
            $query->delete();
            Product::deleteAllImages($images);

            return redirect()->back()->with('imagesDeletionSuccess','Successfuly deleted all images!');
        }catch (\PDOException $e)
        {
            return redirect()->back()->with('message',$e->getMessage());
        }
    }

}
