@extends('layouts.backend')

@section('css')
    <style>
        @media print {
            #print {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <?php $no = 1; ?>
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li class="active"><a href="{{ route('sales.index') }}"><i class="fas fa-cash-register"></i>Penjualan</a></li>
                <li class="active"><a href="{{ route('sales.show', $sales->id) }}">Lihat</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            {{-- Product --}}
            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Invoice</b>
                            <span class="pull-right">{{ $sales->invoice }}</span>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if ($sales->marketplace !== "OFFLINE")
                                        <p><b>No. Resi : </b><span class="badge pull-right bg-gray">{{ $sales->recipe }}</span></p>
                                        <p><b>Marketplace : </b><span class="badge pull-right bg-gray">{{ $sales->marketplace }}</span></p>
                                        <p><b>Ekspedisi : </b><span class="badge pull-right bg-gray">{{ $sales->expedition }}</span></p>
                                    @endif
                                    <p><b>{{ $sales->customers_type == 'customer' ? "Pelanggan" : "Reseller" }} : </b><span class="badge pull-right bg-gray">{{ $sales->name }}</span></p>
                                    <p><b>Status : </b><span class="badge pull-right bg-gray">{{ $sales->status }}</span></p>
                                </div>
                                <div class="col-md-8">
                                    <button id="print" class="btn btn-default pull-right" onclick="print()"><i class="fa fa-print"></i></button>
                                </div>
                                <div class="col-md-12" style="margin-top:20px;">
                                    <hr style="margin-top:0;">
                                    <table class="table table-responsive table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Kategori</th>
                                                <th>Label</th>
                                                <th>Jumlah</th>
                                                <th>Harga Jual</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sales_items as $rows)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ ucfirst(strtolower($rows->product_name)) }}</td>
                                                    <td>{{ ucfirst(strtolower($rows->category_name)) }}</td>
                                                    <td>{{ ucfirst(strtolower($rows->label_name)) }}</td>
                                                    <td>{{ $rows->qty }}</td>
                                                    <td>Rp. {{ number_format($rows->price_sell, 0, ".", ".") }}</td>
                                                    <td>Rp. {{ number_format($rows->price_sell * $rows->qty, 0, ".", ".") }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr style="margin-top:0;">
                                    @if ($sales->marketplace !== "OFFLINE")
                                        <p class="pull-right"><b>Ongkos Kirim</b> : <span style="margin-left:70px;" class="badge bg-gray">Rp. {{ number_format($sales->postal_fee, 0, ".", ".") }}</span></p>
                                    @endif
                                    <div class="clearfix"></div>
                                    <p class="pull-right"><b>Total Belanja</b> : <span style="margin-left:70px;" class="badge bg-green">Rp. {{ number_format($sales->total_product, 0, ".", ".") }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
        </section>
    </div>
@endsection

@section('js')
@endsection