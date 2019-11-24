@extends('layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/alt/AdminLTE-select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                    <li class="active"><a href="{{ route('sales.index') }}"><i class="fas fa-cash-register"></i>Penjualan</a></li>
                <li class="active"><a href="{{ route('sales.create') }}">Tambah</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            {{-- Store --}}
            <div class="row">

                {{-- Form add store --}}
                <form action="{{ route('sales.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                    {{-- Informasi Penjualan --}}
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Informasi Penjualan</b>
                            </div>
                            <div class="panel-body row">

                                {{-- Info Pembeli --}}
                                <div class="pembeli">

                                    {{-- Title --}}
                                    <div class="col-md-12">
                                        <i class="txtc-blue"><span class="fas fa-align-left" style="margin-right:13px;"></span><b>Pelanggan</b></i>
                                        <hr style="margin-top:5px;">
                                    </div>

                                    {{-- Jenis Pelanggan --}}
                                    <div class="col-md-12 form-group{{ $errors->has('customer_type') ? ' has-error' : '' }}">
                                        <label>Tipe Pelanggan</label>
                                        <select name="customer_type" id="customer_type" class="form-control select2" onchange="customerType()">
                                            <option selected disabled>Pilih tipe pelanggan</option>
                                            <option value="1">Pelanggan Terdaftar</option>
                                            <option value="2">Pelanggan Belum Terdaftar</option>
                                            <option value="3">Reseller</option>
                                        </select>
                                        {!! $errors->first('customer_type', '<p class="help-block">:message</p>') !!}
                                    </div>

                                    {{-- Form Pelanggan Terdaftar --}}
                                    <div id="regPelanggaForm" class="col-md-12 form-group{{ $errors->has('customer') ? ' has-error' : '' }}">
                                        <label>Pelanggan</label>
                                        <select name="customer" class="form-control select2">
                                            <option selected disabled>Pilih pelanggan</option>
                                            
                                            @foreach ($customer as $item)
                                                <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('customer', '<p class="help-block">:message</p>') !!}
                                    </div>

                                    {{-- Form Pelanggan Belum Terdaftar --}}
                                    <div id="notregPelangganForm" class="col-md-12">
                                        <div class="row">

                                            {{-- Nama --}}
                                            <div class="col-md-12 form-group">
                                                <label>Nama Pelanggan</label>
                                                <input type="text" class="form-control" name="customer_name" placeholder="e.g. John Doe">
                                            </div>
                                            
                                            {{-- Telpon --}}
                                            <div class="col-md-12 form-group">
                                                <label>Telpon</label>
                                                <input type="text" class="form-control" name="customer_phone" placeholder="e.g. 080989999">
                                            </div>
                                                
                                            {{-- Alamat --}}
                                            <div class="col-md-12 form-group">
                                                <label>Alamat</label>
                                                <input type="text" class="form-control" name="customer_address" placeholder="e.g. Jl. Jalan">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Form Reseller --}}
                                    <div id="resellerForm" class="col-md-12 form-group{{ $errors->has('reseller') ? ' has-error' : '' }}">
                                        <label>Reseller</label>
                                        <select name="reseller" class="form-control select2">
                                            <option selected disabled>Pilih reseller</option>
                                            
                                            @foreach ($reseller as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('reseller', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                {{-- Detail Pembelian --}}
                                <div class="detail-pembelian">

                                    {{-- Title --}}
                                    <div class="col-md-12" style="margin-top:20px;">
                                        <i class="txtc-blue"><span class="fas fa-align-left" style="margin-right:13px;"></span><b>Detail Pembelian</b></i>
                                        <hr style="margin-top:5px;">
                                    </div>

                                    {{-- Jenis Pembelian --}}
                                    <div class="col-md-12 form-group{{ $errors->has('selling_type') ? ' has-error' : '' }}">
                                        <label>Tipe Pembelian <b class="txtc-red">*</b></label>
                                        <select name="selling_type" id="selling_type" class="form-control select2" onchange="sellingType()">
                                            <option selected disabled>Pilih tipe pembelian</option>
                                            <option value="online">Online</option>
                                            <option value="offline">Offline</option>
                                        </select>
                                        {!! $errors->first('selling_type', '<p class="help-block">:message</p>') !!}
                                    </div>

                                    {{-- Invoice --}}
                                    {{-- <div class="col-md-12 form-group{{ $errors->has('invoice') ? ' has-error' : '' }}">
                                        <label>Invoice <b class="txtc-red">*</b></label>
                                        <input type="text" id="invoice" class="form-control" name="invoice" placeholder="e.g. INV0001">
                                        {!! $errors->first('invoice', '<p class="help-block">:message</p>') !!}
                                    </div> --}}

                                    {{-- Online --}}
                                    <div id="formOnline" class="col-md-12">
                                        <div class="row">

                                            {{-- Resi --}}
                                            <div class="col-md-12 form-group{{ $errors->has('resi') ? ' has-error' : '' }}">
                                                <label>Resi <b class="txtc-red">*</b></label>
                                                <input type="text" id="resi" class="form-control" name="resi" placeholder="e.g. RESI0001">
                                                {!! $errors->first('resi', '<p class="help-block">:message</p>') !!}
                                            </div>

                                            {{-- Marketplace --}}
                                            <div class="col-md-12 form-group{{ $errors->has('marketplace') ? ' has-error' : '' }}">
                                                <label>Marketplace <b class="txtc-red">*</b></label>
                                                <select name="marketplace" id="marketplace" class="form-control select2">
                                                    <option selected disabled>Pilih marketplace</option>
                                                    
                                                    @foreach ($marketplace as $item)
                                                        <option value="{{ $item->code }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('marketplace', '<p class="help-block">:message</p>') !!}
                                            </div>

                                            {{-- Ekspedisi --}}
                                            <div class="col-md-12 form-group{{ $errors->has('ekspedisi') ? ' has-error' : '' }}">
                                                <label>Ekspedisi <b class="txtc-red">*</b></label>
                                                <select id="ekspedisi" name="ekspedisi" class="form-control select2" onchange="customerType()">
                                                    <option selected disabled>Pilih ekspedisi</option>
                                                    <option value="JNE">JNE</option>
                                                    <option value="TIKI">TIKI</option>
                                                    <option value="POS">POS</option>
                                                    <option value="J&T">J&T</option>
                                                    <option value="NinjaExpress">NinjaExpress</option>
                                                    <option value="GOJEK/Grab">GOJEK/Grab</option>
                                                </select>
                                                {!! $errors->first('ekspedisi', '<p class="help-block">:message</p>') !!}
                                            </div>
            
                                            {{-- Ongkir --}}
                                            <div class="col-md-12 form-group{{ $errors->has('ongkir') ? ' has-error' : '' }}">
                                                <label>Ongkos Kirim <b class="txtc-red">*</b></label>
                                                <input type="text" id="ongkir" class="form-control" name="ongkir" placeholder="e.g. 20000">
                                                {!! $errors->first('ongkir', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                    </div>
    
                                    {{-- Status --}}
                                    <div class="col-md-12 form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                        <label>Status <b class="txtc-red">*</b></label>
                                        <select id="status_penjualan" name="status" class="form-control select2">
                                            <option selected disabled>Pilih status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Sukses">Sukses</option>
                                        </select>
                                        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                            </div>
                            <div class="panel-footer">
                                <b><span class="txtc-red">*</span> Wajib diisi</b>
                            </div>
                        </div>
                    </div>

                    {{-- Daftar Produk --}}
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Daftar Produk</b>
                            </div>
                            <div class="panel-body">

                                {{-- Table Produk --}}
                                <table class="table table-responsive table-striped table_array">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk <span class="txtc-red">*</span></th>
                                            <th style="width:100px;">Jumlah <span class="txtc-red">*</span></th>
                                            <th style="width:200px;">Harga Beli Per Unit <span class="txtc-red">*</span></th>
                                            <th style="width:50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                                {{-- Button Tambah Produk --}}
                                <div class="row" style="margin-top:-10px;padding-left:10px;">
                                    <div class="col-md-12">
                                        <a class="txtc-green" role="button" onclick="addProduct()">+ Tambah Produk</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <b><span class="txtc-red">*</span> Wajib diisi</b>
                            </div>
                        </div>
                    </div>

                    {{-- Button Proses --}}
                    <div class="col-md-12">
                        <button type="button" onclick="showData()" data-toggle="modal" data-target="#modal-check" class="btn bg-green pull-right">Proses Penjualan</button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-check">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <b class="modal-title">Data Penjualan</b>
                                </div>
                                <div class="modal-body">

                                    {{-- Content Modal --}}
                                    <p><b>Nama Pelanggan/Reseller</b> <span class="pull-right" id="show_name"></span></p>
                                    <p><b>Invoice</b> <span class="pull-right" id="show_invoice"></span></p>
                                    <p><b>Resi</b> <span class="pull-right" id="show_resi"></span></p>
                                    <p><b>Ekspedisi</b> <span class="pull-right" id="show_ekspedisi"></span></p>
                                    <p><b>Ongkos Kirim</b> <span class="pull-right" id="show_ongkir"></span></p>
                                    <p><b>Status</b> <span class="pull-right" id="show_status"></span></p>
                                    <br/>
                                    <div id="list_produk"></div>
                                    <p class="text-center">
                                        <b>Total Biaya Dikeluarkan: <span class="badge bgc-green" style="margin-left:5px;" id="totfinal_show"></span></b>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn bg-green">Tambah Penjualan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
        </section>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script type="text/javascript">
        $(".select2").select2();
        $('.textarea').wysihtml5()

        $('#regPelanggaForm').hide();
        $('#notregPelangganForm').hide();
        $('#resellerForm').hide();
        $('#formOnline').hide();

        var product = [];
        var qty = [];
        var price_buy = [];
        var table;
        var list_produk = "";
        var total_harga_final = 0;
        var nama = "";
        var invoice = "";
        var resi = "";
        var ekspedisi = "";
        var ongkir = "";
        var status_penjualan = "";

        function customerType() {
            var tipe_pelanggan = document.getElementById("customer_type").value;
            if (tipe_pelanggan == "1") {
                $('#notregPelangganForm').hide();
                $('#resellerForm').hide();
                $('#regPelanggaForm').slideDown(500);
            } else if(tipe_pelanggan == "2") {
                $('#regPelanggaForm').hide();
                $('#resellerForm').hide();
                $('#notregPelangganForm').slideDown(1000);
            } else {
                $('#regPelanggaForm').hide();
                $('#notregPelangganForm').hide();
                $('#resellerForm').slideDown(500);
            }
        }

        function sellingType() {
            var tipe_pembelian = document.getElementById("selling_type").value;
            if (tipe_pembelian == "online") {
                $('#formOnline').slideDown(700);
            } else {
                $('#formOnline').slideUp(700);
            }
        }

        function showData() {
            var no = 0;

            // nama = document.getElementById('nama');
            invoice = document.getElementById('invoice');
            resi = document.getElementById('resi');
            ekspedisi = document.getElementById('ekspedisi');
            ongkir = document.getElementById('ongkir');
            status_penjualan = document.getElementById('status_penjualan');
            
            product = document.getElementsByClassName('product');
            qty = document.getElementsByClassName('qty');
            price_buy = document.getElementsByClassName('price_buy');

            list_produk = "";
            table = "<table class='table table-responsive table-striped table-bordered'><thead><tr>" +
                "<th>No</th>" +
                "<th>Produk</th>" +
                "<th>Jumlah</th>" +
                "<th>Harga Per Unit</th>" + 
                "<th>Total</th></thead></tr><tbody>";
            
            var length = product.length;
            for(var i=0; i<length; i++){
                if(parseInt(price_buy[i].value)) {
                    total_harga_final += parseInt(price_buy[i].value) * parseInt(qty[i].value);
                }
                table+="<tr>";
                table+="<td>"+ (no+=1) +"</td>";
                table+="<td>"+product[i].options[product[i].selectedIndex].innerHTML+"</td>";
                table+="<td>"+qty[i].value+"</td>";
                table+="<td> Rp. "+price_buy[i].value+"</td>";
                table+="<td> Rp. "+price_buy[i].value * qty[i].value+"</td>";
                table+="</tr>";
            }
            table+="</tbody></table>";
            $("#list_produk").html(table);
            
            // document.getElementById('show_name').innerHTML = nama[0].value == '' ? '-' : nama[0].value;
            document.getElementById('show_invoice').innerHTML = invoice.value == '' ? '-' : invoice.value;
            document.getElementById('show_resi').innerHTML = resi.value == '' ? '-' : resi.value;
            document.getElementById('show_ekspedisi').innerHTML = ekspedisi.value == 'Pilih ekspedisi' ? '-' : ekspedisi.value;
            document.getElementById('show_ongkir').innerHTML = ongkir.value == '' ? '-' : ongkir.value;
            document.getElementById('show_status').innerHTML = status_penjualan.value == 'Pilih status' ? '-' : status_penjualan.value;

            console.log(status.value);
            

            document.getElementById('totfinal_show').innerHTML = "Rp. " + total_harga_final;
            // document.getElementById('total_harga_final').value = total_harga_final;
        }

        function addProduct() {
            var markup = "<tr>" +
                "<td><select name='product[]' class='form-control select2 product'><option selected disabled>Pilih Produk</option><?php foreach ($product as $item) { ?><option value='<?php echo $item->id ?>'><?php echo $item->product_name ?> - <?php echo $item->label_name ?></option><?php }; ?></select></td>" +
                "<td><input type='number' class='form-control qty' name='qty[]' placeholder='e.g. 1' style='text-align:right;'></td>" +
                "<td><input type='text' class='form-control price_buy' name='price_buy[]' placeholder='e.g. 10000' style='text-align:right;'></td>" +
                "<td class='text-center' style='padding-top:14px;'><a href='#delete' onclick='delProduct(this)' class='txtc-orange'><i class='fas fa-trash'></i></a></td>" +
                "</tr>";
            $(".table_array tbody").append(markup);
            $('.select2').select2();
        }

        function delProduct(data) {
            data.closest('tr').remove();
        }
    </script>
@endsection