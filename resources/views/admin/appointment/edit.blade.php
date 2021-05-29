@extends('layouts.admin')

@section('title', 'Edit Appointment')


@section('content')

    <form action="{{ route('admin.appointments.update', [$appointment->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.appointment._form')
    </form>


@endsection
