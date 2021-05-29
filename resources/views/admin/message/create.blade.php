@extends('layouts.admin')

@section('title', 'Create Message')



@section('content')

    <form action="{{ route('admin.messages.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.message._form')
    </form>

@endsection
