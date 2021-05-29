@extends('layouts.admin')

@section('title', 'Clients List')


@section('create')
    <a href="{{ route('admin.clients.create') }}" class="btn btn-outline-primary mb-3">Create New</a>
@endsection

@section('content')

@section('filtring')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" name="name" placeholder="Search" aria-label="Search"
                value="{{ $filters['name'] ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

@endsection



<div class="d-flex justify-content-between py-4">
    <div>
        <a href="{{ route('admin.clients.create') }}"
            class="btn btn-success"><i class="nav-icon fas fa-plus"></i></a>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>image</th>
            <th>Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th style="text-align:center;">Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($clients as $client)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><img src="{{ $client->image_url }}" alt="" height="60"></td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->created_at }}</td>
                <td>{{ $client->updated_at }}</td>

                <td>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('admin.clients.edit', $client->id) }}"
                                class="btn btn-primary glyphicon glyphicon-edit"><i class="nav-icon fas fa-edit"></i></a>
                        </div>
                        <div class="col-sm-6">
                            <form class="form-inline" action="{{ route('admin.clients.destroy', $client->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger glyphicon glyphicon-trash"
                                    onclick="return  confirm('Do you want to Delete? Yes/No')"><i
                                        class="nav-icon fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </td>

            </tr>

        @empty
            <tr>
                <td colspan="11" class="text-center">No Clients</td>
            </tr>

        @endforelse
    </tbody>
</table>

@endsection
