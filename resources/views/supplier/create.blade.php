@extends('layouts.backend')

@section('css')
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li><a href="{{ route('supplier.index') }}"><i class="fas fa-user-friends fa-sm"></i>Supplier</a></li>
                <li class="active"><a href="{{ route('supplier.create') }}">Create</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            {{-- Supplier --}}
            <div class="row">

                {{-- List of Supplier --}}
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Supplier Information</b>
                        </div>
                        <div class="panel-body">

                            {{-- Form add supplier --}}
                            <form action="{{ route('supplier.store') }}" method="post">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="row">

                                        {{-- Nama --}}
                                        <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label>Name</label>
                                            <input type="" class="form-control" name="name" placeholder="e.g. John Doe">
                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>

                                        {{-- Phone --}}
                                        <div class="col-md-12 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label>Phone Number</label>
                                            <input type="" class="form-control" name="phone" placeholder="e.g. 08123456789">
                                            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                        </div>

                                        {{-- Address --}}
                                        <div class="col-md-12 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address" rows="1" cols="80" placeholder="e.g. JL. Jalan"></textarea>
                                            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                        </div>

                                        {{-- Note --}}
                                        <div class="col-md-12 form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                            <label>Note</label>
                                            <textarea class="form-control" name="note" rows="3" cols="80" placeholder="e.g. Keterangan lain-lain"></textarea>
                                            {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="btn bg-green pull-right">Submit</button>
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
@endsection