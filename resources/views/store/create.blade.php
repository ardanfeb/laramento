@extends('layouts.backend')

@section('css')
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.index') }}"><i class="fas fa-store-alt fa-sm"></i>Store</a></li>
                <li class="active"><a href="{{ route('store.create') }}">Create</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            {{-- Store --}}
            <div class="row">

                {{-- List of Store --}}
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Store Information</b>
                        </div>
                        <div class="panel-body row">

                            {{-- Form add store --}}
                            <form action="{{ route('store.store') }}" method="post">
                                {{ csrf_field() }}

                                {{-- Nama --}}
                                <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Store Name :</label>
                                    <input type="" class="form-control" name="name" placeholder="e.g. John Store">
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Phone --}}
                                <div class="col-md-12 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label>Phone Number :</label>
                                    <input type="" class="form-control" name="phone" placeholder="e.g. 08123456789">
                                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Address --}}
                                <div class="col-md-12 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label>Address :</label>
                                    <textarea class="form-control" name="address" rows="2" cols="80" placeholder="e.g. JL. Jalan"></textarea>
                                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Type --}}
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                        <label>Store Type :</label>
                                        <select name="type" class="form-control">
                                            <option selected disabled>Choose type store</option>
                                            <option value="bakery">Bakery</option>
                                            <option value="barbershop">Barbershop</option>
                                            <option value="cafe">Cafe</option>
                                            <option value="foodtruck">Foodtruck</option>
                                            <option value="franchise">Franchise</option>
                                            <option value="restaurant">Restaurant</option>
                                            <option value="retail">Retail</option>
                                        </select>
                                        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-green pull-right">Submit</button>
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