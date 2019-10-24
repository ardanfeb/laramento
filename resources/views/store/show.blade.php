@extends('layouts.backend')

@section('css')
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.index') }}"><i class="fas fa-store-alt fa-sm"></i>Store</a></li>
                <li class="active"><a href="{{ route('store.show', $data->id) }}">Show</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            {{-- Store --}}
            <div class="row">

                {{-- List of Store --}}
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Store Information</b>
                        </div>
                        <div class="panel-body">

                            {{-- Nama --}}
                            <p>Store Name<span class="badge bgc-green pull-right">{{ $data->store_name }}</span></p>

                            {{-- Phone --}}
                            <p>Phone Number<span class="badge bgc-green pull-right">{{ $data->phone }}</span></p>

                            {{-- Address --}}
                            <p>Address<span class="badge bgc-green pull-right">{{ $data->address }}</span></p>

                            {{-- Note --}}
                            <p>Store Type<span class="badge bgc-green pull-right">{{ $data->store_type }}</span></p>

                        </div>
                    </div>
                </div>

            </div>
            
        </section>
    </div>
@endsection

@section('js')
@endsection