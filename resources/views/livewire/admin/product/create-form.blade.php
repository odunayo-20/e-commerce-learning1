<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Create Product
                        <a href="{{ route('admin.product') }}" class="btn btn-sm btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent='store'>
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag" type="button" role="tab" aria-controls="seotag" aria-selected="false">SEO Tag</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image" type="button" role="tab" aria-controls="image" aria-selected="false">Product
                                    Images</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="colors-tab" data-bs-toggle="tab" data-bs-target="#colors" type="button" role="tab" aria-controls="colors" aria-selected="false">Product
                                    Colors</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="my-3">
                                    <label for="">Category</label>
                                    <select wire:model.defer="category_id" class="form-control form-control-lg ">
                                        <option value="">--Select Category--</option>
                                        @forelse($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                    <input type="text" wire:model.defer="name" value="{{ old('name') }}" class="form-control">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Product Slug</label>
                                    <input type="text" wire:model.defer="slug" value="{{ old('slug') }}" class="form-control">
                                    @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Brand</label>
                                    <select wire:model.defer="brand_id" class="form-control form-control-lg ">
                                        <option value="">--Select Brand--</option>
                                        @forelse($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                    <textarea wire:model.defer="small_description" id="" class="form-control" rows="4">{{ old('small_description') }}</textarea>
                                    @error('small_description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Description</label>
                                    <textarea wire:model.defer="description" id="" class="form-control" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                            <div class="tab-pane fade border p-3" id="seotag" role="tabpanel" aria-labelledby="seotag-tab">

                                <div class="my-3">
                                    <label for="">Meta Title</label>
                                    <textarea wire:model.defer="meta_title" id="" class="form-control" rows="4">{{ old('meta_title') }}</textarea>
                                    @error('meta_title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Meta Keyword</label>
                                    <textarea wire:model.defer="meta_keyword" id="" class="form-control" rows="4">{{ old('meta_keyword') }}</textarea>
                                    @error('meta_keyword')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Meta Description</label>
                                    <textarea wire:model.defer="meta_description" id="" class="form-control" rows="4">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="my-3">
                                            <label for="">Original Price</label>
                                            <input type="text" wire:model.defer="original_price" class="form-control" value="{{ old('original_price') }}">
                                            @error('original_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="my-3">
                                            <label for="">Selling Price</label>
                                            <input type="text" wire:model.defer="selling_price" class="form-control" value="{{ old('selling_price') }}">
                                            @error('selling_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="my-3">
                                            <label for="">Quanlity</label>
                                            <input type="number" wire:model.defer="quantity" value="{{ old('quantity') }}" class="form-control">
                                            @error('quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label for="" class="checkbox-label">Status</label>
                                            <input type="checkbox" wire:model.defer="status" class="form-check-input">
                                            @error('status')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label for="" class="checkbox-label">Trending</label>
                                            <input type="checkbox" wire:model.defer="trending" class="form-check-input">
                                            @error('trending')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="mb-3">
                                            <label for="" class="checkbox-label">Featured</label>
                                            <input type="checkbox" wire:model.defer="featured" class="form-check-input">
                                            @error('featured')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="tab-pane fade border p-3" id="image" role="tabpanel" aria-labelledby="image-tab">
                                <div class="my-3">
                                    <label for="">Upload Images</label>
                                    <input type="file" wire:model.defer="images" multiple class="form-control">
                                    @if($images)
                                @foreach ($images as $index=> $image)
                                <div class="position-relative d-inline-block ">

                                    <img src="{{ $image->temporaryUrl() }}" alt="" class="img-fluid  rounded"
                                        style="width: 100px; height:100px; position:relativ;">
                                    <span wire:click='cancelImage({{ $index }})' class="btn btn-sm btn-danger d-inline-block "
                                        style='left:70px; position:absolute;'>X</span>
                                </div>

                                @endforeach

                                @endif
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="colors" role="tabpanel" aria-labelledby="colors-tab">
                                <div class="my-3">
                                    <label for="">Select Color</label>
                                    <div class="row">


                                       {{-- @dd($colors) --}}
                                        
                                        @forelse ($colors as $color)
                                    <div class="col-md-3">
                                        <div class="p-2 border mb-2">

                                            Color: <input type="checkbox" value="{{ $color->id }}" wire:model="color[{{ $color->id }}]" multiple class="form-check-input" />
                                            {{ $color->name }} <br>
                                            Quantity: <input type="number" wire:model='color_quantity[{{ $color->id }}]' multiple class="form-control">
                                        </div>
                                    </div>

                                    @empty
                                    <div class="col-md-12">
                                        No Colors Found
                                    </div>
                                    @endforelse
                                    </div>
                                    @error('color')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>


            </div>
        </div>
    </div>
</div>
