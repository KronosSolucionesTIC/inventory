<?php include "scripts.php";?>
<?php include "../../controlador/funcionario_controller.php";?>
<?php $funcionario = new funcionarioController();?>
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Funcionarios</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-right">
        <button class="btn btn-success" data-target="#modalFuncionario" data-toggle="modal" id="btn_crear_funcionario" type="button">
            Crear funcionario
        </button>
        <hr></hr>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="display" id="tablaFuncionarios" style="width:100%">
            <thead>
                <tr>
                    <th>
                        Nombres
                    </th>
                    <th>
                        Apellidos
                    </th>
                    <th>
                        Documento
                    </th>
                    <th>
                        Territorial
                    </th>
                    <th>
                        Area
                    </th>
                    <th>
                        Tipo funcionario
                    </th>
                    <th>
                        Opciones
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $funcionario->getTablaFuncionarios(0);?>
            </tbody>
            <tfoot>
                <tr>
                    <th>
                        Nombres
                    </th>
                    <th>
                        Apellidos
                    </th>
                    <th>
                        Documento
                    </th>
                    <th>
                        Territorial
                    </th>
                    <th>
                        Area
                    </th>
                    <th>
                        Tipo funcionario
                    </th>
                    <th>
                        Opciones
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php include "modal_funcionario.php";?>
<?php include "modal_territorial.php";?>
<?php include "modal_area.php";?>
<?php include "modal_proyecto.php";?>
<?php include "modal_cetap.php";?>