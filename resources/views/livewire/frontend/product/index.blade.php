<div class="row">
    <div class="col-md-12">
        <h4 class="mb-4">Our Products</h4>
    </div>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4>Brands</h4>
            </div>

            @if($category->brands)

            <div class="card-body">
                @forelse ($category->brands as $brandItem )
                <label for="" class="form-check-label">

                    <input type="checkbox" class="form-check-input " wire:model.live='brandInputs' value="{{ $brandItem->id }}">{{ $brandItem->name }}
                </label>
                @empty

                @endforelse
            </div>
            @endif
        </div>
        {{-- price start --}}
        <div class="card my-3">
            <div class="card-header">
                <h4>Price</h4>
            </div>


            <div class="card-body">
                <label for="" class="form-check-label">
                    <input type="radio" name="priceSort" class="form-radio-input " wire:model.live='priceInputs' value="high-to-low">High to Low
                </label>
                <label for="" class="form-check-label">
                    <input type="radio" name="priceSort" class="form-radio-input " wire:model.live='priceInputs' value="low-to-high">Low to High
                </label>
            </div>
        </div>
        {{-- price end --}}
    </div>
    <div class="col-md-9">
        <div class="row">

            @forelse ($products as $productItem)

            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-card-img">
                        <label class="stock bg-success">In Stock</label>
                        @if($productItem->productImages->count() > 0)
                        <a href="{{ route('frontend.product.view', [$productItem->category->slug, $productItem->slug]) }}">
                        <img src="{{ Storage::url($productItem->productImages[0]->image) }}" alt="Laptop" style="height: min-height:250px;"/>
                        </a>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{ $productItem->brand->name }}</p>
                        <h5 class="product-name">
                           <a href="{{ route('frontend.product.view', [$productItem->category->slug, $productItem->slug]) }}">
                            {{ $productItem->name }}
                           </a>
                        </h5>
                        <div>
                            <span class="selling-price">{{ $productItem->selling_price }}</span>
                            <span class="original-price">{{ $productItem->original_price }}</span>
                        </div>

                    </div>
                </div>
            </div>
            @empty
                <h4>No Record {{ $category->name }}</h4>
            @endforelse
        </div>
    </div>
</div>


</div>
