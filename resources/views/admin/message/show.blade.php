@extends('layouts.admin')

@section('title', 'Details Message')


@section('content')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" disabled
            value="{{ $message->name }}">

    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Phone</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" disabled
            value="{{ $message->phone }}">

    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" disabled
            value="{{ $message->email }}">

    </div>

    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea type="text" class="form-control @error('message') is-invalid @enderror" rows="5" disabled
            name="message">{{ $message->message }}</textarea>


    </div>


@endsection
