@extends('layouts.admin')

@section('title', 'Systems Information')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <x-alerts/>
                        <form action="{{ route('admin.contacts.update', 1) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @include('admin.contact._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
