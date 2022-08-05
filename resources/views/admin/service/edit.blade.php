@extends('layouts.admin')

@section('title', 'Edit Service')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <x-alerts/>
                        <form action="{{ route('admin.services.update', [$service->id]) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.service._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
