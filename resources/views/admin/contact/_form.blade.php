@if ($errors->any())
    <div class="alert alert-danger">
        Error
    </div>
@endif

<x-alerts />

<div class="mb-3">
    <label for="address" class="form-label">Full Address</label>
    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
        value="{{ old('address', $contact->address) }}">

    @error('address')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="postal_code" class="form-label">Postal Code</label>
    <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code"
        name="postal_code" value="{{ old('postal_code', $contact->postal_code) }}">

    @error('postal_code')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Phone Number</label>
    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
        value="{{ old('phone', $contact->phone) }}">

    @error('phone')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
        value="{{ old('email', $contact->email) }}">

    @error('email')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="ftime" class="form-label">First Time</label>
    <input type="time" class="form-control @error('ftime') is-invalid @enderror" id="ftime" name="ftime"
        value="{{ old('ftime', $contact->ftime) }}">

    @error('ftime')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="ltime" class="form-label">Last Time</label>
    <input type="time" class="form-control @error('ltime') is-invalid @enderror" name="ltime"
        value="{{ old('ltime', $contact->ltime) }}">

    @error('ltime')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="facebook" class="form-label">Facebook</label>
    <input type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook"
        value="{{ old('facebook', $contact->facebook) }}">

    @error('facebook')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="instagram" class="form-label">Instagram</label>
    <input type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram"
        value="{{ old('instagram', $contact->instagram) }}">

    @error('instagram')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="twitter" class="form-label">Twitter</label>
    <input type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter"
        value="{{ old('twitter', $contact->twitter) }}">

    @error('twitter')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<script>
    var loadFile_logo = function(logo) {
        var image = document.getElementById('output_logo');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

    var loadFile_background = function(background) {
        var image = document.getElementById('output_background');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

</script>

<div class="mb-3">
    <label for="logo" class="form-label">Logo</label>
    <img id="output_logo" src="{{ $contact->logo_url ?? 'images/default-image.jpg'}} " alt="" height="200"  class="d-block">
    <input type="file" class="form-control @error('logo') is-invalid @enderror" onchange="loadFile_logo(logo)" name="logo">

    @error('logo')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="background" class="form-label">Background</label>
    <img id="output_background" src="{{ $contact->background_url ?? 'images/default-image.jpg'}}" alt="" height="200"  class="d-block">
    <input type="file" class="form-control @error('image') is-invalid @enderror" onchange="loadFile_background(background)" name="background">

    @error('background')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>


<button type="submit" class="btn btn-primary">Save</button>
