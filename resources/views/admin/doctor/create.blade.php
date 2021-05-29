@extends('layouts.admin')

@section('title', 'Create Doctor')



@section('content')

    <form action="{{ route('admin.doctors.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.doctor._form')
    </form>

@endsection
