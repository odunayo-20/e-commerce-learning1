@extends('layouts.app')

@section('title', 'Home Page')
@section('content')


<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">

                <div class="col-md-10">
                    <h4>User Profile
                        <a href="{{ route('frontend.password') }}" class="btn btn-warning float-end">Change Password ?</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>
                
                <div class="col-md-10">
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h4 class="text-white mb-0">
                                User Details
                            </h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('frontend.profile.store') }}" method="post" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Username</label>
                                            <input type="text" name="username" class="form-control" value="{{ Auth::user()->name ?? ''}}"/>
                                            @error('username')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Email</label>
                                            <input type="text" name="email" class="form-control" readonly value="{{ Auth::user()->email }}" />
                                            @error('email')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Phone</label>
                                            <input type="text" name="phone" class="form-control" value="{{ Auth::user()->userDetail->phone ?? '' }}" />
                                            @error('phone')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Zip/Pin Code</label>
                                            <input type="text" name="pin_code" class="form-control"  value="{{ Auth::user()->userDetail->pin_code ?? '' }}" autocomplete="off"/>
                                            @error('pin_code')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Address</label>
                                            <textarea name="address" class="form-control" id="" rows="4">{{ Auth::user()->userDetail->address ?? '' }}</textarea>
                                            @error('address')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>


        </div>
    </div>
</div>

@endsection
