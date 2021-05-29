<style>
    .alert {
        padding: 20px;
        background-color: #f44336;
        color: white;
        opacity: 1;
        transition: opacity 0.6s;
        margin-bottom: 15px;
    }

    .alert.success {
        background-color: #4CAF50;
    }

    .alert.info {
        background-color: #2196F3;
    }

    .alert.warning {
        background-color: #ff9800;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>

@if (session()->has('success'))

<div class="alert success">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    {{ session('success') }}
</div>
@endif

@if (session()->has('error'))
<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    {{ session('error') }}
</div>
@endif



@if ( isset($message))
    <div class="alert alert-info">
        {{ $slot }}    {{ $message }}
    </div>
@endif
