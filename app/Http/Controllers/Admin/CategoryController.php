<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

// use Illuminate\Http\Client\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.index');
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
$validated = $request->validate([
'name' => 'required|string',
'slug' => 'required|string',
'description' => 'required|string',
'image' => 'nullable|mimes:png,jpg,jpeg',
'meta_title' => 'required|string|max:255',
'meta_description' => 'required|string',
'meta_keyword' => 'required|string',
]);
        // dd($request->all());
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->description = $request->description;
        $uploadPath = 'uploads/category/';
        if($request->has('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move($uploadPath, $filename);
            $finalImagePathName = $uploadPath .''. $filename;
            $category->image = $finalImagePathName;
        }
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keyword = $request->meta_keyword;
        $category->status = $request->status == true ? '1' : '0';
        $category->save();
        return redirect(route('admin.category'))->with('success', 'Category Successfully Created');

    }

    public function edit(Category $category){

    return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $category){
        $validated = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
            'meta_keyword' => 'required|string',
            ]);

            $category = Category::findOrFail($category);
            $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->description = $request->description;
        $uploadPath = 'uploads/category/';
        if($request->has('image')){
            $path = 'upload/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move($uploadPath, $filename);
            $finalImagePathName = $uploadPath .''. $filename;
            $category->image = $finalImagePathName;
        }
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keyword = $request->meta_keyword;
        $category->status = $request->status == true ? '1' : '0';
        $category->update();
        return redirect(route('admin.category'))->with('success', 'Category Successfully Updated');

        dd('do something');
    }
}