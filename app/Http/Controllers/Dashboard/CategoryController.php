<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;

use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class CategoryController extends Controller
{
    public const PhotoDirect = 'images/categories/';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();
        if($name = $request->name){
            $query->where('name','LIKE',"%{$name}%");
        }
        if($status = $request->status){
            $query->whereStatus($status);
        }

        $categories = $query->withCount([
            'products as products_number' => function($query) {
                $query->where('status', '=', 'active');
            }
        ])->orderBy('categories.name')->paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        // Request merge
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        $Category = Category::create($request->except('image'));

        // Save Image
        if($request->image){
            $fileName = uploadImage('categories', $request->image);
            $Category->image = $fileName;
            $Category->save();
        }


        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('dashboard.categories.index')
                ->with('info', 'Record not found!');
        }

        // SELECT * FROM categories WHERE id <> $id
        // AND (parent_id IS NULL OR parent_id <> $id)
        $parents = Category::where('id', '<>', $id)
            ->where(function($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request,$id)
    {
        $category = Category::findOrFail($id);

        $category->update( $request->except('image') );

        //  Start Change Photo
            if($request->image){

                // delete old Photo
                if($category->image != null){
                    $photo  = public_path( self::PhotoDirect .$category->image);
                    if (File::exists($photo)) {
                        File::delete($photo);
                    }
                }

                $fileName = uploadImage('categories', $request->image);
                $category->image = $fileName;
                $category->save();
            }
        //End Change Photo

        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        //can use this code if category table is not softDelete
//        if($category->image != null){
//            $photo  = public_path(self::PhotoDirect .$category->image);
//            if (File::exists($photo)) {
//                File::delete($photo);
//            }
//        }

        $category->delete();
        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category deleted!');
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));

    }

    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category restored!');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        if($category->image != null){
            $photo  = public_path(self::PhotoDirect .$category->image);
            if (File::exists($photo)) {
                File::delete($photo);
            }
        }
        $category->forceDelete();

        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category deleted forever!');
    }
}
