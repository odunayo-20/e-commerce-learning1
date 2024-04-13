@extends('layouts.app')

@section('title')
    {{-- {{ $category->meta_title }} --}}
@endsection
@section('meta_description')
    {{-- {{ $category->meta_description }} --}}
@endsection
@section('meta_keyword')
    {{-- {{ $category->meta_keyword }} --}}
@endsection

@section('content')
<div class="py-3 py-md-5 bg-light">
    <div class="container">
     <livewire:frontend.checkout.checkout-show>
    </div>
</div>


@endsection
