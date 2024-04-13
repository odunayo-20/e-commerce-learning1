@extends('layouts.app')

@section('title', 'Home Page')
@section('content')
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">

    <div class="carousel-inner">
        @foreach ($sliders as $key => $sliderItem)

        <div class="carousel-item {{ $key == '0' ? 'active' : '' }}" style="height:400px;">
            @if($sliderItem->image)

            <img src="{{Storage::url($sliderItem->image)}}" class="d-block w-100" alt="..." style="height:500px; object-fit:cover; object-position: 100% 0%">
            @endif
            <div class="carousel-caption d-none d-md-block">
                <div class="custom-carousel-content">
                    <h1>
                        {!! $sliderItem->title !!}
                    </h1>
                    <p>
                        {!! $sliderItem->description !!}
                    </p>
                    <div>
                        <a href="#" class="btn btn-slider">
                            Get Now
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <div class="py-3 bg-light">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8">
                    <h4 class="mb-4 pt-4">Welcome to Fund</h4>
                    <div class="underline"></div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi quis nobis fugit assumenda reprehenderit ea, laboriosam, quisquam reiciendis quidem expedita accusantium molestias ab tempore! Libero provident consequatur eos a temporibus?</p>
                </div>
            </div>
        </div>
    </div>
    <!-- trending start -->
    <div class="py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Trending Products</h4>
                    <div class="underline"></div>
                </div>

                @if($trendingProducts)
                <div class="col-md-12">

                    <div class="owl-carousel owl-theme product-carousel">
                        @foreach ($trendingProducts as $trendingProductItem)
                        <div class="item">

                            <div class="product-card">
                                <div class="product-card-img">
                                    <label class="stock bg-danger">New</label>
                                    @if($trendingProductItem->productImages->count() > 0)
                                    <a href="{{ route('frontend.product.view', [$trendingProductItem->category->slug, $trendingProductItem->slug]) }}">
                                        <img src="{{ Storage::url($trendingProductItem->productImages[0]->image) }}" alt="Laptop" style="min-height: 250px;">
                                    </a>
                                    @endif
                                </div>
                                <div class="product-card-body">
                                    <p class="product-brand">{{ $trendingProductItem->brand->name }}</p>
                                    <h5 class="product-name">
                                        <a href="{{ route('frontend.product.view', [$trendingProductItem->category->slug, $trendingProductItem->slug]) }}">
                                            {{ $trendingProductItem->name }}
                                        </a>
                                    </h5>
                                    <div>
                                        <span class="selling-price">{{ $trendingProductItem->selling_price }}</span>
                                        <span class="original-price">{{ $trendingProductItem->original_price }}</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>

                </div>
                @else
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>No Product Available</h4>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- trending stop -->
    <!-- new arrival start -->
    <div class="py-3 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>New Arrival Products
                        <a href="{{ route('frontend.newArrival') }}" class="btn btn-warning float-end">View More</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>

                @if($newArrivalProducts)
                <div class="col-md-12">

                    <div class="owl-carousel owl-theme product-carousel">
                        @foreach ($newArrivalProducts as $newArrivalProductItem)
                        <div class="item">

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
                        @endforeach
                    </div>

                </div>
                @else
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>No New Arrival Product Available</h4>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- new arrival stop -->
    <!-- Featured start -->
    <div class="py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Featured Products
                        <a href="{{ route('frontend.featuredProducts') }}" class="btn btn-warning float-end">View More</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>

                @if($featuredProducts)
                <div class="col-md-12">

                    <div class="owl-carousel owl-theme product-carousel">
                        @foreach ($featuredProducts as $featuredProductItem)
                        <div class="item">

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
                        @endforeach
                    </div>

                </div>
                @else
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>No Featured Product Available</h4>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- Featured stop -->

</div>
@endsection
@section('script')
<script>
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
@endsection
