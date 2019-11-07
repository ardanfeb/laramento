@extends('layouts.backend')

@section('css')
    <style>
        .report-title {
            margin-bottom: 13px;
            font-weight: 600;
        }
        .report-img {
            padding: 20px 0;
        }
        .report-desc {
            padding: 15.5px 0;
        }
        .fa {
            font-size: 30px;
        }
        .report-card {
            padding: 0;
            margin: 0;
        }
        .report-sub {
            color: #999;
            font-size: 13px;
        }
        .report-dl-btn {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-top-width: 1px;
            border-top-color: #eaeaea;
            font-weight: 600;
        }
        .report-dl-btn:hover {
            background-color: #eaeaea;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li class="active"><a href="{{ route('report.index') }}"><i class="fas fa-book"></i>Laporan</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            
            {{-- General Report --}}
            <div class="row">

                {{-- Sales --}}
                <div class="col-md-3">
                    <p class="report-title">Sales</p>
                    <div class="panel panel-default">
                        <div class="panel-body row report-card">
                            <div class="report-img col-xs-4 text-center">
                                <span class="fa fa-cash-register"></span>
                            </div>
                            <div class="report-desc col-xs-8">
                                <b class="report-title txtc-green">Sales</b><br/>
                                <b class="report-sub">Download all sales</b>
                            </div>
                        </div>
                        <button class="btn report-dl-btn btn-block panel-footer">Download</button>
                    </div>
                </div>

                {{-- Product --}}
                <div class="col-md-3">
                    <p class="report-title">Product</p>
                    <div class="panel panel-default">
                        <div class="panel-body row report-card">
                            <div class="report-img col-xs-4 text-center">
                                <span class="fa fa-shopping-bag"></span>
                            </div>
                            <div class="report-desc col-xs-8">
                                <b class="report-title txtc-green">Product</b><br/>
                                <b class="report-sub">All product</b>
                            </div>
                        </div>
                        <button class="btn report-dl-btn btn-block panel-footer">Download</button>
                    </div>
                </div>
            </div>

            {{-- Inventory --}}
            <p class="report-title">Inventory Report</p>
            <div class="row">

                {{-- All Stock --}}
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body row report-card">
                            <div class="report-img col-xs-4 text-center">
                                <span class="fa fa-boxes"></span>
                            </div>
                            <div class="report-desc col-xs-8">
                                <b class="report-title txtc-green">All Stock</b><br/>
                                <b class="report-sub">All stock available</b>
                            </div>
                        </div>
                        <button class="btn report-dl-btn btn-block panel-footer">Download</button>
                    </div>
                </div>

                {{-- Stock In --}}
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body row report-card">
                            <div class="report-img col-xs-4 text-center">
                                <span class="fa fa-boxes"></span>
                            </div>
                            <div class="report-desc col-xs-8">
                                <b class="report-title txtc-green">Stock In</b><br/>
                                <b class="report-sub">All stock in</b>
                            </div>
                        </div>
                        <button class="btn report-dl-btn btn-block panel-footer">Download</button>
                    </div>
                </div>

                {{-- Stock Out --}}
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body row report-card">
                            <div class="report-img col-xs-4 text-center">
                                <span class="fa fa-boxes"></span>
                            </div>
                            <div class="report-desc col-xs-8">
                                <b class="report-title txtc-green">Stock Out</b><br/>
                                <b class="report-sub">All stock out</b>
                            </div>
                        </div>
                        <button class="btn report-dl-btn btn-block panel-footer">Download</button>
                    </div>
                </div>

                {{-- Stock Opname --}}
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body row report-card">
                            <div class="report-img col-xs-4 text-center">
                                <span class="fa fa-boxes"></span>
                            </div>
                            <div class="report-desc col-xs-8">
                                <b class="report-title txtc-green">Stock Opname</b><br/>
                                <b class="report-sub">All stock opname</b>
                            </div>
                        </div>
                        <button class="btn report-dl-btn btn-block panel-footer">Download</button>
                    </div>
                </div>

                {{-- Purchase Order --}}
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body row report-card">
                            <div class="report-img col-xs-4 text-center">
                                <span class="fa fa-boxes"></span>
                            </div>
                            <div class="report-desc col-xs-8">
                                <b class="report-title txtc-green">Purchase Order</b><br/>
                                <b class="report-sub">All purchase order</b>
                            </div>
                        </div>
                        <button class="btn report-dl-btn btn-block panel-footer">Download</button>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

@section('js')

@endsection
