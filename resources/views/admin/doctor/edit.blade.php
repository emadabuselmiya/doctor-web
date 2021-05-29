@extends('layouts.admin')

@section('title', 'Edit Doctor')


@section('content')

    <form action="{{ route('admin.doctors.update', [$doctor->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.doctor._form')
    </form>


@endsection
