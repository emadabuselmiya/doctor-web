@extends('layouts.admin')

@section('title', 'Messages List')


@section('create')
    <a href="{{ route('admin.messages.create') }}" class="btn btn-outline-primary mb-3">Create New</a>
@endsection

@section('content')

@section('filtring')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" name="name" placeholder="Search Name.." aria-label="Search"
                value="{{ $filters['name'] ?? '' }}">

            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

@endsection


{{-- <div class="d-flex justify-content-between py-4">
    <div>
        <a href="{{ route('admin.messages.create') }}" class="btn btn-success"><i
                class="nav-icon fas fa-plus"></i></a>
    </div>
</div> --}}

<x-alerts />


<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            {{-- <th>Message</th> --}}
            <th>Created At</th>
            <th style="text-align:center;">Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($messages as $message)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('admin.messages.show', $message->id) }}">{{ $message->name }}</td>
                <td>{{ $message->phone }}</td>
                <td>{{ $message->email }}</td>
                {{-- <td>
                    <h6 class="desc-of-services">
                        {{ strip_tags($message->message) }}
                    </h6>
                </td> --}}
                <td>{{ $message->created_at }}</td>

                <td>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('admin.messages.edit', [$message->id]) }}"
                                class="btn btn-primary glyphicon glyphicon-edit"><i class="nav-icon fas fa-edit"></i></a>
                        </div>
                        <div class="col-sm-6">
                            <form class="form-inline" action="{{ route('admin.messages.destroy', $message->id) }}"
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
                <td colspan="11" class="text-center">No Messages</td>
            </tr>

        @endforelse
    </tbody>
</table>

@endsection
