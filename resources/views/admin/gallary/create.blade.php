@extends('layouts.admin')

@section('title', 'Create Gallary')



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <x-alerts/>

                        <form action="{{ route('admin.gallaries.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('admin.gallary._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
