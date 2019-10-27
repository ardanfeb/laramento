@extends('layouts.backend')

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li><a href="{{ route('inventory.index') }}"><i class="fas fa-boxes"></i>Inventori</a></li>
                <li class="active"><a href="{{ route('inventory.stock_out') }}">Stok Keluar</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            
        </section>
    </div>
@endsection

@section('js')

@endsection
