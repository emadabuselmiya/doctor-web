@extends('layouts.admin')

@section('title', 'Edit Slider')


@section('content')

        {{-- <h1>Edit Product</h1> --}}

        <form action="{{ route('admin.sliders.update' ,[$slider->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

           @include('admin.slider._form')
          </form>


@endsection

