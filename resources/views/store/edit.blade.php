@extends('layouts.backend')

@section('css')
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.index') }}"><i class="fas fa-store-alt fa-sm"></i>Store</a></li>
                <li class="active"><a href="{{ route('store.edit', $data->id) }}">Edit</a></li>
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
                            <form action="{{ route('store.update', $data->id) }}" method="post">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                
                                {{-- Nama --}}
                                <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Name :</label>
                                    <input type="" class="form-control" name="name" placeholder="e.g. John Store" value="{{ $data->store_name }}">
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Phone --}}
                                <div class="col-md-12 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label>Phone Number :</label>
                                    <input type="" class="form-control" name="phone" placeholder="e.g. 08123456789" value="{{ $data->phone }}">
                                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Address --}}
                                <div class="col-md-12 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label>Address :</label>
                                    <textarea class="form-control" name="address" rows="1" cols="80" placeholder="e.g. JL. Jalan">{{ $data->address }}</textarea>
                                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Type --}}
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                        <label>Store Type :</label>
                                        <select name="type" class="form-control">
                                            <option selected disabled>Choose type store</option>

                                            @php
                                                $bakery = null;
                                                $barbershop = null;
                                                $cafe = null;
                                                $foodtruck = null;
                                                $franchise = null; 
                                                $restaurant = null; 
                                                $retail = null;
                                                if ($data->store_type == 'bakery') $bakery = 'selected';
                                                if ($data->store_type == 'barbershop') $barbershop = 'selected';
                                                if ($data->store_type == 'cafe') $cafe = 'selected';
                                                if ($data->store_type == 'foodtruck') $foodtruck = 'selected';
                                                if ($data->store_type == 'franchise') $franchise = 'selected';
                                                if ($data->store_type == 'restaurant') $restaurant = 'selected';
                                                if ($data->store_type == 'retail') $retail = 'selected';
                                            @endphp

                                            <option {{ $bakery }} value="bakery">Bakery</option>
                                            <option {{ $barbershop }} value="barbershop">Barbershop</option>
                                            <option {{ $cafe }} value="cafe">Cafe</option>
                                            <option {{ $foodtruck }} value="foodtruck">Foodtruck</option>
                                            <option {{ $franchise }} value="franchise">Franchise</option>
                                            <option {{ $restaurant }} value="restaurant">Restaurant</option>
                                            <option {{ $retail }} value="retail">Retail</option>
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