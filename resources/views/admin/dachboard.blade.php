@extends('layouts.admin')

@section('title', 'Dashboard')


@section('content')
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ DB::table('doctors')->count() }}</h3>

                <p>Doctors</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="{{ route('admin.doctors.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                {{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}
                <h3>{{ DB::table('clients')->count() }}</h3>


                <p>Clients</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="{{ route('admin.clients.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ DB::table('messages')->count() }}</h3>

                <p>Messages</p>
            </div>
            <div class="icon">
                <i class="ion ion-co"></i>
            </div>
            <a href="{{ route('admin.messages.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ DB::table('appointments')->count() }}</h3>

                <p>Appointments</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('admin.appointments.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

@endsection
