@extends('layouts.admin')

@section('title', 'Edit Client')


@section('content')

    <form action="{{ route('admin.clients.update', $client->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.client._form')
    </form>


@endsection
