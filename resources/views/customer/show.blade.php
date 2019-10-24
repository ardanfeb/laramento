@extends('layouts.backend')

@section('css')
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li><a href="{{ route('customer.index') }}"><i class="fas fa-user fa-sm"></i>Customer</a></li>
                <li class="active"><a href="{{ route('customer.show', $data->id) }}">Show</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            {{-- Customer --}}
            <div class="row">

                {{-- List of Customer --}}
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Customer Information</b>
                        </div>
                        <div class="panel-body">

                            {{-- Nama --}}
                            <p>Name<span class="badge bgc-green pull-right">{{ $data->customer_name }}</span></p>

                            {{-- Phone --}}
                            <p>Phone Number<span class="badge bgc-green pull-right">{{ $data->phone }}</span></p>

                            {{-- Address --}}
                            <p>Address<span class="badge bgc-green pull-right">{{ $data->address }}</span></p>

                            {{-- Note --}}
                            <p>Note<span class="badge bgc-green pull-right">{{ $data->note }}</span></p>

                        </div>
                    </div>
                </div>

            </div>
            
        </section>
    </div>
@endsection

@section('js')
@endsection