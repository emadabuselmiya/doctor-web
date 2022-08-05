@extends('layouts.admin')

@section('title', 'Doctors List')

@section('filtring')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" name="name" placeholder="Search"
                   aria-label="Search"
                   value="{{ $filters['name'] ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

@stop


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

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class=" col-lg-6 col-sm-6">

                                <a href="{{ route('admin.doctors.create') }}" class="btn btn-success"><i
                                        class="nav-icon fas fa-plus"></i></a>
                            </div>

                        </div>
                    </div>
                    <x-alerts/>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>image</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>

                                <th style="text-align:center;">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($doctors as $doctor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ $doctor->image_url }}" alt="" height="60"></td>
                                    <td>{{ $doctor->name }}</td>
                                    <td>{{ $doctor->created_at }}</td>
                                    <td>{{ $doctor->updated_at }}</td>

                                    <td>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="{{ route('admin.doctors.edit', [$doctor->id]) }}"
                                                   class="btn btn-primary glyphicon glyphicon-edit"><i
                                                        class="nav-icon fas fa-edit"></i></a>
                                            </div>
                                            <div class="col-sm-6">
                                                <form class="form-inline"
                                                      action="{{ route('admin.doctors.destroy', $doctor->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger glyphicon glyphicon-trash"
                                                            onclick="return  confirm('Do you want to Delete? Yes/No')">
                                                        <i
                                                            class="nav-icon fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">No Doctors</td>
                                </tr>

                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>image</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>

                                <th style="text-align:center;">Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
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


