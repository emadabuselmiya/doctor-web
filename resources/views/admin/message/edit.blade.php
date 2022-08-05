@extends('layouts.admin')

@section('title', 'Edit Message')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <x-alerts/>
                        <form action="{{ route('admin.messages.update', [$message->id]) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.message._form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
