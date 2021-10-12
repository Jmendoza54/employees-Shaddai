<div class="modal fade" id="modal-update-down-date" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Baja de empleado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="body-cont">
                <img src="{{asset('img/error.svg')}}" alt="Warning" class="icon-alert">
                <h3 class="info-delete">¿Desea dar de baja al empleado?</h3>
                <form action="" id="form-update-down-date">
                    @csrf @method('PATCH')
                    <input type="hidden" name="id" id="id">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="down-date">Fecha de baja</label>
                            <input type="date" class="form-control" name="down_date" required>
                        </div>    
                    </div>
                    
                </form>
            </div>
            @include('partials.spinner')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger" form="form-update-down-date">Dar de Baja</button>
        </div>
      </div>
    </div>
</div>