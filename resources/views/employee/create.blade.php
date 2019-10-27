@extends('layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li><a href="{{ route('employee.index') }}"><i class="fas fa-user-circle"></i>Karyawan</a></li>
                <li class="active"><a href="{{ route('employee.create') }}">Tambah</a></li>
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
                            <b>Informasi Karyawan</b>
                        </div>
                        <div class="panel-body row">

                            {{-- Form add supplier --}}
                            <form action="{{ route('employee.store') }}" method="post">
                                {{ csrf_field() }}

                                {{-- Nama --}}
                                <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Nama</label>
                                    <input type="" class="form-control" name="name" placeholder="e.g. John Doe">
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Email --}}
                                <div class="col-md-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>Email</label>
                                    <input type="" class="form-control" name="email" placeholder="e.g. john.doe@gmail.com">
                                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Phone --}}
                                <div class="col-md-12 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label>No. Telpon</label>
                                    <input type="" class="form-control" name="phone" placeholder="e.g. 08123456789">
                                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Birthdate --}}
                                <div class="col-md-6 form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                                    <label for="">Tanggal Lahir</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="e.g. 2019-02-12" data-date-format="yyyy-mm-dd">
                                    </div>
                                    {!! $errors->first('birthdate', '<p class="help-block">:message</p>') !!}
                                </div>


                                {{-- Gender --}}
                                <div class="col-md-6 form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <label>Jenis Kelamin</label>
                                    <select name="gender" class="form-control">
                                        <option selected disabled>Choose gender</option>
                                        <option value="laki-laki">Laki-Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                    {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
                                </div>

                                {{-- Address --}}
                                <div class="col-md-12 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="address" rows="3" cols="80" placeholder="e.g. JL. Jalan"></textarea>
                                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                </div>
                                    
                                {{-- role --}}
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                        <label>Posisi</label>
                                        <select name="role" id="role" class="form-control" onchange="run()">
                                            <option selected disabled>Choose job role</option>
                                            @role('owner')
                                            <option value="1">Owner</option>
                                            @endrole
                                            <option value="2">Employee</option>
                                            <option value="3">Reseller</option>
                                        </select>
                                        {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label>Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password">
                                            <span class="input-group-btn">
                                                <button id="showpass" type="button" class="btn btn-default btn-flat"><i class="fa fa-eye"></i></button>
                                            </span>
                                        </div>
                                        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-green pull-right">Tambah</button>
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
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        $('#birthdate').datepicker({
            autoclose: true
        })

        $('#storeForm').hide();

        function run() {
            var role = document.getElementById("role").value;
            if (role == 1) {
                $('#storeForm').slideUp('500');
            } else {
                $('#storeForm').slideDown('500');
            }
        }

        document.getElementById("showpass").addEventListener("click", function(e){
            var password = document.getElementById("password");
            if(password.getAttribute("type")=="password"){
                password.setAttribute("type","text");
            } else {
                password.setAttribute("type","password");
            }
        });
    </script>
@endsection