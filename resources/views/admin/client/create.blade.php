@extends('layouts.admin')

@section('title', 'Create Client')



@section('content')

    <form action="{{ route('admin.clients.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.client._form')
    </form>

@endsection
