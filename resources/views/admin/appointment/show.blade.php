@extends('layouts.admin')

@section('title', 'Detials Appointment')


@section('content')

<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" disabled name="name"
        value="{{ old('name', $appointment->name) }}">

    @error('name')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="age" class="form-label">Age</label>
    <input type="text" class="form-control @error('age') is-invalid @enderror" disabled name="age"
        value="{{ $appointment->age }}">

</div>

<div class="mb-3">
    <label for="gender" class="form-label">Gender</label>
    <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender" disabled>
        @foreach ($genders as $item)
            <option value="{{ $item }}" @if($item == old('parent_id', $appointment->gender)) selected @endif>{{ $item }}</option>
        @endforeach
    </select>



</div>

<div class="mb-3">
    <label for="name" class="form-label">Phone</label>
    <input type="text" class="form-control @error('phone') is-invalid @enderror" disabled name="phone"
        value="{{ $appointment->phone }}">

    @error('phone')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control @error('email') is-invalid @enderror" disabled name="email"
        value="{{ $appointment->email }}">


</div>

<div class="mb-3">
    <label for="resone" class="form-label">Visit Resone</label>
    <textarea type="text" class="form-control @error('resone') is-invalid @enderror" disabled
        name="resone">{{  $appointment->resone }}</textarea>


</div>

@endsection
