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
                <li><a href="{{ route('inventory.index') }}"><i class="fas fa-boxes"></i>Inventori</a></li>
                <li class="active"><a href="{{ route('inventory.purchase_order') }}">Purchase Order</a></li>
                <a href="{{ route('inventory.purchase_order.create') }}" style="position:relative;top:-6px;" class="btn btn-sm bgc-green pull-right"><i class="fas fa-plus-circle" style="margin-right:10px;"></i>Tambah Purchase Order</a>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">

                {{--  Stock In --}}
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Purchase Order</b>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-bordered table-striped" style="width:100%;" id="table-po">
                                <thead>
                                    <tr>
                                        <th>Kode PO</th>
                                        <th>Supplier</th>
                                        <th style="width:150px;">Tanggal</th>
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
        $('#table-po').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('inventory.purchase_order.data') }}',
            columns: [
                { data: 'code', name: 'code' },
                { data: 'supplier_name', name: 'supplier_name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            iDisplayLength: 10,
            aLengthMenu: [
                [10, 20, -1],
                [10, 20, "All"]
            ],
            scrollCollapse: true,
            paging: true,
            order: [2, "desc"]
        });
    </script>
@endsection