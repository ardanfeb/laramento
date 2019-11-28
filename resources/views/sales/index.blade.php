@extends('layouts.backend')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/jquery.dataTables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li class="active"><a href="{{ route('sales.index') }}"><i class="fas fa-cash-register"></i>Penjualan</a></li>
                <a href="{{ route('sales.create') }}" style="position:relative;top:-6px;" class="btn btn-sm bgc-green pull-right"><i class="fas fa-plus-circle" style="margin-right:10px;"></i>Tambah Penjualan</a>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            
            {{-- Penjualan --}}
            <div class="row">

                {{-- List of Penjualan --}}
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Daftar Penjualan</b>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-bordered table-striped" style="width:100%;" id="table-sales">
                                <thead>
                                    <tr>
                                        <th style="width:30px;">No</th>
                                        <th>Tanggal</th>
                                        <th>Invoice</th>
                                        <th>Pelanggan</th>
                                        <th>Diinput Oleh</th>
                                        <th>Status</th>
                                        <th style="width:30px;"></th>
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
        $('#table-sales').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ route('sales.data') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'created_at', name: 'created_at' },
                { data: 'invoice', name: 'invoice' },
                { data: 'customers_id', name: 'customers_id' },
                { data: 'users_id', name: 'users_id' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            iDisplayLength: 10,
            aLengthMenu: [
                [10, 20, -1],
                [10, 20, "All"]
            ],
            scrollCollapse: true,
            paging: true,
            order: [
                [1, "desc"],
            ]
        });
    </script>
@endsection
