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
                <li><a href="{{ route('product.index') }}"><i class="fas fa-shopping-bag"></i>Produk</a></li>
                <li class="active"><a href="{{ route('product.edit', $product->id) }}">Ubah</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            {{-- Store --}}
            <div class="row">

                {{-- List of Store --}}
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Informasi Produk</b>
                        </div>
                        <div class="panel-body row">

                            {{-- Form add store --}}
                            <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}

                                {{-- Nama --}}
                                <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Nama Produk <b class="txtc-red">*</b></label>
                                    <input type="text" class="form-control" name="name" placeholder="e.g. Gildan Blue Stripe" value="{{ $product->product_name }}">
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Price buy --}}
                                <div class="col-md-6 form-group{{ $errors->has('price_buy') ? ' has-error' : '' }}">
                                    <label>Harga Beli <b class="txtc-red">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" class="form-control" name="price_buy" placeholder="e.g. 20000" value="{{ $product->price_buy }}">
                                    </div>
                                    {!! $errors->first('price_buy', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Price Sell --}}
                                <div class="col-md-6 form-group{{ $errors->has('price_sell') ? ' has-error' : '' }}">
                                    <label>Harga Jual <b class="txtc-red">*</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input type="text" class="form-control" name="price_sell" placeholder="e.g. 30000" value="{{ $product->price_sell }}">
                                    </div>
                                    {!! $errors->first('price_sell', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Category --}}
                                <div class="col-md-6 form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label>Kategori</label>
                                    <select name="category" class="form-control select2">
                                        <option selected disabled>Pilih kategori</option>
                                        
                                        @foreach ($category as $item)
                                            @if ($product->categories_id == $item->id)
                                                <option selected value="{{ $item->id }}">{{ $item->category_name }}</option>
                                            @else    
                                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Label --}}
                                <div class="col-md-6 form-group{{ $errors->has('label') ? ' has-error' : '' }}">
                                    <label>Label</label>
                                    <select name="label" class="form-control select2">
                                        <option selected disabled>Pilih label</option>
                                        
                                        @foreach ($label as $item)
                                            @if ($product->labels_id == $item->id)
                                                <option selected value="{{ $item->id }}">{{ $item->label_name }}</option>
                                            @else    
                                                <option value="{{ $item->id }}">{{ $item->label_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- SKU --}}
                                <div class="col-md-6 form-group{{ $errors->has('sku') ? ' has-error' : '' }}">
                                    <label>SKU</label>
                                    <input type="text" class="form-control" name="sku" placeholder="e.g. SKU" value="{{ $product->sku }}">
                                    {!! $errors->first('sku', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Barcode --}}
                                <div class="col-md-6 form-group{{ $errors->has('barcode') ? ' has-error' : '' }}">
                                    <label>Barcode</label>
                                    <input type="text" class="form-control" name="barcode" placeholder="e.g. Barcode" value="{{ $product->barcode }}">
                                    {!! $errors->first('barcode', '<p class="help-block">:message</p>') !!}
                                </div>

                                <!-- Gambar -->
                                <div class="col-md-12 form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                                    @if ($product->img !== null)
                                        <img style="display:block;margin:auto;" src="{{ asset('img/product/'.$product->img) }}" class="img-responsive"><br>
                                    @endif
                                        
                                    <label>Gambar Produk <small><i class="txtc-red">(Isi jika ingin mengganti gambar)</i></small></label>
                                    <input type="file" class="form-control" name="img" value="{{ $product->img }}">
                                    {!! $errors->first('img', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Note --}}
                                <div class="col-md-12 form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                    <label>Catatan</label>
                                    <textarea class="form-control textarea" name="note" rows="10" cols="30" placeholder="e.g. Barcode">{{ $product->note }}</textarea>
                                    {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-green pull-right">Ubah</button>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <b><span class="txtc-red">*</span> Wajib diisi</b>
                        </div>
                    </div>
                </div>

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
    </script>
@endsection