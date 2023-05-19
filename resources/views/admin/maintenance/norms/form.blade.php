{{ Form::open(['url' => $url, 'method' => $method]) }}
    <div class="card-body">

        <h4 class="header-title">Registrar norma</h4>

        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">Código</label>
            <div class="col-md-4">
                {{ Form::text('code', isset($norm->CodeNorm) ? $norm->CodeNorm : old('code'), ['class' => ($errors->has('code')) ? 'form-control is-invalid' : 'form-control']) }}
                @if ($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>    
                @endif
            </div>

            <label for="example-search-input" class="col-md-2 col-form-label">Autoridad</label>
            <div class="col-md-4">
                {{ Form::select('authority', $authorities, (isset($norm->IdAuthorityApprove) ? $norm->IdAuthorityApprove : old('authority')), [ 'class' => ($errors->has('authority')) ? 'custom-select is-invalid' : 'custom-select', 'placeholder' => 'Seleccione']) }}
                @if ($errors->has('authority'))
                    <div class="invalid-feedback">
                        {{ $errors->first('authority') }}
                    </div>    
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="example-email-input" class="col-md-2 col-form-label">Norma aplicable</label>
            <div class="col-md-10">
                {{ Form::text('norm', isset($norm->ApplicableStandard) ? $norm->ApplicableStandard : '', ['class' => ($errors->has('norm')) ? 'form-control is-invalid' : 'form-control']) }}
                @if ($errors->has('norm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('norm') }}
                    </div>    
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="example-url-input" class="col-md-2 col-form-label">Nombre completo</label>
            <div class="col-md-10">
                {{ Form::text('name', isset($norm->LargeName) ? $norm->LargeName : '', ['class' => ($errors->has('name')) ? 'form-control is-invalid' : 'form-control']) }}
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>    
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="example-tel-input" class="col-md-2 col-form-label">Nombre corto</label>
            <div class="col-md-10">
                {{ Form::text('shortname', isset($norm->ShortName) ? $norm->ShortName : '', ['class' => ($errors->has('shortname')) ? 'form-control is-invalid' : 'form-control']) }}
                @if ($errors->has('shortname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shortname') }}
                    </div>    
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="example-password-input" class="col-md-2 col-form-label">Lugar de aplicación</label>
            <div class="col-md-10">
                {{ Form::textarea('place', isset($norm->PlaceApplication) ? $norm->PlaceApplication : '', ['class' => ($errors->has('place')) ? 'form-control is-invalid' : 'form-control', 'cols' => 10, 'rows' => 5]) }}
                @if ($errors->has('place'))
                    <div class="invalid-feedback">
                        {{ $errors->first('place') }}
                    </div>    
                @endif
            </div>
            
        </div>
        <div class="form-group row">
            <label for="example-number-input" class="col-md-2 col-form-label">Fecha de expedición</label>
            <div class="col-md-4">
                {{ Form::date('expedition', isset($norm->ExpeditionDate) ? $norm->ExpeditionDate : '', [ 'class' => ($errors->has('expedition')) ? 'form-control is-invalid' : 'form-control']) }}
                @if ($errors->has('expedition'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expedition') }}
                    </div>    
                @endif
            </div>

            <label for="example-datetime-local-input" class="col-md-2 col-form-label">Fecha de notificación</label>
            <div class="col-md-4">
                {{ Form::date('notification', isset($norm->NotificationDate) ? $norm->NotificationDate : '', [ 'class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group row">
            <label for="example-tel-input" class="col-md-2 col-form-label">Url</label>
            <div class="col-md-10">
                {{ Form::text('url', isset($norm->Url) ? $norm->Url : '', ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="">
            <button class="btn btn-primary waves-effect waves-light" type="submit">Submit</button>
            <a href="{{ route('norm.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
{{ Form::close() }}