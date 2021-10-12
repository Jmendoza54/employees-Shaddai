<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="body-cont">
                <img src="{{asset('img/error.svg')}}" alt="Warning" class="icon-alert">
                <h3 class="info-delete">¿Desea eliminar el registro?</h3>
                <form action="" id="{{ $form }}">
                    @csrf @method('DELETE')
                    <input type="hidden" name="id" id="id">
                </form>
            </div>
            @include('partials.spinner')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger" form="{{ $form }}">Eliminar</button>
        </div>
      </div>
    </div>
  </div>