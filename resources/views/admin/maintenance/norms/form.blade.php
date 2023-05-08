<form action="" method="post">
    <div class="card-body">

        <h4 class="header-title">Registrar norma</h4>

        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">Código</label>
            <div class="col-md-4">
                <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
            </div>

            <label for="example-search-input" class="col-md-2 col-form-label">Autoridad</label>
            <div class="col-md-4">
                <select class="custom-select">
                    <option value="0">Seleccione</option>
                    @foreach ($authorities as $authority)
                        <option value="{{ $authority->IdAuthority }}">{{ $authority->Name }}</option>    
                    @endforeach
                </select>
            </div>

        </div>

        <div class="form-group row">
            <label for="example-email-input" class="col-md-2 col-form-label">Norma aplicable</label>
            <div class="col-md-10">
                <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-url-input" class="col-md-2 col-form-label">Nombre completo</label>
            <div class="col-md-10">
                <input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-tel-input" class="col-md-2 col-form-label">Nombre corto</label>
            <div class="col-md-10">
                <input class="form-control" type="tel" value="1-(555)-555-5555" id="example-tel-input">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-password-input" class="col-md-2 col-form-label">Lugar de aplicación</label>
            <div class="col-md-10">
                {{-- <input class="form-control" type="password" value="hunter2" id="example-password-input"> --}}
                <textarea class="form-control" name="" id="" cols="10" rows="5"></textarea>
            </div>
            
        </div>
        <div class="form-group row">
            <label for="example-number-input" class="col-md-2 col-form-label">Fecha de expedición</label>
            <div class="col-md-4">
                <input class="form-control" type="date" value="2019-08-19" id="example-date-input">
            </div>

            <label for="example-datetime-local-input" class="col-md-2 col-form-label">Fecha de notificación</label>
            <div class="col-md-4">
                <input class="form-control" type="date" value="2019-08-19" id="example-date-input">
            </div>

        </div>
        
    </div>
    <div class="card-footer">
        <div class="">
            <button class="btn btn-primary waves-effect waves-light" type="submit">Submit</button>
            <a href="{{ route('norm.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>