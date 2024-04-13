<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $product;

    public $quantityCount = 1;

    public $category;

    public $productSelectedQuantity;

    public $productColorId;

    public function incrementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function colorSelected($productColorItem)
    {
        $this->productColorId = $productColorItem;
        $productColor = $this->product->productColors()->where('id', $productColorItem)->first();
        $this->productSelectedQuantity = $productColor->quantity;

        if ($this->productSelectedQuantity == 0) {
            $this->productSelectedQuantity = 'OutOfStock';
        }
    }

    public function addToCart($productId)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $productId)->where('status', '0')->exists()) {
                //Check for product color quantity and add to cart
                if ($this->product->productColors()->count() > 1) {

                    if ($this->productSelectedQuantity != null) {

                        if (Cart::where('user_id', auth()->user()->id)
                            ->where('product_id', $productId)
                            ->where('product_color_id', $this->productColorId)
                            ->exists()) {
                            session()->flash('message', 'Product Already Added');

                            return false;
                        } else {

                            $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                            if ($productColor->quantity > 0) {
                                if ($productColor->quantity > $this->quantityCount) {
                                    // insert to cart with product color
                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount,
                                    ]);
                                    session()->flash('message', 'Product Successfully Added to cart');
                                    $this->dispatch('cart-created');
                                } else {
                                    session()->flash('message', 'Only'.' '.$productColor->quantity.' '.'Quantity Avaliable');

                                    return false;
                                }
                            } else {
                                session()->flash('message', 'Out of Stock');

                                return false;
                            }
                        }
                    } else {
                        session()->flash('message', 'Select your product color');

                        return false;
                    }
                } else {

                    if (Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                        session()->flash('message', 'Product Already Added');

                        return false;
                    } else {

                        if ($this->product->quantity > 0) {
                            if ($this->product->quantity > $this->quantityCount) {
                                // insert to cart without product color

                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount,
                                ]);
                                session()->flash('message', 'Product Successfully Added to cart');
                                $this->dispatch('cart-created');
                            } else {
                                session()->flash('message', 'Only'.' '.$this->product->quantity.' '.'Avaliable');

                                return false;
                            }
                        }
                    }
                }

            } else {
                session()->flash('message', "Product doesn't exist");

                return false;
            }
        } else {
            session()->flash('message', 'Please login to add to cart');

            return false;
        }
    }

    public function addToWishList($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('product_id', $productId)->where('user_id', auth()->user()->id)->exists()) {
                session()->flash('message', 'Wishlist Already Added');

                return false;
            } else {
                $wishlistAddedUpdated = Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId,
                ]);
                $this->dispatch('wishlist-created', $wishlistAddedUpdated);

                session()->flash('message', 'Wishlist Successfully Added');
            }
        } else {
            session()->flash('message', 'Please Login');
            $this->dispatch('message', [
                'text' => 'Please Login to continue',
                'type' => 'warning',
                'status' => 401,
            ]);

            return false;

        }
    }

    public function mount($product, $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.frontend.product.view',
            [
                'category' => $this->category,
                'product' => $this->product,
            ]);
    }
}