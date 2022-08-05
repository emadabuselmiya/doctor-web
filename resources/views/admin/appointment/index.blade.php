@extends('layouts.admin')

@section('title', 'Appointments List')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@stop

@section('filtring')
    <form class="form-inline ml-3">
        <div class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="text" name="name" placeholder="Name ..."
                       aria-label="Search"
                       value="{{ $filters['name'] ?? '' }}">
                <div class="input-group-append">

                </div>
            </div>
        </div>

        <div class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="text" name="gender" placeholder="Gender ..."
                       aria-label="Search"
                       value="{{ $filters['gender'] ?? '' }}">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

    </form>

@endsection


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <x-alerts/>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Doctor</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th style="text-align:center;">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('admin.appointments.show', $appointment->id) }}">{{ $appointment->name }}
                                    </td>
                                    <td>{{ $appointment->doctor->name ?? ''}}</td>
                                    <td>{{ $appointment->age }}</td>
                                    <td>{{ $appointment->gender }}</td>
                                    <td>{{ $appointment->phone }}</td>
                                    <td>{{ $appointment->email }}</td>
                                    <td>{{ $appointment->created_at }}</td>

                                    <td>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="{{ route('admin.appointments.show', [$appointment->id]) }}"
                                                   class="btn btn-success glyphicon glyphicon-edit"><i
                                                        class="nav-icon fas fa-eye"></i></a>
                                            </div>
                                            <div class="col-sm-6">
                                                <form class="form-inline"
                                                      action="{{ route('admin.appointments.destroy', $appointment->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger glyphicon glyphicon-trash"
                                                            onclick="return  confirm('Do you want to delete Yes/No')"><i
                                                            class="nav-icon fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">No Appointments</td>
                                </tr>

                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Created At</th>
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

@stop
