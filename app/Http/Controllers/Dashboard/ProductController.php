<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const PhotoDirect = 'images/products/';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();
        if($name = $request->name){
            $query->where('name','LIKE',"%{$name}%");
        }
        if($status = $request->status){
            $query->whereStatus($status);
        }
        $products = $query->paginate(PAGINATION_COUNT);
         // $products = Product::paginate(PAGINATION_COUNT);

        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrfail($id);
        $categories = Category::all();
        return view('dashboard.products.edit', compact('categories', 'product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request,$id)
    {
        $product = Product::findOrFail($id);

        $product->update( $request->except('image','tags') );

        //  Start save tags
        $tags = json_decode($request->post('tags'));
        $tag_ids = [];

        $saved_tags = Tag::all();

        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = $saved_tags->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }
        $product->tags()->sync($tag_ids);
        //End save tags

        //  Start Change Photo
        if($request->image){

            // delete old Photo
            if($product->image != null){
                $photo  = public_path( self::PhotoDirect .$product->image);
                if (File::exists($photo)) {
                    File::delete($photo);
                }
            }

            $fileName = uploadImage('products', $request->image);
            $product->image = $fileName;
            $product->save();
        }
        //End Change Photo



        return Redirect::route('dashboard.products.index')
            ->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
