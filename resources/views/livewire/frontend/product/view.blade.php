<div>
    <div class="py-3 py-md-5 bg-light">

        <div class="container">
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->productImages)


                        <div class="exzoom" id="exzoom">
                            <!-- Images -->
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    @foreach ($product->productImages as $itemImage)

                                    <li><img src="{{ Storage::url($itemImage->image) }}" /></li>
                                    @endforeach
                                    ...
                                </ul>
                            </div>

                            <div class="exzoom_nav"></div>
                            <!-- Nav Buttons -->
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn">
                                    < </a>
                                        <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                        </div>

                        @else
                        <h3>{{ $product->name }} Not Found</h3>
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}

                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $product->category->name }} / {{ $product->name }}
                        </p>
                        <p>{{ $product->brand->name }}</p>
                        <div>
                            <span class="selling-price">${{ $product->selling_price }}
                            </span>
                            <span class="original-price">${{ $product->original_price }}</span>
                        </div>
                        <div>
                            @if($product->productColors->count() > 0)
                            @if($product->productColors)
                            @foreach($product->productColors as $colorItem)

                            <label for="" class="colorSelectionLabel" style="background-color:{{ $colorItem->color->code }}" wire:click='colorSelected({{ $colorItem->id }})'>
                                {{ $colorItem->color->name }}
                            </label>
                            @endforeach
                            @endif
                            <div>
                                @if($this->productSelectedQuantity == 'OutOfStock')
                                <label class="btn-sm mt-2 py-1 bg-danger">Out of Stock</label>
                                @elseif ($this->productSelectedQuantity > 0)
                                <label class="btn-sm mt-2 py-1 bg-success">In Stock</label>
                                @endif
                            </div>
                            @else
                            @if($product->quantity)
                            <label class="btn-sm mt-2 py-1 bg-success">In Stock</label>
                            @else
                            <label class="btn-sm mt-2 py-1 bg-danger">Out of Stock</label>
                            @endif

                            @endif
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click='decrementQuantity'><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model='quantityCount' readonly value="{{ $this->quantityCount }}" class="input-quantity" />
                                <span class="btn btn1" wire:click='incrementQuantity'><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button wire:click='addToCart({{ $product->id }})' class="btn btn1">
                                <span wire:loading.remove wire:target='addToCart({{ $product->id }})'>
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </span>
                                <span wire:loading wire:target='addToCart({{ $product->id }})'>
                                    <i class="fa fa-shopping-cart"></i> Adding
                                </span>
                            </button>
                            <button type="button" wire:click='addToWishList({{ $product->id }})' class="btn btn1">
                                <span wire:loading.remove wire:target='addToWishList'>
                                    <i class="fa fa-heart"></i> Add To Wishlist
                                </span>
                                <span wire:loading wire:target='addToWishList'>
                                    <i class="fa fa-heart"></i> Adding ....
                                </span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {!! $product->small_description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {!! $product->description !!}

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Related
                        @if($category)
                        {{ $category->name }}
                        @endif
                        Products</h4>
                    <div class="underline"></div>
                </div>

                <div class="col-md-12">
                    @if($category)

                    <div class="owl-carousel owl-theme product-carousel">
                        @foreach ($category->relatedproducts as $relatedProduct)
                        <div class="item">

                            <div class="product-card">
                                <div class="product-card-img">

                                    @if($relatedProduct->productImages->count() > 0)
                                    <a href="{{ route('frontend.product.view', [$relatedProduct->category->slug, $relatedProduct->slug]) }}">
                                        <img src="{{ Storage::url($relatedProduct->productImages[0]->image) }}" alt="Laptop" style="min-height: 250px;">
                                    </a>
                                    @endif
                                </div>
                                <div class="product-card-body">
                                    <p class="product-brand">{{ $relatedProduct->brand->name }}</p>
                                    <h5 class="product-name">
                                        <a href="{{ route('frontend.product.view', [$relatedProduct->category->slug, $relatedProduct->slug]) }}">
                                            {{ $relatedProduct->name }}
                                        </a>
                                    </h5>
                                    <div>
                                        <span class="selling-price">{{ $relatedProduct->selling_price }}</span>
                                        <span class="original-price">{{ $relatedProduct->original_price }}</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                        @endforeach
                        @else
                        
                            <div class="p-2">
                                <h4>No Related Product Available</h4>
                            </div>
                       
                        @endif

                    </div>
                </div>
                

                </div>
            </div>
    </div>

            <div class="py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Related
                                @if($product->brand)
                                {{ $product->brand->name }}
                                @endif
                                Products</h4>
                            <div class="underline"></div>
                        </div>


                        <div class="col-md-12">
                            @if($category)

                            <div class="owl-carousel owl-theme product-carousel">
                                @foreach ($category->relatedproducts as $relatedProduct)
                                @if($relatedProduct->brand->name == $product->brand->name)

                                <div class="item">

                                    <div class="product-card">
                                        <div class="product-card-img">

                                            @if($relatedProduct->productImages->count() > 0)
                                            <a href="{{ route('frontend.product.view', [$relatedProduct->category->slug, $relatedProduct->slug]) }}">
                                                <img src="{{ Storage::url($relatedProduct->productImages[0]->image) }}" alt="Laptop" style="min-height: 250px;">
                                            </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $relatedProduct->brand->name }}</p>
                                            <h5 class="product-name">
                                                <a href="{{ route('frontend.product.view', [$relatedProduct->category->slug, $relatedProduct->slug]) }}">
                                                    {{ $relatedProduct->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span class="selling-price">{{ $relatedProduct->selling_price }}</span>
                                                <span class="original-price">{{ $relatedProduct->original_price }}</span>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                @endif
                                @endforeach
                            </div>
                            @else
                            <div class="col-md-12">
                                <div class="p-2">
                                    <h4>No Related Product Available</h4>
                                </div>
                            </div>
                            @endif

                        </div>





                    </div>

                </div>
            </div>


        </div>


        @push('script')
        <script>
            $(function() {

                $("#exzoom").exzoom({

                    // thumbnail nav options
                    "navWidth": 60
                    , "navHeight": 60
                    , "navItemNum": 5
                    , "navItemMargin": 7
                    , "navBorder": 1,

                    // autoplay
                    "autoPlay": false,

                    // autoplay interval in milliseconds
                    "autoPlayTimeout": 2000

                });

            });


            $('.product-carousel').owlCarousel({
                loop: true
                , margin: 10
                , nav: true
                , responsive: {
                    0: {
                        items: 1
                    }
                    , 600: {
                        items: 3
                    }
                    , 1000: {
                        items: 4
                    }
                }
            });

        </script>
        @endpush
