   <!-- ########## START: LEFT PANEL ########## -->
   <div class="br-logo"><a href="../Usu_home/"><span>[</span>Santo Tomás<span>]</span></a></div>
    <div class="br-sideleft overflow-y-auto">
      <label class="sidebar-label pd-x-15 mg-t-20">Menú</label>
      <div class="br-sideleft-menu">
        <a href="../Usu_home/" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Inicio</span>
          </div>
    <?php
      if($_SESSION["rol_id"]==1){
        ?>
          <a href="../Usu_curso/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mis Cursos</span>
            </div>
          </a>
        <?php
      }else{
        ?>
          <a href="../Adminmntusuario/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mnt. Usuario</span>
            </div>
          </a>

          <a href="../Adminmntcurso/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mnt. Curso</span>
            </div>
          </a>

          <a href="../Adminmntinstructor/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mnt. Instructor</span>
            </div>
          </a>

          <a href="../Adminmntcategoria/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mnt. Categoria</span>
            </div>
          </a>

          <a href="../Admindetallecertificado/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Detalle Certificado</span>
            </div>
          </a>
        <?php
      }
    ?>
        <a href="../Usu_perfil/" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-gear-outline tx-20"></i>
            <span class="menu-item-label">Perfil</span>
          </div>
        </a>
        <a href="../html/Logout.php" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-power tx-20"></i>
            <span class="menu-item-label">Cerrar Sesión</span>
          </div>
        </a>

      </div>
    </div>