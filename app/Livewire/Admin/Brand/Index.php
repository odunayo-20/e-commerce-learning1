<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
use WithPagination;
    public $name, $slug, $status, $brand, $category;

public function storeBrand(){
$validated = $this->validate(
    [
        'category' => 'required|integer',
        'name' => 'required|string',
        'slug' => 'required|string',
    ]
);
Brand::create([
    'category_id' => $this->category,
    'name' => $this->name,
    'slug' => Str::slug($this->slug),
    'status' => $this->status === true ? '1' : '0' ,
]);

$this->reset();
session()->flash('success', 'Brand Successfully Created');
$this->dispatch('close-modal');

}

public function editBrand(Brand $brand){
    $this->brand = $brand;
    $this->category = $brand->category_id;
    $this->name = $brand->name;
    $this->slug = $brand->slug;
    $this->status = $brand->status == '1' ? true : false ;
}

public function updateBrand(){
    $this->brand->update([
        'category_id' => $this->category,
        'name' => $this->name,
        'slug' => Str::slug($this->slug),
        'status' => $this->status === true ? '1' : '0' ,
    ]);

    $this->reset();
    session()->flash('success', 'Brand Successfully Edited');
    $this->dispatch('close-modal');
    }

    public function deleteBrand($brand){
        $this->brand = $brand;
    }

    public function destroyBrand(){
        Brand::findOrFail($this->brand)->delete();
        session()->flash('success', 'Brand Successfully Deleted');
        $this->reset();
        $this->dispatch('close-modal');

    }
    public function render()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->paginate(10);
        return view('livewire.admin.brand.index', compact(['brands', 'categories']))
        ->extends('layouts.admin')
        ->section('content');
    }
}