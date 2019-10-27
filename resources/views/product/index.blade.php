@extends('layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/editor.dataTables.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li class="active"><a href="{{ route('product.index') }}"><i class="fas fa-shopping-bag"></i>Produk</a></li>
            </ol>
            <ul class="secondmenu" >
                <li class="active"><a onclick="changeTab('product')" href="#product" data-toggle="tab">Produk</a></li>
                <li><a onclick="changeTab('category')" href="#category" data-toggle="tab">Kategori</a></li>
                <li><a onclick="changeTab('label')" href="#label" data-toggle="tab">Label</a></li>
            </ul>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            
            @if (session('status'))
            <div class="col-md-12 alert alert-{{ session('status') }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>
                    @if (session('status') == 'success')
                        <i class="icon fa fa-check"></i> Success
                    @else
                        <i class="icon fa fa-ban"></i> Alert!   
                    @endif
                </h4>
                <strong>{{ session('msg') }}</strong>
            </div>
            @endif

            {{-- Row 1 --}}
            <div class="row">

                {{-- Content Product --}}
                <div class="col-md-12">

                    {{-- Panel Product --}}
                    <div class="panel panel-default panel-product">
                        <div class="panel-heading">
                            <b>Produk</b>
                            <a href="{{ route("product.create") }}" class="btn-xs btn-default pull-right">
                                Tambah Produk<i class="fas fa-plus-circle" style="margin-left:10px;"></i>
                            </a>
                        </div>
                        <div class="panel-body">
                            <table id="table-product" class="table table-responsive table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="width:30px;">No</th>
                                        <th>Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th style="width:30px;"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    {{-- Panel Category --}}
                    <div class="panel panel-default panel-category">
                        <div class="panel-heading">
                            <b>Kategori</b>
                            <a href="#" onclick="showForm('category')" class="btn-xs btn-default pull-right">
                                Tambah Kategori<i class="fas fa-caret-down" style="margin-left:10px;"></i>
                            </a>
                        </div>
                        <div class="panel-body">
                            
                            {{-- Create Category --}}
                            <div id="addCategory" class="row">
                                <form action="{{ route('category.store') }}" method="post">
                                    {{ csrf_field() }}
                                    <div style="padding:0 15px;" class="col-md-12 input-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                                        <input type="" class="form-control" name="category_name" placeholder="Masukan kategori ...">
                                        {!! $errors->first('category_name', '<p class="help-block">:message</p>') !!}
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn bg-green">Tambah Kategori</button>
                                        </div>
                                    </div>

                                    <hr class="col-md-12">
                                </form>
                            </div>

                            <table id="table-category" class="table table-responsive table-bordered table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="width:30px;">No</th>
                                        <th>Nama</th>
                                        <th style="width:30px;"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    {{-- Panel Label --}}
                    <div class="panel panel-default panel-label">
                        <div class="panel-heading">
                            <b>Label</b>
                            <a href="#" onclick="showForm('label')" class="btn-xs btn-default pull-right">
                                Tambah Label<i class="fas fa-caret-down" style="margin-left:10px;"></i>
                            </a>
                        </div>
                        <div class="panel-body">
                            
                            {{-- Create Label --}}
                            <div id="addLabel" class="row">
                                <form action="{{ route('label.store') }}" method="post">
                                    {{ csrf_field() }}
                                    <div style="padding:0 15px;" class="col-md-12 input-group{{ $errors->has('label_name') ? ' has-error' : '' }}">
                                        <input type="" class="form-control" name="label_name" placeholder="Masukan label ...">
                                        {!! $errors->first('label_name', '<p class="help-block">:message</p>') !!}
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn bg-green">Tambah Label</button>
                                        </div>
                                    </div>

                                    <hr class="col-md-12">
                                </form>
                            </div>

                            <table id="table-label" class="table table-responsive table-bordered table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="width:30px;">No</th>
                                        <th>Nama</th>
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
    {{-- <script type="text/javascript" src="{{ asset('bower_components/datatables.net-bs/js/dataTables.editor.min.js') }}"></script> --}}
    
    <script type="text/javascript">
        // var editor;
        $('#addLabel').hide();
        $('#addCategory').hide();
        $('.panel-product').hide();
        $('.panel-category').hide();
        $('.panel-label').hide();

        $(document).ready(function() {
            changeTab('product');
        });

        function changeTab(params) {
            $('#addCategory').hide();
            $('#addLabel').hide();
            $('.panel-product').hide();
            $('.panel-category').hide();
            $('.panel-label').hide();

            if (params == 'product') {
                $('.panel-product').show();
                $('#table-product').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: '{{ route('product.data') }}',
                    columns: [
                        { data: 'rownum', name: 'rownum' },
                        { data: 'product_name', name: 'product_name' },
                        { data: 'category_name', name: 'category_name' },
                        { data: 'price', name: 'price' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ],
                    iDisplayLength: 10,
                    aLengthMenu: [
                        [10, 20, -1],
                        [10, 20, "All"]
                    ],
                    scrollCollapse: true,
                    paging: true,
                    destroy: true,
                });
            } else if(params == 'category') {
                $('.panel-category').show();
                $('#table-category').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: '{{ route('category.data') }}',
                    columns: [
                        { data: 'rownum', name: 'rownum' },
                        { data: 'category_name', name: 'category_name' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ],
                    iDisplayLength: 10,
                    aLengthMenu: [
                        [10, 20, -1],
                        [10, 20, "All"]
                    ],
                    scrollCollapse: true,
                    paging: true,
                    destroy: true,
                });
            } else {
                $('.panel-label').show();
                $('#table-label').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: '{{ route('label.data') }}',
                    columns: [
                        { data: 'rownum', name: 'rownum' },
                        { data: 'label_name', name: 'label_name' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ],
                    iDisplayLength: 10,
                    aLengthMenu: [
                        [10, 20, -1],
                        [10, 20, "All"]
                    ],
                    scrollCollapse: true,
                    paging: true,
                    destroy: true,
                });
            }
        }

        function showForm(params) {
            if (params == 'category') {
                $('#addCategory').slideToggle(500);
            } else {
                $('#addLabel').slideToggle(500);
            }
        }
    </script>
@endsection
