<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('record created successfully');
        $subCategories = Category::where('parent_id', '!=', 0)->get();
        return view('categories.sub_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('categories.sub_categories.create', compact('categories'));
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
            if (!storage::disk('public')->exists('subcategory')) {
                Storage::disk('public')->makeDirectory('subcategory');
            }
            $file = $request->file('image');
            $fileName = time().$file->getClientOriginalName();
            Storage::disk('public')->putFileAs('subcategory', $file, $fileName);
        }

        $subcategory = new SubCategory();
        $subcategory->name = $request->name;
        $subcategory->slug = $slug;
        $subcategory->image = $fileName;
        $subcategory->parent_id = $request->parent_id;
        $subcategory->save();
        toastr()->success('subcategory created successfully!');
        return redirect()->route('subcategory.index');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
