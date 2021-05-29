@if ($errors->any())
    <div class="alert alert-danger">
        Error
    </div>
@endif


<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        value="{{ old('name', $appointment->name) }}">

    @error('name')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="age" class="form-label">Age</label>
    <input type="text" class="form-control @error('age') is-invalid @enderror" id="age" name="age"
        value="{{ old('age', $appointment->age) }}">

    @error('age')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="gender" class="form-label">Gender</label>
    <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender">
        @foreach ($genders as $item)
            <option value="{{ $item }}" @if($item == old('parent_id', $appointment->gender)) selected @endif>{{ $item }}</option>
        @endforeach
    </select>

    @error('gender')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror

</div>

<div class="mb-3">
    <label for="name" class="form-label">Phone</label>
    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
        value="{{ old('phone', $appointment->phone) }}">

    @error('phone')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
        value="{{ old('email', $appointment->email) }}">

    @error('email')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="resone" class="form-label">Visit Resone</label>
    <textarea type="text" class="form-control @error('resone') is-invalid @enderror"
        name="resone">{{ old('resone', $appointment->resone) }}</textarea>

    @error('resone')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<script>
    CKEDITOR.replace( 'resone' );
</script>




<button type="submit" class="btn btn-primary">Save</button>
