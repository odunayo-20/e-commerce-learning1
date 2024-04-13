<?php

namespace App\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{
    public function removeWishlistItem(int $wishlistItem)
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->where('id', $wishlistItem)->delete();
        session()->flash('message', 'Wishlist Successfully Removed');
        $this->dispatch('wishlist-deleted', $wishlist);
    }

    public function render()
    {
        $wishlistShow = Wishlist::where('user_id', auth()->user()->id)->get();

        return view('livewire.frontend.wishlist-show', compact(['wishlistShow']));
    }
}
