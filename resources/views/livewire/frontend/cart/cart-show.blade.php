<div>
    <div class="py-3 py-md-5 bg-light">
        @if(session('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        @endif
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-5">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total</h4>
                                </div>

                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($cartShow as $cartShowItem)
                        @if($cartShowItem->product)

                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-5 my-auto">
                                    <a href="{{ route('frontend.product.view', [$cartShowItem->product->category->slug, $cartShowItem->product->slug]) }}">
                                        <label class="product-name">
                                            @if($cartShowItem->product->productImages)

                                            <img src="{{ Storage::url($cartShowItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px" alt="{{ $cartShowItem->product->name }}">
                                            @else
                                            <img src="" style="width: 50px; height: 50px" alt="">
                                            @endif
                                            {{ $cartShowItem->product->name }}

                                            @if($cartShowItem->productColor)
                                            @if($cartShowItem->productColor->color)
                                                <span> {{ $cartShowItem->productColor->color->name }}</span>

                                            @endif
                                            @endif
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-1 my-auto">
                                    <label class="price"> ${{ $cartShowItem->product->selling_price }}</label>
                                </div>
                                <div class="col-md-3 col- my-auto">
                                    <div class="quantity">
                                        <div class="input-group">
                                            <button wire:click="decrementQuantity({{$cartShowItem->id}})" wire:loading.attr='disabled' class="btn btn-sm btn1"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="{{ $cartShowItem->quantity }}" class="input-quantity" readonly/>
                                            <button wire:click="incrementQuantity({{$cartShowItem->id}})" wire:loading.attr='disabled' class="btn btn-sm btn1"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 my-auto">
                                    <label class="price"> ${{ $cartShowItem->product->selling_price * $cartShowItem->quantity}}</label>
                                </div>

                                @php
                                    $totalPrice += $cartShowItem->product->selling_price * $cartShowItem->quantity;
                                @endphp
                                <div class="col-md-2 col- my-auto">
                                    <div class="remove">
                                        <button type="button" wire:click='removeCartShowItem({{ $cartShowItem->id }})' class="btn btn-danger btn-sm">
                                            <span wire:loading.remove wire:target='removeCartShowItem({{ $cartShowItem->id }})'>

                                                <i class="fa fa-trash"></i> Remove
                                            </span>
                                            <span wire:loading wire:target='removeCartShowItem({{ $cartShowItem->id }})'>

                                                <i class="fa fa-trash"></i> Removing
                                            </span>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @empty
                        <h3>No Cart found</h3>
                        @endforelse



                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h4>Get the best deal and offers <a href="{{ route('frontend.categories') }}">Shop now</a></h4>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">

                        <h4>
                            Total :
                            <span class="float-end">${{ $totalPrice }}</span>
                        </h4>
                        <hr>
                        <a href="{{ route('checkout') }}" class="btn btn-warning w-100">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
