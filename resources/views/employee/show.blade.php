@extends('layouts.backend')

@section('css')
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li><a href="{{ route('employee.index') }}"><i class="fas fa-user-circle"></i>Employee</a></li>
                <li class="active"><a href="{{ route('employee.show', $data->id) }}">Show</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            {{-- employee --}}
            <div class="row">

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Employee Information</b>
                        </div>
                        <div class="panel-body">

                            {{-- Nama --}}
                            <p>Name<span class="badge bgc-green pull-right">{{ $data->name }}</span></p>

                            {{-- Phone --}}
                            <p>Phone Number<span class="badge bgc-green pull-right">{{ $data->phone }}</span></p>

                            {{-- Address --}}
                            <p>Address<span class="badge bgc-green pull-right">{{ $data->address }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- reseller --}}
            <div class="row">

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Reseller Information</b>
                        </div>
                        <div class="panel-body">

                            {{-- Nama --}}
                            <p>Name<span class="badge bgc-green pull-right">{{ $data->name }}</span></p>

                            {{-- Phone --}}
                            <p>Phone Number<span class="badge bgc-green pull-right">{{ $data->phone }}</span></p>

                            {{-- Address --}}
                            <p>Address<span class="badge bgc-green pull-right">{{ $data->address }}</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Reseller Information</b>
                        </div>
                        <div class="panel-body">

                            {{-- Nama --}}
                            <p>Name<span class="badge bgc-green pull-right">{{ $data->name }}</span></p>

                            {{-- Phone --}}
                            <p>Phone Number<span class="badge bgc-green pull-right">{{ $data->phone }}</span></p>

                            {{-- Address --}}
                            <p>Address<span class="badge bgc-green pull-right">{{ $data->address }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
    </div>
@endsection

@section('js')
@endsection