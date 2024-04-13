<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCount extends Component
{
    public $cartCount;
    #[On('cart-created')]
    #[On('cart-deleted')]
    #[On('order-placed')]
    public function mount(){
        if(Auth::check()){
            
            $this->cartCount = Cart::where('user_id', auth()->user()->id)->count();
        }else{
            return $this->cartCount = 0;
        }
    }
    public function render()
    {
        return view('livewire.frontend.cart-count');
    }
}