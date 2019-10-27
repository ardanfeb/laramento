@extends('layouts.backend')

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li class="active"><a href="{{ route('sales.index') }}"><i class="fas fa-cash-register"></i>Penjualan</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            
        </section>
    </div>
@endsection

@section('js')

@endsection
