{{ Form::open(['url' => $url, 'method' => $method]) }}
    <div class="card-body">

        <h4 class="header-title">Registrar compromiso</h4>

        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">Código</label>
            <div class="col-md-2">
                {{ Form::text('code', isset($commitment->CodeCommitment) ? $commitment->CodeCommitment : old('code'), ['class' => ($errors->has('code')) ? 'form-control is-invalid' : 'form-control']) }}
                @if ($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>    
                @endif
            </div>

            <label for="example-search-input" class="col-md-2 col-form-label">Norma</label>
            <div class="col-md-6">
                {{ Form::select('norm', $norms, (isset($commitment->IdNorm) ? $commitment->IdNorm : old('norm')), [ 'class' => ($errors->has('norm')) ? 'custom-select is-invalid' : 'custom-select', 'placeholder' => 'Seleccione']) }}
                @if ($errors->has('norm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('norm') }}
                    </div>    
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">Fase</label>
            <div class="col-md-4">
                {{ Form::select('phase', $phases, (isset($commitment->IdPhase) ? $commitment->IdPhase : old('phase')), [ 'class' => ($errors->has('phase')) ? 'custom-select is-invalid' : 'custom-select', 'placeholder' => 'Seleccione']) }}
                @if ($errors->has('phase'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phase') }}
                    </div>    
                @endif
            </div>

            <label for="example-search-input" class="col-md-2 col-form-label">Frecuencia</label>
            <div class="col-md-4">
                {{ Form::select('frequency', $frequencies, (isset($commitment->IdFrequency) ? $commitment->IdFrequency : old('frequency')), [ 'class' => ($errors->has('frequency')) ? 'custom-select is-invalid' : 'custom-select', 'placeholder' => 'Seleccione']) }}
                @if ($errors->has('frequency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('frequency') }}
                    </div>    
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="example-email-input" class="col-md-2 col-form-label">Resumen</label>
            <div class="col-md-10">
                {{ Form::text('summary', isset($commitment->Summary) ? $commitment->Summary : '', ['class' => ($errors->has('summary')) ? 'form-control is-invalid' : 'form-control']) }}
                @if ($errors->has('summary'))
                    <div class="invalid-feedback">
                        {{ $errors->first('summary') }}
                    </div>    
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="example-password-input" class="col-md-2 col-form-label">Descripcion compromiso ambiental</label>
            <div class="col-md-10">
                {{ Form::textarea('description', isset($commitment->DescriptionEnvironmentalCommitment) ? $commitment->DescriptionEnvironmentalCommitment : '', ['class' => ($errors->has('description')) ? 'form-control is-invalid' : 'form-control', 'cols' => 10, 'rows' => 5]) }}
                @if ($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>    
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="example-url-input" class="col-md-2 col-form-label">Coordenadas UTM</label>
            <div class="col-md-4">
                {{ Form::text('utm', isset($commitment->CoordinateUTM) ? $commitment->CoordinateUTM : '', ['class' => 'form-control']) }}
            </div>
            <label for="example-url-input" class="col-md-2 col-form-label">Coordenadas NUTM</label>
            <div class="col-md-4">
                {{ Form::text('nutm', isset($commitment->CoordinateNUTM) ? $commitment->CoordinateNUTM : '', ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-tel-input" class="col-md-2 col-form-label">Impacto relacionado</label>
            <div class="col-md-10">
                {{ Form::text('impact', isset($commitment->RelatedImpact) ? $commitment->RelatedImpact : '', ['class' => 'form-control']) }}
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="">
            <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
            <a href="{{ route('commitment.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
{{ Form::close() }}