@extends('layouts.admin')

@section('title', 'Edit Gallary')


@section('content')

        {{-- <h1>Edit Product</h1> --}}

        <form action="{{ route('admin.gallaries.update' ,[$gallary->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

           @include('admin.gallary._form')
          </form>


@endsection

