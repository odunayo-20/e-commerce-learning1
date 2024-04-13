@extends('layouts.app')

@section('title', 'Search Product')
@section('content')

<div class="py-3 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Search Results</h4>
                <div class="underline"></div>
            </div>


            @forelse ($searchProducts as $searchProductItem)
            <div class="col-md-10">

                <div class="product-card">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="product-card-img">
                                <label class="stock bg-danger">New</label>
                                @if($searchProductItem->productImages->count() > 0)
                                <a href="{{ route('frontend.product.view', [$searchProductItem->category->slug, $searchProductItem->slug]) }}">
                                    <img src="{{ Storage::url($searchProductItem->productImages[0]->image) }}" alt="Laptop" style="min-height: 250px;">
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="product-card-body">
                                <p class="product-brand">{{ $searchProductItem->brand->name }}</p>
                                <h5 class="product-name">
                                    <a href="{{ route('frontend.product.view', [$searchProductItem->category->slug, $searchProductItem->slug]) }}">
                                        {{ $searchProductItem->name }}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">{{ $searchProductItem->selling_price }}</span>
                                    <span class="original-price">{{ $searchProductItem->original_price }}</span>
                                </div>
                                <p style="height: 45px; overflow:hidden">
                                    <b>Description:</b> {{ $searchProductItem->description }}
                                </p>
                         
                                <a href="{{ route('frontend.product.view', [$searchProductItem->category->slug, $searchProductItem->slug]) }}" class="btn btn-outline-primary">
                                    View
                                </a>
                            </div>

                        </div>

                    </div>


                </div>

            </div>
            @empty
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No Such Product Available</h4>
                </div>
            </div>

            @endforelse
<div>
    {{ $searchProducts->appends(request()->input())->links() }}
</div>
            <div class="text-center">
                <a href="{{ route('frontend.categories') }}" class="btn btn-warning px-3">View More</a>
            </div>


        </div>

    </div>
</div>

@endsection
