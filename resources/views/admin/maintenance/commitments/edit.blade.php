@extends('admin.layouts.app')

@section('css')
    
@endsection

@section('content')

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Editar Compromiso</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('commitment.index') }}">Compromisos</a></li>
                    <li class="breadcrumb-item active">Editar Compromiso</li>
                    </ol>
                </div>
                
            </div>

        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="page-content-wrapper">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @include('admin.maintenance.commitments.form', ['url' => 'admin/commitment/' . $commitment->IdCommitment, 'method' => 'PUT'])
                    </div>
                </div>
            </div>

        </div>
        <!-- end container-fluid -->
    </div> 

@endsection

@section('js')
    
@endsection