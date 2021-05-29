@extends('layouts.admin')

@section('title', 'Systems Information')

@section('content')

    <form action="{{ route('admin.contacts.update', 1) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.contact._form')
    </form>

@endsection
