@extends('layouts.admin')

@section('title', 'Gallaries List')


@section('create')
    <a href="{{ route('admin.gallaries.create') }}" class="btn btn-outline-primary mb-3">Create New</a>
@endsection

@section('content')

@section('filtring')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="date" name="date" placeholder="Search" aria-label="Search"
                value="{{ $filters['date'] ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

@endsection



<form action="{{ route('admin.gallaries.delete') }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="d-flex justify-content-between py-4">
        <div>
            <button type="submit" class="btn btn-danger" onclick="return  confirm('Do you want to Delete? Yes/No')"><i
                    class="nav-icon fas fa-trash"></i></button>
            <a href="{{ route('admin.gallaries.create') }}" class="btn btn-success"><i
                    class="nav-icon fas fa-plus"></i></a>

        </div>

        <div>
        </div>
    </div>

    <x-alerts />


    <table class="table table-hover">
        <thead>
            <tr>
                <th></th>
                <th><input type="checkbox" class="selectall"></th>
                <th>image</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th style="text-align:center;">ِActions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($gallaries as $gallary)
                <tr>
                    <td></td>
                    <td><input class="selectbox" type="checkbox" name="ids[]" value="{{ $gallary->id }}"></td>

                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td><img src="{{ $gallary->image_url }}" alt="" height="60"></td>
                <td class="@if ($gallary->status == 'active') text-success @else
                        text-danger @endif">{{ $gallary->status }}</td>
                    <td>{{ $gallary->created_at }}</td>
                    <td>{{ $gallary->updated_at }}</td>

                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route('admin.gallaries.edit', [$gallary->id]) }}" class="btn btn-primary"><i
                                        class="nav-icon fas fa-edit"></i></a>
                            </div>

                            <div class="col-sm-6">
                                <button formaction="{{route('admin.gallaries.destroy',$gallary->id)}}" type="submit" class="btn  btn-danger" onclick="return  confirm('Do you want to delete? Y/N')"><i class="nav-icon fas fa-trash"></i></button>
                            </div>


                        </div>

                    </td>

                </tr>

            @empty
                <tr>
                    <td colspan="11" class="text-center">No Sliders</td>
                </tr>

            @endforelse
        </tbody>
</form>
</table>

<script type="text/javascript">
    $('.selectall').click(function(){
        $('.selectbox').prop('checked',$(this).prop('checked'));
    })
    $('selectbox').change(function(){
        var total = $('.selectbox').length;
        var number = $('.selectbox:checked').length;
        if(total == number){
            $('.selectall').prop('checked',true);
        }else{
            $('.selectall').prop('checked',false);
        }
    })
</script>

@endsection
