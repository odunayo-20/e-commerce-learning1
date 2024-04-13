@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Category
                        <a href="{{ route('admin.category') }}" class="btn btn-sm btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="">Slug</label>
                                <input type="text" name="slug" value="{{ $category->slug }}" class="form-control">
                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="">Description</label>
                                <textarea name="description" id="" class="form-control" rows="4">{{ $category->description }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control">
                                <img src="{{ asset($category->image) }}" alt="" class="img-fluid w-25 h-50">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="" class="checkbox-label">Status</label>
                                <input type="checkbox" name="status" {{ $category->status == '1' ? 'checked' : '' }} class="form-check-input">

                            </div>
                            <div class="mb-3 col-md-12">
                                <h4> SEO Tags </h4>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="">Meta Title</label>
                                <textarea name="meta_title" id="" class="form-control" rows="4">{{ $category->meta_title }}</textarea>
                                @error('meta_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="">Meta Keyword</label>
                                <textarea name="meta_keyword" id="" class="form-control" rows="4">{{ $category->meta_keyword }}</textarea>
                                @error('meta_keyword')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="">Meta Description</label>
                                <textarea name="meta_description" id="" class="form-control" rows="4">{{ $category->meta_description }}</textarea>
                                @error('meta_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <button type="submit" class="btn btn-primary float-end">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
