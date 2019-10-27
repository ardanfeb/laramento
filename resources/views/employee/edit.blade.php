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
                <li class="active"><a href="{{ route('employee.edit', $user->id) }}">Ubah</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            {{-- employee --}}
            <div class="row">

                {{-- List of employee --}}
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Informasi Karyawan</b>
                        </div>
                        <div class="panel-body">

                            {{-- Form add supplier --}}
                            <form action="{{ route('employee.update', $user->id) }}" method="post">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="row">

                                        {{-- Nama --}}
                                        <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="name" placeholder="e.g. John Doe" value="{{ $user->name }}">
                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>
        
                                        {{-- Email --}}
                                        <div class="col-md-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label>Email</label>
                                            <input type="" class="form-control" name="email" placeholder="e.g. john.doe@gmail.com" value="{{ $user->email }}">
                                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                        </div>
        
                                        {{-- Phone --}}
                                        <div class="col-md-12 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label>No. Telpon</label>
                                            <input type="" class="form-control" name="phone" placeholder="e.g. 08123456789" value="{{ $user->phone }}">
                                            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                        </div>
        
                                        {{-- Birthdate --}}
                                        <div class="col-md-6 form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                                            <label for="">Tanggal Lahir</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fas fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="e.g. 2019-02-12" data-date-format="yyyy-mm-dd" value="{{ $user->birthdate }}">
                                            </div>
                                            {!! $errors->first('birthdate', '<p class="help-block">:message</p>') !!}
                                        </div>
        
        
                                        {{-- Gender --}}
                                        <div class="col-md-6 form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                            <label>Jenis Kelamin</label>
                                            <select name="gender" class="form-control">
                                                <option selected disabled>Choose gender</option>
                                                <option {{ $user->gender == 'laki-laki' ? 'selected' : '' }} value="laki-laki">Laki-Laki</option>
                                                <option {{ $user->gender == 'perempuan' ? 'selected' : '' }} value="perempuan">Perempuan</option>
                                            </select>
                                            {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
                                        </div>
        
                                        {{-- Address --}}
                                        <div class="col-md-12 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                            <label>Alamat</label>
                                            <textarea class="form-control" name="address" rows="3" cols="80" placeholder="e.g. JL. Jalan">{{ $user->address }}</textarea>
                                            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                        </div>
                                            
                                        {{-- role --}}
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                                <label>Posisi</label>
                                                <select name="role" id="role" class="form-control" onchange="run()">
                                                    <option selected disabled>Choose job role</option>
                                                    @role('owner')
                                                    <option {{ $user->role_id == 1 ? 'selected' : '' }} value="1">Owner</option>
                                                    @endrole
                                                    <option {{ $user->role_id == 2 ? 'selected' : '' }} value="2">Admin</option>
                                                    <option {{ $user->role_id == 3 ? 'selected' : '' }} value="3">Member</option>
                                                </select>
                                                {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
        
                                        {{-- Password --}}
                                        {{-- <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label>Password :</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password">
                                                    <span class="input-group-btn">
                                                        <button id="showpass" type="button" class="btn btn-default btn-flat"><i class="fa fa-eye"></i></button>
                                                    </span>
                                                </div>
                                                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div> --}}

                                        <div class="col-md-12">
                                            <button type="submit" class="btn bg-green pull-right">Ubah</button>
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
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        $('#birthdate').datepicker({
            autoclose: true
        })

        if (document.getElementById("role").value == 1) {
            $('#storeForm').hide();
        } else {
            $('#storeForm').show();
        }

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