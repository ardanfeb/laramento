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
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li><a href="{{ route('inventory.index') }}"><i class="fas fa-boxes"></i>Inventori</a></li>
                <li><a href="{{ route('inventory.stock_in') }}">Stok Masuk</a></li>
                <li class="active"><a href="{{ route('inventory.stock_in.show', $stock->id) }}">{{ $stock->code }}</a></li>
                <a id="print" href="#" onclick="print()" style="position:relative;top:-6px;" class="btn btn-sm bgc-green pull-right"><i class="fas fa-print" style="margin-right:10px;"></i>Print</a>
            </ol>               
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">

                {{--  Stock In --}}
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>{{ $stock->code }}</b>
                            <b class="pull-right">Tanggal: {{ date('d/m/Y', strtotime($stock->created_at)) }}</b>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-striped" style="width:100%;" id="table-stokin">
                                <thead>
                                    <tr>
                                        <th style="width:30px;">No</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga Beli</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                        $total_final = 0;
                                    @endphp
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->product_name }} - {{ $item->label_name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>Rp. {{ $item->price_buy }}</td>
                                            <td>Rp. {{ $item->price_buy + $item->qty }}</td>
                                        </tr>
                                        @php
                                            $total_final += $item->price_buy + $item->qty;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <b class="pull-right">Total Biaya Dikeluarkan: <span class="badge bgc-green" style="margin-left:5px;">Rp. {{ $total_final }}</span></b>
                        </div>
                    </div>
                </div>
                

            </div>
        </section>
    </div>
@endsection

@section('js')
@endsection