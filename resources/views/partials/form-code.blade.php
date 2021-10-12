<form action="" id="form-{{ $action }}-code">
    @csrf 
    @if($action == 'update')
        <input type="hidden" name="id">
    @endif
    @if ($action == 'update' || $action == 'apply')
        @method('PATCH') 
    @endif

    @if ($action == 'add' || $action == 'update')
        @php $readonly = 'readonly'; @endphp 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="employee_id">Empleado</label>
                <select class="form-control" name="employee_id" id="employee_id" required></select>
            </div>
        </div>
    @else
        @php $required = 'required'; @endphp 
    @endif
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="code">Código de autorización</label>
            <input type="text" class="form-control" name="code" required {{ $readonly ?? '' }}>
        </div>
        <div class="form-group col-md-6">
            <label for="total">Total</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input type="text" class="form-control only-number" name="total" {{ $required ?? '' }}>
            </div>
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="sede">Sede</label>
            <select class="form-control" name="sede" {{ $required ?? '' }}>
                <option value="">Choose...</option>
                <option value="El Punto">El Punto</option>
                <option value="Splash">Splash</option>
                <option value="The Jungle">The Jungle</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="kind_apply">Tipo de aplicación</label>
            <select class="form-control" name="kind_apply" {{ $required ?? '' }}>
                <option value="">Choose...</option>
                <option value="Descuento">Descuento</option>
                <option value="Cortesía">Cortesía</option>
            </select>
        </div>
    </div>
    @if ($action == 'add' || $action == 'update')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="status">Estatus</label>
                <select class="form-control" name="status">
                    <option value="">Elige un estatus</option>
                    <option value="0">No Aplicado</option>
                    <option value="1">Aplicado</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="application_date">Fecha de uso</label>
                <input type="date" class="form-control" name="application_date">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="form-group">
                    <label for="comments">Comentarios</label>
                    <textarea class="form-control" name="comments" rows="3"></textarea>
                  </div>
            </div>
        </div>
    @endif
    @if ($action == 'apply')
        <button type="submit" class="btn btn-light">Aplicar Código</button>
    @endif
    
</form>