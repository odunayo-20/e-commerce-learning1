<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $product_id;

    public function deleteProduct($product_id){
$this->product_id = $product_id;
    }

    public function destroyProduct(){
        // dd('do something');
        $product = Product::findOrFail($this->product_id);
        if($product->productImages){
            foreach($product->productImages as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }

            $product->delete();
            session()->flash('success', 'Product Successfully Deleted');
            $this->dispatch('close-modal');
        }
    }
    public function render()
    {
        $products = Product::latest()->paginate(10);
        return view('livewire.admin.product.index', compact('products'));
    }
}