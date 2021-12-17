<div class="br-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name hidden-md-down"><?php echo $_SESSION["usu_nom"] ?></span>
              <img src="http://via.placeholder.com/64x64" class="wd-32 rounded-circle" alt="">
              <span class="square-10 bg-success"></span>
            </a>
            <!-- usu_id del usuario -->
            <input type="hidden" id="user_idx" value="<?php echo $_SESSION["usu_id"]?>">
            <input type="hidden" id="usu_idx" value="<?php echo $_SESSION["usu_id"] ?>"><!-- Usu_id del usuario -->
            <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["rol_id"] ?>"><!-- rol_id del usuario -->
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href="../Usu_perfil/"><i class="icon ion-ios-gear"></i> Perfil</a></li>
                <li><a href="../html/Logout.php"><i class="icon ion-power"></i> Cerrar Sesión</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>