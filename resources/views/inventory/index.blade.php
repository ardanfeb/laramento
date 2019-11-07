@extends('layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li class="active"><a href="{{ route('inventory.index') }}"><i class="fas fa-boxes"></i>Inventori</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">

                {{--  Stock In --}}
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Stok Keseluruhan</b>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-bordered table-striped" style="width:100%;" id="table-stok">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th style="width:80px;">Stok Masuk</th>
                                        <th style="width:80px;">Stok Keluar</th>
                                        <th style="width:80px;">Penjualan</th>
                                        <th style="width:80px;">Penyesuaian</th>
                                        <th style="width:80px;">Stok Akhir</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                

            </div>
        </section>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('bower_components/datatables.net-bs/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
    
    <script type="text/javascript">
        $('#table-stok').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('inventory.stock.data') }}',
            columns: [
                { data: 'product_name', name: 'product_name' },
                { data: 'category_name', name: 'category_name' },
                { data: 'stok_akhir', name: 'stok_akhir' },
                { data: 'stok_akhir', name: 'stok_akhir' },
                { data: 'stok_akhir', name: 'stok_akhir' },
                { data: 'stok_akhir', name: 'stok_akhir' },
                { data: 'stok_akhir', name: 'stok_akhir' },
            ],
            iDisplayLength: 10,
            aLengthMenu: [
                [10, 20, -1],
                [10, 20, "All"]
            ],
            scrollCollapse: true,
            paging: true,
            order: [0, "asc"]
        });
    </script>
@endsection