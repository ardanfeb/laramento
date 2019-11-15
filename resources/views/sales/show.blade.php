@extends('layouts.backend')

@section('css')
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li><a href="{{ route('product.index') }}"><i class="fas fa-shopping-bag"></i>Produk</a></li>
                <li class="active"><a href="{{ route('product.show', $data->id) }}">Lihat</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            {{-- Product --}}
            <div class="row">

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Informasi Produk</b>
                        </div>
                        <div class="panel-body">

                            {{-- Nama --}}
                            <p>Nama<span class="badge bgc-green pull-right">{{ $data->product_name }}</span></p>
                        </div>
                    </div>
                </div>

            </div>
            
        </section>
    </div>
@endsection

@section('js')
@endsection