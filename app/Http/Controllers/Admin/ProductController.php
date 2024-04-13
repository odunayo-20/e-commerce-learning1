<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class ProductController extends Controller
{
    use WithPagination;

    public function index()
    {
        // $products = Product::latest()->paginate(10);

        return view('admin.product.index');
    }

    public function create()
    {
        $categories = Category::latest()->where('status', '0')->get();
        $brands = Brand::latest()->where('status', '0')->get();
        $colors = Color::latest()->where('status', '0')->get();

        return view('admin.product.create', compact(['categories', 'brands', 'colors']));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'slug' => 'required|string',
            'small_description' => 'required|string',
            'description' => 'required|string',
            // 'image' => 'nullable|mimes:png,jpg,jpeg',
            'meta_title' => 'required|string',
            'meta_keyword' => 'required|string',
            'meta_description' => 'required|string',
            'original_price' => 'required|integer',
            'selling_price' => 'required|integer',
            'quantity' => 'required|integer',
            'trending' => 'nullable',
            'status' => 'nullable',
        ]);

        $category = Category::findOrFail($request->category_id);

        $product = $category->products()->create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'slug' => Str::slug($request->slug),
            'small_description' => $request->small_description,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'original_price' => $request->original_price,
            'selling_price' => $request->selling_price,
            'quantity' => $request->quantity,
            'trending' => $request->trending == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',

        ]);

        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/Products/';
            foreach ($request->file('image') as $imageFile) {
                // $request->validate(['image' => 'nullable|mimes:png,jpg,jpeg']);
                $ext = $imageFile->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.''.$filename;
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }

        if($request->has('colors')){
            foreach($request->colors as $key => $color){
                // dd($product->productColors());
                $product->productColors()->create([
                    'color_id' => $color,
                    'product_id' => $product->id,
                    'quantity' => $request->color_quantity[$key] ?? 0,
                ]);
            }
        }

        session()->flash('success', 'Product Successfully created');

        return redirect(route('admin.product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('admin.product.edit', compact(['product', 'brands', 'categories']));
    }

    public function update(Request $request, $product)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'slug' => 'required|string',
            'small_description' => 'required|string',
            'description' => 'required|string',
            'meta_title' => 'required|string',
            'meta_keyword' => 'required|string',
            'meta_description' => 'required|string',
            'original_price' => 'required|integer',
            'selling_price' => 'required|integer',
            'quantity' => 'required|integer',
            'trending' => 'nullable',
            'featured' => 'nullable',
            'status' => 'nullable',
        ]);
        $product = Category::findOrFail($request->category_id)->products()->where('id', $product)->first();

        if ($product) {
            # code...
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->slug = Str::slug($request->slug);
            $product->small_description = $request->small_description;
            $product->description = $request->description;
            $product->meta_title = $request->meta_title;
            $product->meta_keyword = $request->meta_keyword;
            $product->meta_description = $request->meta_description;
            $product->original_price = $request->original_price;
            $product->selling_price = $request->selling_price;
            $product->quantity = $request->quantity;
            $product->trending = $request->trending == true ? '1' : '0';
            $product->featured = $request->featured == true ? '1' : '0';
            $product->status = $request->status == true ? '1' : '0';
            $product->update();
            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/Products/';
                foreach ($request->file('image') as $imageFile) {
                    // $request->validate(['image' => 'nullable|mimes:png,jpg,jpeg']);
                    $ext = $imageFile->getClientOriginalExtension();
                    $filename = time().'.'.$ext;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath.''.$filename;
                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }
            session()->flash('success', 'Product Successfully Updated');
            return redirect(route('admin.product'));

        }else{
        session()->flash('error', 'No such product id found');
            return redirect(route('admin.product'));
        }
    }



    public function removeImage( ProductImage $image){
        if(File::exists($image->image)){
            File::delete($image->image);
        }
        $image->delete();
session()->flash('success', 'Image successfully Removed');
            return redirect()->back();
    }
}