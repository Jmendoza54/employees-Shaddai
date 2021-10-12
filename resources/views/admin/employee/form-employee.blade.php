<div class="modal fade" id="modal-employee-{{$action}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{ $title }} Employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" id="form-employee-{{$action}}" class="body-cont" accept-charset="UTF-8"  enctype="multipart/form-data">
                @csrf 
                @if($action == 'update')
                    @method('PATCH')
                    <input type="hidden" name="id" id="id">
                @endif
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nombre&#40;s&#41;</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname">Apellido&#40;s&#41;</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="sede">Sede</label>
                        <select id="sede" name="sede" class="form-control" aria-describedby="inputGroupPrepend" required>
                            <option value="">Selecciona una opción...</option>
                            <option value="El Punto Corner">El Punto Corner</option>
                            <option value="CEDIS">CEDIS</option>
                            <option value="Splash">Splash</option>
                            <option value="Corporativa">Corporativa</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="job">Puesto</label>
                        <input type="text" class="form-control" id="job" name="job" required>
                    </div>    
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="admission_date">Fecha de ingreso</label>
                        <input type="date" class="form-control" id="admission_date" name="admission_date" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="admission_date">Num Seguro Social</label>
                        <input type="text" class="form-control" id="nss" name="nss" required>
                    </div>
                </div>

                @if($action == 'add')
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="div-img">
                                <label for="url_photo">Arrastrar o Seleccionar Imagen</label>
                                <input type="file" class="form-control-file" name="url_photo" id="url_photo" accept=".jpg, .jpeg">
                            </div>
                        </div>
                    </div>
                @endif
                
                

            </form>
        @include('partials.spinner')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="form-employee-{{$action}}" id="submit-form-employee">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  