@extends('admin.layouts.app')

@section('css')
    
    <!-- DataTables -->
    <link href="{{ asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />     

@endsection

@section('content')
    
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Sistema de Informes</h4>
                    <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Listado de Informes</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-light btn-rounded dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-settings-outline mr-1"></i> Opciones
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                {{-- <a class="dropdown-item" id="btnOpenModalImport" data-toggle="modal" data-target="#myModal">Importar data</a> --}}
                                <a class="dropdown-item" href="{{ route('report.create') }}">Nuevo</a>
                                {{-- <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a> --}}
                                
                            </div>
                        </div>
                    </div>
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
                        <div class="card-body">
        
                            <h4 class="header-title">Listado de Normas</h4>
                            {{-- <p class="card-title-desc">DataTables has most features enabled by
                                default, so all you need to do to use it with your own tables is to call
                                the construction function: <code>$().DataTable();</code>.
                            </p> --}}
        
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    
                                    <th>Cotización</th>
                                    <th>Cliente</th>
                                    <th>Ejecutivo</th>
                                    <th>Fecha Expedición</th>
                                    <th>Tipo</th>
                                    <th>A nombre de</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @isset($reports)
                                        @foreach ($reports as $report)
                                            <tr>
                                                
                                                <td>{{ $report->QuoteNumber }}</td>
                                                <td>{{ $report->BusinessName }}</td>
                                                <td>{{ $report->BusinessExecutive }}</td>
                                                <td>{{ date('d/m/Y', strtotime($report->Expedition)) }}</td>
                                                <td>{{ $report->type->Description }}</td>
                                                <td>{{ $report->ToName }}</td>
                                                <td>
                                                    @include('admin.reports.delete', $report)
                                                </td>
                                            </tr>        
                                        @endforeach
                                    @endisset    
                                </tbody>
                            </table>
        
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> 

        </div> <!-- container-fluid -->
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('norm.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Importar data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="font-size-16">Seleccione un archivo</h5>
                        <div class="col-md-12 mb-12">
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="validationCustomFile" accept=".xls,.xlsx" required>
                                <label class="custom-file-label" for="validationCustomFile">Choose file...</label>
                                <div class="invalid-feedback">
                                    Example invalid custom file feedback
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Importar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
@endsection

@section('js')
    
    <!-- Required datatable js -->
    <script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('js/pages/datatables.init.js') }}"></script>

    <script>
        $('#datatable').dataTable( {
            'ordering': false
        } );
    </script>
@endsection