@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Create Category
                        <a href="{{ route('admin.category') }}" class="btn btn-sm btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="">Slug</label>
                                <input type="text" name="slug" class="form-control">
                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="">Description</label>
                                <textarea name="description" id="" class="form-control" rows="4"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="" class="checkbox-label">Status</label>
                                <input type="checkbox" name="status" class="form-check-input">

                            </div>
                            <div class="mb-3 col-md-12">
                                <h4> SEO Tags </h4>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="">Meta Title</label>
                                <textarea name="meta_title" id="" class="form-control" rows="4"></textarea>
                                @error('meta_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="">Meta Keyword</label>
                                <textarea name="meta_keyword" id="" class="form-control" rows="4"></textarea>
                                @error('meta_keyword')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="">Meta Description</label>
                                <textarea name="meta_description" id="" class="form-control" rows="4"></textarea>
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
