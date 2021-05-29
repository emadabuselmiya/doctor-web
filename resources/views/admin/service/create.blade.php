@extends('layouts.admin')

@section('title', 'Create Service')



@section('content')

    <form action="{{ route('admin.services.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.service._form')
    </form>

@endsection
