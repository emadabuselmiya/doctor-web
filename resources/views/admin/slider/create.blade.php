@extends('layouts.admin')

@section('title', 'Create Slider')



@section('content')

    <form action="{{ route('admin.sliders.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.slider._form')
    </form>

@endsection
