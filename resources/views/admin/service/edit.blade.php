@extends('layouts.admin')

@section('title', 'Edit Service')


@section('content')

    <form action="{{ route('admin.services.update', [$service->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.service._form')
    </form>


@endsection
