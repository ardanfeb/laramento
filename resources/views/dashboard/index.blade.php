@extends('layouts.backend')

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li class="active"><a href="{{ route('dashboard.index') }}"><i class="fas fa-chart-line"></i>Dashboard</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            {{-- Sales --}}
            <div class="row">

                {{-- Sales by value --}}
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Penjualan <small>(berdasarkan nilai)</small></b>
                        </div>
                        <div class="panel-body">
                            
                        </div>
                    </div>
                </div>
                
                {{-- Sales by quantity --}}
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-default">
                            <b>Penjualan <small>(berdasarkan jumlah barang)</small></b>
                        </div>
                        <div class="panel-body">

                        </div>
                    </div>
                </div>

                {{-- Gross profit --}}
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-default">
                            <b>Laba Kotor</b>
                        </div>
                        <div class="panel-body">

                        </div>
                    </div>
                </div>

            </div>
            
            {{-- Etc Row --}}
            <div class="row">

                {{-- Customer by count --}}
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-default">
                            <b>Jumlah Pelanggan</b>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>

                {{-- Customer by count --}}
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-default">
                            <b>Jumlah Reseller</b>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>

                {{-- Customer by place --}}
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-default">
                            <b>Pelanggan <small>(berdasarkan tempat)</small></b>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>

                {{-- Input sales by admin --}}
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-default">
                            <b>Input Penjualan <small>(oleh admin)</small></b>
                        </div>
                        <div class="panel-body">
                            <p class="text-center">Per September 2019</p>
                            <p>1. <span class="pull-right badge bgc-green">1000 Sales</span></p>
                            <p>2. <span class="pull-right">1000 Sales</span></p>
                            <p>3. <span class="pull-right">1000 Sales</span></p>
                            <p>4. <span class="pull-right">1000 Sales</span></p>
                            <p>5. <span class="pull-right">1000 Sales</span></p>
                            <p>6. <span class="pull-right badge bgc-green">1000 Sales</span></p>
                            <p>7. <span class="pull-right">1000 Sales</span></p>
                            <p>8. <span class="pull-right">1000 Sales</span></p>
                            <p>9. <span class="pull-right">1000 Sales</span></p>
                            <p>10. <span class="pull-right">1000 Sales</span></p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Selling Product Row --}}
            <div class="row">

                {{-- Top sales product --}}
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-default">
                            <b>Produk <small class="txtc-green">(berdasarkan penjualan tertinggi)</small></b>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>

                {{-- Top sales product --}}
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-default">
                            <b>Produk <small class="txtc-orange">(berdasarkan penjualan terendah)</small></b>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>

                {{-- Top selling category --}}
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-default">
                            <b>Kategori Produk Terlaris</b>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>

            </div>

            {{-- Google analytics --}}
            <div class="row">

                {{-- Analytics --}}
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-default">
                            <b>Google analytics</b>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>

            </div>


        </section>
    </div>
@endsection

@section('js')

@endsection
