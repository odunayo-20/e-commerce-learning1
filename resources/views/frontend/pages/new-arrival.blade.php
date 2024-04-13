@extends('layouts.app')

@section('title', 'New Arrival Product')
@section('content')

<div class="py-3 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>New Arrival Products</h4>
                <div class="underline"></div>
            </div>


            @forelse ($newArrivalProducts as $newArrivalProductItem)
            <div class="col-md-4">

                <div class="product-card">
                    <div class="product-card-img">
                        <label class="stock bg-danger">New</label>
                        @if($newArrivalProductItem->productImages->count() > 0)
                        <a href="{{ route('frontend.product.view', [$newArrivalProductItem->category->slug, $newArrivalProductItem->slug]) }}">
                            <img src="{{ Storage::url($newArrivalProductItem->productImages[0]->image) }}" alt="Laptop" style="min-height: 250px;">
                        </a>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{ $newArrivalProductItem->brand->name }}</p>
                        <h5 class="product-name">
                            <a href="{{ route('frontend.product.view', [$newArrivalProductItem->category->slug, $newArrivalProductItem->slug]) }}">
                                {{ $newArrivalProductItem->name }}
                            </a>
                        </h5>
                        <div>
                            <span class="selling-price">{{ $newArrivalProductItem->selling_price }}</span>
                            <span class="original-price">{{ $newArrivalProductItem->original_price }}</span>
                        </div>

                    </div>
                </div>

            </div>
            @empty
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No Product Available</h4>
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
