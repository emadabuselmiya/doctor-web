@if ($errors->any())
    <div class="alert alert-danger">
        Error
    </div>
@endif


<div class="mb-3">
    <label for="name" class="form-label">Service Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        value="{{ old('name', $doctor->name) }}">

    @error('name')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>


<div class="mb-3">
    <label for="description" class="form-label">Description</label>


        <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description', $doctor->description) }}</textarea>

    @error('description')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>


<script>
    CKEDITOR.replace( 'description' );
</script>

<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <img src="{{ $doctor->image_url ?? 'images/default-image.jpg'}}" id="output" alt="" height="200" class="d-block">
    <input type="file" class="form-control @error('image') is-invalid @enderror" onchange="loadFile(event)"
        name="image">

    @error('image')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>




<button type="submit" class="btn btn-primary">Save</button>
