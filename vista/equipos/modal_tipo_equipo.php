<!-- Modal -->
<div class="modal fade" id="modalTipoEquipo" tabindex="-1" role="dialog" aria-labelledby="modalTipoEquipoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTipoEquipoLabel">Crear Tipo Equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_tipo_equipo" method="POST">
          <input type="hidden" id="id_equipo">
          <div class="form-group row">
            <label for="serial_equipo" class="col-sm-3 col-form-label">Nombre tipo equipo:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nombre_tipo_equipo" required="true" style="text-transform:uppercase;">
            </div>
            <div class="col-sm-1 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button data-accion="crear" type="submit" class="btn btn-success" id="btn_guardar_tipo_equipo">Crear</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
