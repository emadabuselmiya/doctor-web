@extends('layouts.admin')

@section('title', 'Create Message')



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <x-alerts/>
                        <form action="{{ route('admin.messages.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('admin.message._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
