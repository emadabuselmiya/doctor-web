@if($errors->any())
    <div class="alert alert-danger">
        Error
    </div>
@endif


<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
        @foreach ($status as $item)
        <option value="{{ $item }}" @if ($item == old('status', $slider->status)) selected @endif>{{ $item }}</option>
        @endforeach

        @error('status')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </select>
</div>



<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    </script>


<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <img src="{{ $slider->image_url }}" id="output"  height="200" class="d-block m-3"/>
    <input type="file" class="form-control @error('image') is-invalid @enderror" onchange="loadFile(event)"  id="image" name="image">

    @error('image')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>




<button type="submit" class="btn btn-primary">Save</button>
