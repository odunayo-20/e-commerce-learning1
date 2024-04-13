<?php

namespace App\Livewire\Frontend\Checkout;

use App\Mail\PlaceOrderMailable;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class CheckoutShow extends Component
{
    public $fullname;

    public $email;

    public $pincode;

    public $address;

    public $phone;

    public $payment_id = null;
    public $payment_mode = null;
    public $carts = [];

    public $totalProductAmount = 0;

    public function placeOrder()
    {
        $this->validate([
            'fullname' => 'required|string|max:122',
            'email' => 'required|email|max:122',
            'pincode' => 'required|string|max:6|min:6',
            'phone' => 'required|string|max:11|min:10',
            'address' => 'required|string|max:500',
        ]);

        // dd($this->all());

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'E-com-'.Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'pincode' => $this->pincode,
            'status_message' => 'in Process',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);


        foreach($this->carts as $cartItem){
            OrderItem::create([
               'order_id' => $order->id,
               'product_id' => $cartItem->product_id,
               'product_color_id' => $cartItem->product_color_id,
               'quantity' => $cartItem->quantity,
               'price' => $cartItem->product->selling_price,
                
            ]);

        }
        return $order;
    }

    public function codOrder()
    {
        $this->payment_mode = "Cash on Delivery";
        $codOrder = $this->placeOrder();
        if ($codOrder) {
            Cart::where('user_id', auth()->user()->id)->delete();

            try {
                //code...
                $order = Order::findOrFail($codOrder->id);
                Mail::to($order->email)->send(new PlaceOrderMailable($order));
            } catch (\Throwable $th) {
                //throw $th;
            }
            session()->flash('message', 'Order Place Successfully');
            $this->dispatch('order-placed');
            return redirect(route('frontend.thank-you'));
        } else {
            session()->flash('message', 'Something went wrong');
        }

    }

    public function totalProductAmount()
    {
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();

        foreach ($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }

        return $this->totalProductAmount;
    }

    public function mount()
    {
        $this->totalProductAmount = $this->totalProductAmount();

        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function render()
    {

        return view('livewire.frontend.checkout.checkout-show');
    }
}