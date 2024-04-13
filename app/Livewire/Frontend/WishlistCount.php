<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class WishlistCount extends Component
{
    public $wishlistCount;

    #[On('wishlist-created')]
    #[On('wishlist-deleted')]
    
    public function checkWishlistCount(){
        if(Auth::check()){
            
          return  $this->wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();
        }else{
            return $this->wishlistCount = 0;
        }
    }


    public function mount()
    {
        // Initialize the wishlist count
        $this->wishlistCount = $this->checkWishlistCount();
    }
    public function render()
    {
        $this->wishlistCount = $this->checkWishlistCount();
        return view('livewire.frontend.wishlist-count', [
            
        ]
        );
    }
}