<?php
  /* Llamamos al archivo de conexion.php */
  require_once("../../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../html/MainHead.php");?>
    <title>Mant. Categoria</title>
  </head>

  <body>
  <?php require_once("../html/MainMenu.php");?>
 
    <!-- ########## START: HEAD PANEL ########## -->
    <div class="br-header">
      <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div>
      <?php require_once("../html/MainHeader.php");?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Mantenimiento Categoria</a>
          </nav>
        </div><!-- br-pageheader -->
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
          <h4 class="tx-gray-800 mg-b-5">Categoria</h4>
          <p class="mg-b-0">Mantenimiento Categorias</p>
        </div>

        <div class="br-pagebody">

          <div class="br-section-wrapper">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Categorias</h6>
            <p class="mg-b-30 tx-gray-600">Listado de Categorias</p>
            
            <button class="btn btn-outline-primary" id="add_button" onclick="nuevo()"><i class="fa fa-plus-square mg-r-10"></i>Nuevo Registro</button>
            
            <p></p>
            <div class="pd-x-15 pd-b-15">
                <div class="table-wrapper">
                    <table id="categoria_data" class="table display responsive wrap">
                      <thead>
                            <tr>
                            <th class="wd-15p">Nombre del Curso</th>
                            
                            <th class="wd-10p">Editar</th>
                            <th class="wd-10p">Eliminar</th>
                            </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    </div>
    <?php require_once("modalmantenimiento.php"); ?>
    <?php require_once("../html/MainJs.php");?>
    <script type="text/javascript" src="adminmntcategoria.js"></script>
  </body>
</html>
<?php
  }else{
    /* si no a iniciado sesion se redirecciona a la ventana principal */
    header("Location:".conectar::ruta()."vista/404/");
  }
?>