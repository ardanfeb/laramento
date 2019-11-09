@extends('layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/alt/AdminLTE-select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li><a href="{{ route('inventory.index') }}"><i class="fas fa-boxes"></i>Inventori</a></li>
                <li><a href="{{ route('inventory.stock_out') }}">Stok Keluar</a></li>
                <li class="active"><a href="{{ route('inventory.stock_out.create') }}">Tambah</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">

                {{--  Stock In --}}
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Tambah Stok Keluar</b>
                        </div>
                        <div class="panel-body">
                            
                            {{-- Form add store --}}
                            <form action="{{ route('inventory.stock_out.store') }}" method="post">
                                {{ csrf_field() }}

                                {{-- Tanggal --}}
                                {{-- <div class="row">
                                    <div class="col-md-6 col-xs-12 form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                        <label>Tanggal <b class="txtc-red">*</b></label>
                                        <input type="text" class="form-control tanggal" id="date" name="date" placeholder="e.g. 2019-01-01" data-date-format="yyyy-mm-dd">
                                        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div> --}}

                                {{-- Catatan --}}
                                <div class="row">
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label>Judul/Catatan <b class="txtc-red">*</b></label>
                                        <textarea type="text" class="form-control note" name="note" placeholder="e.g. Catatan" rows="4"></textarea>
                                    </div>
                                </div>
                                
                                {{-- Daftar Produk --}}
                                <table class="table table-responsive table-striped table_array" style="margin-top:10px;">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk <span class="txtc-red">*</span></th>
                                            <th style="width:100px;">Jumlah <span class="txtc-red">*</span></th>
                                            {{-- <th style="width:200px;">Harga Beli Per Unit <span class="txtc-red">*</span></th> --}}
                                            <th style="width:50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                                {{-- Tambah Produk --}}
                                <div class="row" style="margin-top:-10px;padding-left:10px;">
                                    <div class="col-md-12">
                                        <a href="#tambah" onclick="tambah()">+ Tambah Produk</a>
                                    </div>
                                </div>

                                {{-- Button Proses --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- <input type="hidden" id="total_harga_final" name="total_harga_final"> --}}
                                        <button type="button" onclick="proses()" data-toggle="modal" data-target="#modal-check" class="btn bg-green pull-right">Proses</button>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="modal-check">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <b class="modal-title">Data Tambah Stok</b>
                                            </div>
                                            <div class="modal-body">
                                                {{-- <p><b>Tanggal</b> <span class="pull-right" id="tgl_show"></span></p> --}}
                                                <p><b>Catatan</b> <span class="pull-right" id="note_show"></span></p>
                                                <br/>
                                                <div id="list_produk"></div>
                                                {{-- <p class="text-center">
                                                    <b>Total Biaya Dikeluarkan: <span class="badge bgc-green" style="margin-left:5px;" id="totfinal_show"></span></b>
                                                </p> --}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn bg-green">Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                

            </div>
        </section>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        // $('#date').datepicker({
        //     autoclose: true
        // })

        var product = [];
        var qty = [];
        var price_buy = [];
        var table;
        var list_produk = "";
        // var total_harga_final = 0;
        // var tanggal = "";
        var note = "";

        function proses() {
            var no = 0;
            // tanggal = document.getElementsByClassName('tanggal');
            note = document.getElementsByClassName('note');
            product = document.getElementsByClassName('product');
            qty = document.getElementsByClassName('qty');
            // price_buy = document.getElementsByClassName('price_buy');

            list_produk = "";
            table = "<table class='table table-responsive table-striped table-bordered'><thead><tr>" +
                "<th>No</th>" +
                "<th>Produk</th>" +
                "<th>Jumlah</th>" +
                // "<th>Harga Per Unit</th>" + 
                // "<th>Total</th>" +
                "</thead></tr><tbody>";
            
            var length = product.length;
            for(var i=0; i<length; i++){
                // if(parseInt(price_buy[i].value)) {
                //     total_harga_final += parseInt(price_buy[i].value) * parseInt(qty[i].value);
                // }
                table+="<tr>";
                table+="<td>"+ (no+=1) +"</td>";
                table+="<td>"+product[i].options[product[i].selectedIndex].innerHTML+"</td>";
                table+="<td>"+qty[i].value+"</td>";
                // table+="<td> Rp. "+price_buy[i].value+"</td>";
                // table+="<td> Rp. "+price_buy[i].value * qty[i].value+"</td>";
                table+="</tr>";
            }
            table+="</tbody></table>";
            $("#list_produk").html(table);
            
            // document.getElementById('tgl_show').innerHTML = tanggal[0].value;
            document.getElementById('note_show').innerHTML = note[0].value == '' ? '-' : note[0].value;
            // document.getElementById('totfinal_show').innerHTML = "Rp. " + total_harga_final;
            // document.getElementById('total_harga_final').value = total_harga_final;
        }

        function tambah() {
            var markup = "<tr>" +
                "<td><select name='product[]' class='form-control select2 product'><option selected disabled>Pilih Produk</option><?php foreach ($product as $item) { ?><option value='<?php echo $item->id ?>'><?php echo $item->product_name ?> - <?php echo $item->label_name ?></option><?php }; ?></select></td>" +
                "<td><input type='number' class='form-control qty' name='qty[]' placeholder='e.g. 1' style='text-align:right;'></td>" +
                // "<td><input type='text' class='form-control price_buy' name='price_buy[]' placeholder='e.g. 10000' style='text-align:right;'></td>" +
                "<td class='text-center' style='padding-top:14px;'><a href='#delete' onclick='hapus(this)' class='txtc-orange'><i class='fas fa-trash'></i></a></td>" +
                "</tr>";
            $(".table_array tbody").append(markup);
            $('.select2').select2();
        }

        function hapus(data) {
            data.closest('tr').remove();
        }
    </script>
@endsection