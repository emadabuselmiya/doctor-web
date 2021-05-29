@extends('layouts.admin')

@section('title', 'Edit Message')


@section('content')

    <form action="{{ route('admin.messages.update', [$message->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.message._form')
    </form>


@endsection
