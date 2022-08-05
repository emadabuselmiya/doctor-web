
<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
           value="{{ old('name', $user->name) }}">

    @error('name')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
           value="{{ old('email', $user->email) }}">

    @error('email')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="name" class="form-label">Password</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
           value="{{ old('password', $user->password) }}">

    @error('password')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>




<button type="submit" class="btn btn-primary">Save</button>
