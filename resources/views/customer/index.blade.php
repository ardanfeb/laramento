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
                <li class="active"><a href="{{ route('customer.index') }}"><i class="fas fa-user fa-sm"></i>Pelanggan</a></li>
                <a href="{{ route('customer.create') }}" style="position:relative;top:-6px;" class="btn btn-sm bgc-green pull-right"><i class="fas fa-plus-circle" style="margin-right:10px;"></i>Tambah Pelanggan</a>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            {{-- Customer --}}
            <div class="row">

                {{-- List of Customer --}}
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Daftar Pelanggan</b>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-bordered table-striped" style="width:100%;" id="table-customer">
                                <thead>
                                    <tr>
                                        <th style="width:30px;">No</th>
                                        <th>Nama</th>
                                        <th>No. Telpon</th>
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
        $('#table-customer').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('customer.data') }}',
            columns: [
                { data: 'rownum', name: 'rownum' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'phone', name: 'phone' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            iDisplayLength: 10,
            aLengthMenu: [
                [10, 20, -1],
                [10, 20, "All"]
            ],
            scrollCollapse: true,
            paging: true,
        });
    </script>
@endsection