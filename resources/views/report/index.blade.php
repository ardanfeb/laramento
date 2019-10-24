@extends('layouts.backend')

@section('content')
    <div class="content-wrapper">
        
        {{-- Title + Breadcrumb --}}
        <section class="content-header container-fluid">
            <ol class="breadcrumb">
                <li class="active"><a href="{{ route('report.index') }}"><i class="fas fa-book"></i>Report</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            
        </section>
    </div>
@endsection

@section('js')

@endsection
