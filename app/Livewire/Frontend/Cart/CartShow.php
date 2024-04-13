<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $totalPrice = 0;

    public function removeCartShowItem(int $cartId)
    {
        Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->delete();
        session()->flash('message', 'Cart Successfully Removed');
        $this->dispatch('cart-deleted');
    }

    public function incrementQuantity(int $cartId)
    {
        // if($this->quantityCount < 10){

        //     $this->quantityCount++;
        // }

        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($productColor->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    session()->flash('message', 'Cart Quantity Successfully Updated');
                }
            } else {

                if ($cartData->product->quantity > $cartData->quantity) {

                    $cartData->increment('quantity');
                    session()->flash('message', 'Cart Quantity Successfully Updated');
                }else{
                    session()->flash('message', 'Only'  . ' ' .$cartData->product->quantity. ' '. 'Quantity is Availiable');   
                }
            }
        } else {
            session()->flash('message', 'Something Happened');

            return false;
        }
    }

    public function decrementQuantity(int $cartId)
    {
        // if()
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if($cartData->quantity > 1){
                
                $cartData->decrement('quantity');
                session()->flash('message', 'Cart Quantity Successfully Updated');
            }else{
                session()->flash('message','This' .' ' .$cartData->product->name. 'Quantity Should not be less than 1');
            }
        } else {
            session()->flash('message', 'Something Happened');

            return false;
        }
    }

    public function render()
    {
        $cartShow = Cart::where('user_id', auth()->user()->id)->get();

        return view('livewire.frontend.cart.cart-show', compact('cartShow'));
    }
}