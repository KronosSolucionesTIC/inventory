<?php
//Se incluye controlador de menu nivel 1
include "../../controlador/menu_controller.php";

//Se instancia la clase menu
$menuInst = new MenuController;

?>
<div id="demo" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../../imagenes/imagen1_editada.jpg" class="img-fluid" alt="Los Angeles">
      <div class="carousel-caption d-none d-md-block text-left">
        <span class="sombreado">
          <h1><b>Outsourcing</b></h1>
          <p>Realizamos todos los procesos para el desarrollo de software de calidad, analisis y levantamiento de requerimientos...</p>
        </span>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../../imagenes/imagen2_editada.jpg" class="img-fluid" alt="Chicago">
      <div class="carousel-caption d-none d-md-block text-center">
        <span class="sombreado">
          <h1><b>Desarollo de software</b></h1>
          <p>Realizamos todos los procesos para el desarrollo de software de calidad, analisis y levantamiento de requerimientos...</p>
        </span>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../../imagenes/imagen3_editada.jpg" class="img-fluid" alt="New York">
      <div class="carousel-caption d-none d-md-block text-right">
        <span class="sombreado">
          <h1><b>Infraestructura</b></h1>
          <p>Realizamos todos los procesos para el desarrollo de software de calidad, analisis y levantamiento de requerimientos...</p>
        </span>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>


<nav class="navbar navbar-expand-lg bg-primary text-white">
  <a class="navbar-brand" href="#">Intranet LUNEL IE SAS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle bg-primary text-white" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
          Usuario
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
          <button class="dropdown-item" type="button">
            <i class="fas fa-user"></i> Usuarios
          </button>
          <button class="dropdown-item" type="button">
            <i class="fas fa-lock"></i> Roles
          </button>
          <button class="dropdown-item" type="button">
            <i class="fas fa-tag"></i> Cargos
          </button>
          <div class="dropdown-divider"></div>
          <button class="dropdown-item" type="button">
            <i class="fas fa-sign-out-alt"></i> Salir
          </button>
        </div>
      </div>
    </ul>
  </div>
</nav>
