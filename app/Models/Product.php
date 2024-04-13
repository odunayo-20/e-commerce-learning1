<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

public function category(){
    return $this->belongsTo(Category::class, 'category_id','id');
}

public function brand(){
return $this->belongsTo(Brand::class, 'brand_id', 'id');
}
public function productImages(){
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function productColors(){
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }
}