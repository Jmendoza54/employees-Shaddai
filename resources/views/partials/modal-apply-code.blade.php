<div class="modal fade" id="modal-apply-code" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $title ?? 'Aplicando Código' }}</h5>
        </div>
        <div class="modal-body">
          <h5 class="hidden" id="msg-code"></h5>
          @include('partials.spinner')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="btn-close-modal" data-dismiss="modal" disabled>Cerrar</button>
        </div>
      </div>
    </div>
</div>