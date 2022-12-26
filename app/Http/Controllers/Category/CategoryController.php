<?php

namespace App\Http\Controllers\Category;

use App\Models\rc;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
            'image' => 'required|mimes:png,jpeg,gif'
        ]);
        $slug = Str::slug($request->name);

        if ($request->File('image')) {
            if (!storage::disk('public')->exists('images')) {
                Storage::disk('public')->makeDirectory('images');
            }
            $file = $request->file('image');
            $fileName = time() . $file->getClientOriginalName();
            Storage::disk('public')->putFileAs('images', $file, $fileName);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $fileName;
        $category->save();
        toastr()->success('category created successfully!');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function show(rc $rc)
    {
        //)
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
            'image' => 'sometimes|mimes:png,jpeg,gif'
        ]);
        $slug = Str::slug($request->name);
        if ($request->File('image')) {
            if (!storage::disk('public')->exists('images')) {
                Storage::disk('public')->makeDirectory('images');
            }
            $image_path = public_path() . '/storage/images/' . $category->image;
            unlink($image_path);

            $file = $request->file('image');
            $fileName = time() . $file->getClientOriginalName();
            Storage::disk('public')->putFileAs('images', $file, $fileName);
        }

        $category->name = $request->name;
        $category->slug = $slug;
        if (!empty($fileName)) {
            $category->image = $fileName;
        }
        $category->save();
        toastr()->success('category updated successfully!');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->image) {
            $image_path = public_path() . '/storage/images/' . $category->image;
            unlink($image_path);
        }
        toastr()->error('category delete successfully!');
        $category->delete();
        return redirect()->route('categories.index');
    }
}
