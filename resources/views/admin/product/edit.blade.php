@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="">
            @if(session('success'))
<div class="alert alert-primary" role="alert">
    {{ session('success') }}
</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Create Product
                        <a href="{{ route('admin.product') }}" class="btn btn-sm btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag"
                                    type="button" role="tab" aria-controls="seotag" aria-selected="false">SEO
                                    Tag</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details"
                                    type="button" role="tab" aria-controls="details"
                                    aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image"
                                    type="button" role="tab" aria-controls="image" aria-selected="false">Product
                                    Images</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="my-3">
                                    <label for="">Category</label>
                                    <select name="category_id" class="form-control form-control-lg ">
                                        @forelse($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @empty
                                            <option selected>No Category Record</option>
                                        @endforelse
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Product Name</label>
                                    <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Product Slug</label>
                                    <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Brand</label>
                                    <select name="brand_id" class="form-control form-control-lg ">
                                        @forelse($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @empty
                                            <option selected>No Brand Record</option>
                                        @endforelse
                                    </select>
                                    @error('brand_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Small Description (500 words)</label>
                                    <textarea name="small_description" id="" class="form-control" rows="4">{{ $product->small_description }}</textarea>
                                    @error('small_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Description</label>
                                    <textarea name="description" id="" class="form-control" rows="4">{{ $product->description }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                            <div class="tab-pane fade border p-3" id="seotag" role="tabpanel"
                                aria-labelledby="seotag-tab">

                                <div class="my-3">
                                    <label for="">Meta Title</label>
                                    <textarea name="meta_title" id="" class="form-control" rows="4">{{ $product->meta_title }}</textarea>
                                    @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Meta Keyword</label>
                                    <textarea name="meta_keyword" id="" class="form-control" rows="4">{{ $product->meta_keyword }}</textarea>
                                    @error('meta_keyword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Meta Description</label>
                                    <textarea name="meta_description" id="" class="form-control" rows="4">{{ $product->meta_description }}</textarea>
                                    @error('meta_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="details" role="tabpanel"
                                aria-labelledby="details-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="my-3">
                                            <label for="">Original Price</label>
                                            <input type="text" name="original_price" class="form-control"
                                                value="{{ $product->original_price }}">
                                            @error('original_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="my-3">
                                            <label for="">Selling Price</label>
                                            <input type="text" name="selling_price" class="form-control"
                                                value="{{ $product->selling_price }}">
                                            @error('selling_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="my-3">
                                            <label for="">Quanlity</label>
                                            <input type="number" name="quantity" value="{{ $product->quantity }}"
                                                class="form-control">
                                            @error('quantity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label for="" class="checkbox-label">Status</label>
                                            <input type="checkbox" name="status" class="form-check-input"
                                                {{ $product->status == '1' ? 'checked' : '' }}>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label for="" class="checkbox-label">Trending</label>
                                            <input type="checkbox" name="trending" class="form-check-input" {{ $product->trending == '1' ? 'checked' : '' }}>
                                            @error('trending')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label for="" class="checkbox-label">Featured</label>
                                            <input type="checkbox" name="featured" class="form-check-input"
                                                {{ $product->featured == '1' ? 'checked' : '' }}>
                                            @error('featured')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                </div>



                            </div>
                            <div class="tab-pane fade border p-3" id="image" role="tabpanel"
                                aria-labelledby="image-tab">
                                <div class="my-3">
                                    <label for="">Upload Images</label>
                                    <input type="file" name="image[]" multiple class="form-control">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="row">
                                        @if ($product->productImages)
                                            @foreach ($product->productImages as $image)
                                                <div class="col-md-2 position-relative ">
                                                    <img src="{{ asset($image->image) }}" alt=""
                                                        class="img-fluid my-2" style="width: 100px; height:100px;">
                                                    <a href="{{ route('admin.product.delete.image', $image->id) }}" class="position-">remove</a>
                                                </div>
                                            @endforeach
                                        @else
                                            <h3>No Record Found</h3>
                                        @endif
                                    </div>
                                </div>




                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>


            </div>
            {{-- </div> --}}
        </div>
    @endsection
