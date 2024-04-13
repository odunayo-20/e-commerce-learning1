@extends('layouts.app')

@section('title', 'Featured Product')
@section('content')

<div class="py-3 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Featured Product</h4>
                <div class="underline"></div>
            </div>


            @forelse ($featuredProducts as $featuredProductItem)
            <div class="col-md-4">

                <div class="product-card">
                    <div class="product-card-img">
                        <label class="stock bg-danger">New</label>
                        @if($featuredProductItem->productImages->count() > 0)
                        <a href="{{ route('frontend.product.view', [$featuredProductItem->category->slug, $featuredProductItem->slug]) }}">
                            <img src="{{ Storage::url($featuredProductItem->productImages[0]->image) }}" alt="Laptop" style="min-height: 250px;">
                        </a>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{ $featuredProductItem->brand->name }}</p>
                        <h5 class="product-name">
                            <a href="{{ route('frontend.product.view', [$featuredProductItem->category->slug, $featuredProductItem->slug]) }}">
                                {{ $featuredProductItem->name }}
                            </a>
                        </h5>
                        <div>
                            <span class="selling-price">{{ $featuredProductItem->selling_price }}</span>
                            <span class="original-price">{{ $featuredProductItem->original_price }}</span>
                        </div>

                    </div>
                </div>

            </div>
            @empty
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No Featured Products Available</h4>
                </div>
            </div>

            @endforelse

<div class="text-center">
    <a href="{{ route('frontend.categories') }}" class="btn btn-warning px-3">View More</a>
</div>


        </div>

    </div>
</div>

@endsection
