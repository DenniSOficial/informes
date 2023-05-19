{{ Form::open(['url' => $url, 'method' => $method]) }}
    <div class="card-body">

        <h4 class="header-title">Registrar informe</h4>

        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">N° Cotización</label>
            <div class="col-md-3">
                {{ Form::text('quote', isset($report->QuoteNumber) ? $report->QuoteNumber : old('quote'), ['class' => ($errors->has('quote')) ? 'form-control is-invalid' : 'form-control', 'id' => 'quote']) }}
                @if ($errors->has('quote'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quote') }}
                    </div>    
                @endif
            </div>
            <div class="col-md-1">
                <a id="findQuote" class="btn btn-secondary"><i class="fas fa-search"></i></a>
            </div>

            <label for="example-text-input" class="col-md-2 col-form-label">Informe Lab.</label>
            <div class="col-md-4">
                {{ Form::text('laboratory', isset($report->QuoteNumber) ? $report->LaboratoryReportNumber : old('laboratory'), ['class' => 'form-control', 'id' => 'laboratory']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-email-input" class="col-md-2 col-form-label">Razón Social</label>
            <div class="col-md-10">
                {{ Form::hidden('business_id', isset($report->IdClient) ? $report->IdClient : old('business_id'), ['id' => 'business_id']) }}
                {{ Form::text('business_name', isset($report->BusinessName) ? $report->BusinessName : old('business_name'), ['class' => ($errors->has('business_name')) ? 'form-control is-invalid' : 'form-control', 'id' => 'business_name', 'readonly']) }}
                @if ($errors->has('business_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('business_name') }}
                    </div>    
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="example-url-input" class="col-md-2 col-form-label">Ejecutivo Comercial</label>
            <div class="col-md-10">
                {{ Form::hidden('business_executive_code', isset($report->BusinessExecutiveCode) ? $report->BusinessExecutiveCode : old('business_executive_code'), ['id' => 'business_executive_code']) }}
                {{ Form::text('business_executive', isset($report->BusinessExecutive) ? $report->BusinessExecutive : old('business_executive'), ['class' => ($errors->has('business_executive')) ? 'form-control is-invalid' : 'form-control', 'id' => 'business_executive', 'readonly']) }}
                @if ($errors->has('business_executive'))
                    <div class="invalid-feedback">
                        {{ $errors->first('business_executive') }}
                    </div>    
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-md-2 col-form-label">Responsable</label>
            <div class="col-md-4">
                <select name="report_manager" id="report_manager" placeholder="Seleccione" class="custom-select  {{ ($errors->has('report_manager')) ? 'is-invalid' : '' }}">
                    <option value="">Seleccione</option>
                    @if ($report_managers)
                        @foreach ($report_managers as $manager)
                            <option value="{{ $manager->IdReportManager }}" {{ (isset($report->IdReportManager) ? (($report->IdReportManager == $manager->IdReportManager) ? 'selected' : '') : old('report_manager') == $manager->IdReportManager ? 'selected' : '') }}>{{ $manager->full_name }}</option>    
                        @endforeach    
                    @endif
                </select>
                @if ($errors->has('report_manager'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report_manager') }}
                    </div>    
                @endif
            </div>

            <label for="example-search-input" class="col-md-2 col-form-label">Tipo reporte</label>
            <div class="col-md-4">
                {{ Form::select('type', $types, (isset($report->IdTypeReport) ? $report->IdTypeReport : old('type')), [ 'class' => ($errors->has('type')) ? 'custom-select is-invalid' : 'custom-select', 'placeholder' => 'Seleccione']) }}
                @if ($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>    
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="example-number-input" class="col-md-2 col-form-label">Fecha de expedición</label>
            <div class="col-md-4">
                {{ Form::date('expedition', isset($report->Expedition) ? $report->Expedition : '', [ 'class' => ($errors->has('expedition')) ? 'form-control is-invalid' : 'form-control']) }}
                @if ($errors->has('expedition'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expedition') }}
                    </div>    
                @endif
            </div>

            <label for="example-datetime-local-input" class="col-md-2 col-form-label">Fecha de notificación</label>
            <div class="col-md-4">
                {{ Form::date('notification', isset($report->Notification) ? $report->Notification : '', [ 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-md-2 col-form-label">A nombre de</label>
            <div class="col-md-4">
                <select name="company" id="company" placeholder="Seleccione" class="custom-select  {{ ($errors->has('company')) ? 'is-invalid' : '' }}">
                    <option value="">Seleccione</option>
                    @if ($companies)
                        @foreach ($companies as $company)
                            <option value="{{ $company }}" {{ (isset($report->IdReportManager) ? (($report->ToName == $company) ? 'selected' : '') : ( old('company') == $company ? 'selected' : '' )) }}>{{ $company }}</option>    
                        @endforeach    
                    @endif
                </select>
                @if ($errors->has('company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company') }}
                    </div>    
                @endif
            </div>

        </div>

        <h5>Compromisos</h5>

        <div class="row" style="margin-bottom: 40px;">
            <div class="col">
              
                <select multiple="multiple" size="10" name="commitments[]" title="duallistbox_demo1[]">
                    @if (isset($commitments))
                        @foreach ($commitments as $commitment)
                            {!!  $found_key = array_search($commitment->IdCommitment, array_column($report_commitments, 'IdCommitment')) !!}
                            <option value="{{ $commitment->IdCommitment }}" {{ count($report_commitments) > 0 ? ( $found_key !== false ? 'selected' : '' ) : '' }} >
                                {{ $commitment->CodeCommitment . ' - ' . $commitment->Summary }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="">
            <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
            <a href="{{ route('report.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>

{{ Form::close() }}

<span class="urlBuscarCotizacion d-none" data-url="{{ route('admin.find.cotizacion.ajax') }}"></span>