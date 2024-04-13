<?php

namespace App\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Color;
use Livewire\Component;
use App\Models\Category;
use App\Models\ProductColor;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Livewire\WithFileUploads;

class CreateForm extends Component
{
    use WithFileUploads;
 public $name;
 public $category_id;
 public $brand_id;
 public $slug;
 public $small_description;
 public $description;
 public $meta_title;
 public $images = [];
 public $meta_keyword;
 public $meta_description;
 public $original_price;
 public $selling_price;
 public $quantity;
 public $color_quantity = [];
 public $colors = [];
 public $color = [];
 public $trending;
 public $featured;
 public $status;
//  public $colors = [];

    public function store()
    {
        $validated = $this->validate([
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

        $category = Category::findOrFail($this->category_id);

        $product = $category->products()->create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'slug' => Str::slug($this->slug),
            'small_description' => $this->small_description,
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_keyword' => $this->meta_keyword,
            'meta_description' => $this->meta_description,
            'original_price' => $this->original_price,
            'selling_price' => $this->selling_price,
            'quantity' => $this->quantity,
            'trending' => $this->trending == true ? '1' : '0',
            'featured' => $this->featured == true ? '1' : '0',
            'status' => $this->status == true ? '1' : '0',

        ]);



        if (is_array($this->images)) {
            foreach ($this->images as $image) {
                $result = $image->store('public/uploads/Products/');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $result,
                ]);

            }
        }
        // if(is_array($this->color)){
        //     foreach($this->color as $key => $value){
        //         ProductColor::create([
        //             'product_id' => $product->id,
        //             'color_id' => $value,
        //             'quantity' => $this->color_quantity[$key] ?? 0,
        //         ]);
        //     }
        // }

        if($this->color){
            foreach($this->color as $key => $colorItem){
                // dd($product->productColors());
                $product->productColors()->create([
                    'color_id' => $colorItem,
                    'product_id' => $product->id,
                    'quantity' => $this->color_quantity[$key] ?? 0,
                ]);
            }
        }
        session()->flash('success', 'Product Successfully created');

        return redirect(route('admin.product'));
    }




    public function cancelImage($index)
    {
        unset($this->images[$index]);
    }

    public function render()
    {
        $categories = Category::latest()->where('status', '0')->get();
        $brands = Brand::latest()->where('status', '0')->get();
        // $colors = Color::latest()->where('status', '0')->get();
        return view('livewire.admin.product.create-form', compact(['categories', 'brands']));
    }


    public function mount(){
        $this->colors = Color::latest()->where('status', '0')->get();
    }
}