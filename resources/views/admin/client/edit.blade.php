@extends('layouts.admin')

@section('title', 'Edit Client')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <x-alerts/>
                        <form action="{{ route('admin.clients.update', $client->id) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.client._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
