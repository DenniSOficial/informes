@extends('admin.layouts.app')

@section('css')
    
    <style>
        .moveall,
        .removeall {
        border: 1px solid #ccc !important;
        
        &:hover {
            background: #efefef;
        }
        }

        // Only included because button labels aren't showing 

        .moveall::after {
        content: attr(title);
        
        }

        .removeall::after {
        content: attr(title);
        }

        // Custom styling form
        .form-control option {
            padding: 10px;
            border-bottom: 1px solid #efefef;
        }
    </style>
@endsection

@section('content')

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Editar Informe</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('report.index') }}">Informes</a></li>
                    <li class="breadcrumb-item active">Editar Informe</li>
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
                        @include('admin.reports.form', ['url' => 'admin/report/' . $report->IdReport, 'method' => 'PUT'])
                    </div>
                </div>
            </div>

        </div>
        <!-- end container-fluid -->
    </div> 

@endsection

@section('js')
    
    <script src="https://cdn.rawgit.com/crlcu/multiselect/master/dist/js/multiselect.min.js"></script>

    <!-- plugin -->
    <script src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js"></script>
    <link rel="stylesheet" type="text/css" href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">

    <script type = "text/javascript">

        
        $("#findQuote").click(function(){
        
            var nro = $('#quote').val();
            console.log('nro:::', nro);

            if (nro === '') {
            //alert('Debe de ingresar el nro de cotizacion');
            Swal.fire({
                icon: 'error',
                title: 'Sistemas Análiticos Generales',
                text: 'Debe de ingresar el N° de cotización.',
            });
            return;
            }

            limpiarControles();

            var url_ = $('.urlBuscarCotizacion').data('url');
            console.log('url_:::', url_);
            var data_ = {
            nro: nro
            };
                    
            $.ajax({
            url: url_,
            type: 'POST',
            headers: {'X-CSRF-Token': $("input[name=_token]").val()},
            dataType: 'json',
            data: data_,
            success: function(response) {
                console.log('response:::', response);
                if (response.message == 'Ok') {
                var cliente = response.data['cliente'];
                var contactos = response.data['contactos'];
                $('#business_id').val(cliente.nIdCliente);
                $('#business_name').val(cliente.cNombreClie);
                $('#business_executive').val(cliente.EjecutivoComercial);
                $('#business_executive_code').val(cliente.codvend);
                } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Sistemas Análiticos Generales',
                    text: response.message
                });
                }
            },
            error: function(err) {
                console.log('err:::', err);
            }
            });

        });

        function limpiarControles() {
            $('#id_cliente').val('');
            $('#cliente').val('');
            $('#contacto').val('');
            $('#email').val('');
            $('#telefono_cliente').val('');
            $('#lugar').val('');
            $('#empresa').val('');
            $('#planta').val('');
            $('#proyecto').val('');
        }
    </script>

    <script>
        var demo1 = $('select[name="commitments[]"]').bootstrapDualListbox({
        nonSelectedListLabel: 'Compromisos registrados',
        selectedListLabel: 'Compromisos seleccionados',
        preserveSelectionOnMove: 'moved',
        moveAllLabel: 'Move all',
        removeAllLabel: 'Remove all'
        });
        $("#demoform").submit(function() {
            alert($('[name="commitments[]"]').val());
            return false;
        });
    </script>
@endsection