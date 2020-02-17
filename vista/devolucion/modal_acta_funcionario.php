<!-- Modal -->
<?php
setlocale(LC_ALL, "es_ES");
include "funciones.php";
?>
<div class="modal fade" id="modalActaFuncionario" tabindex="-1" role="dialog" aria-labelledby="modalActaFuncionarioTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalActaFuncionarioTitle">Acta de Devolución</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div id="contenidoActa">
<table class="table table-bordered" >
  <thead>
    <tr>
      <th scope="col" class="text-center">
        <img src="../imagenes/logo_lunel.png" class="img-fluid">
      </th>
      <th scope="col" colspan="4" class="text-center">
        <h4>
          <strong>
            Software Inventory<br>
            Acta de devolución
          </strong>
        </h4>
      </th>
      <th scope="col" class="text-center">
        <strong>
            Fecha y hora impresion:<br>
            <?php
echo date('Y-m-d H:i:s');
?>
        </strong>
      </th>
    </tr>
    <tr>
      <th scope="col" colspan="6" class="text-center">
        ACTA DE ENTREGA - EQUIPOS DE COMPUTO
      </th>
    </tr>
    </thead>
    <tr>
      <td scope="col" colspan="6">Hoy <label id="dia"></label> del mes de <label id="mes"></label> del <label id="anio"></label> en la bodega de lunel-ie, se realiza la entrega formal de los equipos computacionales que se indican en el punto 2. EQUIPOS COMPUTACIONALES ASIGNADOS para el cumplimiento de las actividades del proyecto <label id="nombre_proyecto"></label> , quienes declara recepción de los mismos en buen estado y se comprometen a cuidar de los recursos y hacer uso de ellos para los fines establecidos.</td>
    </tr>
  </table>
  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" colspan="6">1. FUNCIONARIO RESPONSABLE</th>
    </tr>
    <tr>
      <td scope="col" colspan="3">Nombre completo</td>
      <td scope="col" colspan="3" id="persona_entrega"><?php echo $actaFuncionario[0]["persona_entrega"]; ?></td>
    </tr>
    <tr>
      <td scope="col" colspan="3">Cargo</td>
      <td scope="col" colspan="3"><label id="nombre_cargo"></label></td>
    </tr>
    <tr>
      <th scope="col" colspan="6">2. EQUIPOS COMPUTACIONALES ASIGNADOS</th>
    </tr>
    <table id="contenidoActaDevolucionFuncionario" class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Serial</th>
          <th scope="col">Tipo equipo</th>
          <th scope="col">Modelo</th>
          <th scope="col">Marca</th>
          <th scope="col">Sistema operativo</th>
          <th scope="col">RAM</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </thead>
  <tbody>
    <tr>
      <th scope="col" colspan="6">
        3. TIEMPO ESTIMADO DE USO
      </th>
    </tr>
    <tr>
      <td scope="col" colspan="6">Se establece que el FUNCIONARIO RESPONSABLE dispondrá del equipamiento por ________ meses, por lo que la fecha estimada de DEVOLUCIÓN  es _______________.</td>
    </tr>
    <tr>
      <th scope="col" colspan="6">
        4. ENTREGA
      </th>
    </tr>
    <tr>
      <td scope="col" colspan="6">
        <table class="table table-bordered">
          <thead>
            <tr class="text-center">
              <th>Entregado por:</th>
              <th>Recibido por:</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr class="text-center">
              <th>Nombre y cargo</th>
              <th>Coordinador del proyecto</th>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <th scope="col" colspan="6">
        5. DEVOLUCIÓN
      </th>
    </tr>
    <tr>
      <td scope="col" colspan="6">Se establece que el FUNCIONARIO RESPONSABLE dispondrá del equipamiento por ________ meses, por lo que la fecha estimada de DEVOLUCIÓN  es _______________.</td>
    </tr>
    <tr>
      <td scope="col" colspan="5" class="text-right"><p><small><em>Fecha y hora impresion :<?php echo date('Y-m-d H:i:s'); ?></small></em></p></td>
    </tr>
  </tbody>
</table>
</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn_imprimir"><i class="fas fa-print"></i></button>
        <button type="button" class="btn btn-success" id="btn_excel"><i class="fas fa-file-excel"></i></button>
        <button type="button" class="btn btn-danger" id="btn_pdf"><i class="far fa-file-pdf"></i></button>
      </div>
    </div>
  </div>
</div>
