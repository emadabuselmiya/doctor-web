@extends('layouts.admin')

@section('title', 'Create Appointment')



@section('content')

    <form action="{{ route('admin.appointments.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.appointment._form')
    </form>

@endsection
