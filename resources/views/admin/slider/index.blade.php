@extends('layouts.admin')

@section('title', 'Sliders List')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class=" col-lg-6 col-sm-6">
                                    <button formaction="{{ route('admin.sliders.delete') }}" type="submit"
                                            class="btn btn-danger"
                                            onclick="return  confirm('Do you want to Delete? Yes/No')"><i
                                            class="nav-icon fas fa-trash"></i></button>

                                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-success"><i
                                            class="nav-icon fas fa-plus"></i></a>
                                </div>

                            </div>
                        </div>
                        <x-alerts/>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <th><input type="checkbox" class="selectall"></th>
                                <th>image</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th style="text-align:center;">Actions</th>
                                </thead>
                                <tbody>
                                @forelse ($sliders as $slider)
                                    <tr>
                                        <td><input class="selectbox" type="checkbox" name="ids[]"
                                                   value="{{ $slider->id }}">
                                        </td>
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                        <td><img src="{{ $slider->image_url }}" alt="" height="60"></td>
                                        <td class="@if ($slider->status == 'active') text-success @else
                        text-danger @endif">{{ $slider->status }}</td>
                                        <td>{{ $slider->created_at }}</td>
                                        <td>{{ $slider->updated_at }}</td>

                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="{{ route('admin.sliders.edit', [$slider->id]) }}"
                                                       class="btn btn-primary glyphicon glyphicon-edit"><i
                                                            class="nav-icon fas fa-edit"></i></a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button formaction="{{route('admin.sliders.destroy',$slider->id)}}"
                                                            type="submit"
                                                            class="btn  btn-danger"
                                                            onclick="return  confirm('do you want to delete Y/N')">
                                                        <i class="nav-icon fas fa-trash"></i></button>
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
                                <tfoot>
                                <th></th>
                                <th>image</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th style="text-align:center;">Actions</th>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>


    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script type="text/javascript">
        $('.selectall').click(function () {
            $('.selectbox').prop('checked', $(this).prop('checked'));
        })
        $('selectbox').change(function () {
            var total = $('.selectbox').length;
            var number = $('.selectbox:checked').length;
            if (total == number) {
                $('.selectall').prop('checked', true);
            } else {
                $('.selectall').prop('checked', false);
            }
        })
    </script>

@stop

