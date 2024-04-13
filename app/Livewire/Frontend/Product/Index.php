<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
public $category, $products, $brandInputs = [], $priceInputs;

protected $queryString = [
    'brandInputs' => ['except' => '', 'as' => 'brand'],
    'priceInputs' => ['except' => '', 'as' => 'price']
];
public function mount($category){
$this->category = $category;
}

    
    public function render()
    {
        $this->products = Product::where('category_id', $this->category->id)
        ->when($this->brandInputs, function($q){
            $q->whereIn('brand_id', $this->brandInputs);
        })
        ->when($this->priceInputs, function($q){
            
            $q->when($this->priceInputs == 'high-to-low', function($q2){
                $q2->orderBy('selling_price', 'DESC');
            });

            $q->when($this->priceInputs == 'low-to-high', function($q2){
               $q2->orderBy('selling_price', 'ASC') ;
            });
            
        })
        ->where('status', '0')
        ->get();
        return view('livewire.frontend.product.index',[
            'products' => $this->products,
            'category' => $this->category,
        ]);
    }
}