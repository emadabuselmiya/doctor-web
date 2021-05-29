@extends('layouts.admin')

@section('title', 'Create Gallary')



@section('content')

    <form action="{{ route('admin.gallaries.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.gallary._form')
    </form>

@endsection
