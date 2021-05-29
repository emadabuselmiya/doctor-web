@if ($errors->any())
    <div class="alert alert-danger">
        Error
    </div>
@endif


<div class="mb-3">
    <label for="name" class="form-label">Service Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        value="{{ old('name', $service->name) }}">

    @error('name')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control form-control @error('description') is-invalid @enderror"
        placeholder="Place some text here" id="description"
        name="description">{{ old('description', $service->description) }}</textarea>



    @error('description')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<script>
    CKEDITOR.replace( 'description' );
</script>

<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

</script>

<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <img id="output" src="{{ $service->image_url ?? 'images/default-image.jpg'}}" alt="" height="200" class="d-block">
    <input type="file" class="form-control @error('image') is-invalid @enderror" onchange="loadFile(event)" name="image">

    @error('image')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>




<button type="submit" class="btn btn-primary">Save</button>
