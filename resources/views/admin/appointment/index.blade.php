@extends('layouts.admin')

@section('title', 'Appointments List')


@section('create')
    <a href="{{ route('admin.appointments.create') }}" class="btn btn-outline-primary mb-3">Create New</a>
@endsection

@section('content')

@section('filtring')
    <form class="form-inline ml-3">
        <div class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="text" name="name" placeholder="Name ..." aria-label="Search"
                    value="{{ $filters['name'] ?? '' }}">
                <div class="input-group-append">

                </div>
            </div>
        </div>

        <div class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="text" name="gender" placeholder="Gender ..." aria-label="Search"
                    value="{{ $filters['gender'] ?? '' }}">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

    </form>

@endsection


{{-- <div class="d-flex justify-content-between py-4">
    <div>
        <a href="{{ route('admin.appointments.create') }}" class="btn btn-success"><i
                class="nav-icon fas fa-plus"></i></a>
    </div>
</div> --}}

<x-alerts />


<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Created At</th>
            <th style="text-align:center;">Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($appointments as $appointment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('admin.appointments.show', $appointment->id) }}">{{ $appointment->name }}</td>
                <td>{{ $appointment->age }}</td>
                <td>{{ $appointment->gender }}</td>
                <td>{{ $appointment->phone }}</td>
                <td>{{ $appointment->email }}</td>
                <td>{{ $appointment->created_at }}</td>

                <td>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('admin.appointments.edit', [$appointment->id]) }}"
                                class="btn btn-primary glyphicon glyphicon-edit"><i class="nav-icon fas fa-edit"></i></a>
                        </div>
                        <div class="col-sm-6">
                            <form class="form-inline" action="{{ route('admin.appointments.destroy', $appointment->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger glyphicon glyphicon-trash"
                                    onclick="return  confirm('Do you want to delete Yes/No')"><i
                                        class="nav-icon fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="11" class="text-center">No Appointments</td>
            </tr>

        @endforelse
    </tbody>
</table>

@endsection
