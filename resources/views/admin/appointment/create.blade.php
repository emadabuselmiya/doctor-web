@extends('layouts.admin')

@section('title', 'Create Appointment')



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <x-alerts/>
                        <form action="{{ route('admin.appointments.store') }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @include('admin.appointment._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
