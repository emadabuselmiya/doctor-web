@if ($errors->any())
    <div class="alert alert-danger">
        Error
    </div>
@endif


<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
        value="{{ old('name', $message->name) }}">

    @error('name')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="name" class="form-label">Phone</label>
    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
        value="{{ old('phone', $message->phone) }}">

    @error('phone')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ old('email', $message->email) }}">

    @error('email')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="message" class="form-label">Message</label>
    <textarea type="text" class="form-control @error('message') is-invalid @enderror" rows="5"
        name="message">{{ old('message', $message->message) }}</textarea>

    @error('message')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<script>
    CKEDITOR.replace( 'message' );
</script>




<button type="submit" class="btn btn-primary">Save</button>
