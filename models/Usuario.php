<?php
    class Usuario extends conectar{
        /* funcion para login de acceso de usuario */
        public function login(){
            $conectar=parent::conexion();parent::set_names();
            if(isset($_POST["enviar"])){
                $correo=$_POST["usu_correo"];
                $contra=$_POST["usu_contra"];
                if(empty($correo)and empty($contra)){
                    /* En caso esten vacios correo y contraseña, devolver al index con mensaje = 2 */
                    header("Location:".conectar::ruta()."index.php?m=2");
                    exit();
                }else{
                    $sql="SELECT * FROM usuario WHERE usu_correo=? and usu_contra=? and estado=1";
                    $stmt=$conectar->prepare($sql);
                    $stmt->bindValue(1,$correo);
                    $stmt->bindValue(2,$contra);
                    $stmt->execute();$resultado=$stmt->fetch();
                    if(is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_apellip"]=$resultado["usu_apellip"];
                        $_SESSION["usu_correo"]=$resultado["usu_correo"];
                        $_SESSION["rol_id"]=$resultado["rol_id"];
                        /* si todo esta correcto indexar en Home */
                        header("location:".conectar::ruta()."vista/Usu_home");
                    }else{
                        /* En caso no coincidan el usuario o la contraseña */
                        header("Location:".conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        } 
        /* Mostrar los cursos en los cuales esta inscrito el usuario */
        public function get_cursos_x_usuario($usu_id){
            $conectar =parent::conexion();
            parent::set_names();
            $sql=" SELECT  
                td_cursousu.curdet_id,
                curso.cur_id,
                curso.cur_nom,
                curso.cur_descrip,
                curso.cur_fechaini,
                curso.cur_fechafin,
                usuario.usu_id,
                usuario.usu_nom,
                usuario.usu_apellip,
                usuario.usu_apellim,
                instructor.ins_id,
                instructor.ins_nombre,
                instructor.ins_apellip,
                instructor.ins_apellim
                FROM td_cursousu INNER JOIN
                curso ON td_cursousu.cur_id = curso.cur_id INNER JOIN
                usuario ON td_cursousu.usu_id = usuario.usu_id INNER JOIN
                instructor ON curso.ins_id = instructor.ins_id
                WHERE
                td_cursousu.usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_cursos_usuario_x_id($curdet_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                    td_cursousu.curdet_id,
                    curso.cur_id,
                    curso.cur_nom,
                    curso.cur_descrip,
                    curso.cur_fechaini,
                    curso.cur_fechafin,
                    usuario.usu_id,
                    usuario.usu_nom,
                    usuario.usu_apellip,
                    usuario.usu_apellim,
                    instructor.ins_id,
                    instructor.ins_nombre,
                    instructor.ins_apellip,
                    instructor.ins_apellim
                    FROM td_cursousu INNER JOIN 
                    curso ON td_cursousu.cur_id = curso.cur_id INNER JOIN
                    usuario ON td_cursousu.usu_id = usuario.usu_id INNER JOIN
                    instructor ON curso.ins_id = instructor.ins_id
                    WHERE 
                    curso.cur_id = ?
                    AND td_cursousu.estado = 1";
                    $sql=$conectar->prepare($sql);
                    $sql->bindValue(1,$curdet_id);
                    $sql->execute();
                    return $resultado=$sql->fetchAll();
        }
        /* Mostrar todos los datos de un curso por su id de detalle*/
        public function get_curso_x_id_detalle($curdet_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                td_cursousu.curdet_id,
                curso.cur_id,
                curso.cur_nom,
                curso.cur_descrip,
                curso.cur_fechaini,
                curso.cur_fechafin,
                usuario.usu_id,
                usuario.usu_nom,
                usuario.usu_apellip,
                usuario.usu_apellim,
                instructor.ins_id,
                instructor.ins_nombre,
                instructor.ins_apellip,
                instructor.ins_apellim
                FROM td_cursousu INNER JOIN
                curso ON td_cursousu.cur_id = curso.cur_id INNER JOIN
                usuario ON td_cursousu.usu_id = usuario.usu_id INNER JOIN
                instructor ON curso.ins_id = instructor.ins_id
                WHERE
                td_cursousu.curdet_id=?";                
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $curdet_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        /* Cantidad de Cursos por Usuario */
        public function get_total_cursos_x_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM td_cursousu WHERE usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        /* Mostrar todos los cursos en los cuales esta inscrito un usuario */
        public function get_cursos_x_usuario_top10($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                td_cursousu.curdet_id,
                curso.cur_id,
                curso.cur_nom,
                curso.cur_descrip,
                curso.cur_fechaini,
                curso.cur_fechafin,
                usuario.usu_id,
                usuario.usu_nom,
                usuario.usu_apellip,
                usuario.usu_apellim,
                instructor.ins_id,
                instructor.ins_nombre,
                instructor.ins_apellip,
                instructor.ins_apellim
                FROM td_cursousu INNER JOIN 
                curso ON td_cursousu.cur_id = curso.cur_id INNER JOIN
                usuario ON td_cursousu.usu_id = usuario.usu_id INNER JOIN
                instructor ON curso.ins_id = instructor.ins_id
                WHERE 
                td_cursousu.usu_id = ?
                AND td_cursousu.estado = 1
                LIMIT 10";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        /* Mostrar los datos del usuario segun el ID */
        public function get_usuario_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuario WHERE estado=1 AND usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        /* Actualizar la informacion del perfil del usuario segun ID */
        public function update_usuario_perfil($usu_id,$usu_nom,$usu_apellip,$usu_apellim,$usu_contra,$usu_sex,$usu_telefono){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE usuario 
                SET
                    usu_nom = ?,
                    usu_apellip = ?,
                    usu_apellim = ?,
                    usu_contra = ?,
                    usu_sex = ?,
                    usu_telefono = ?
                WHERE
                    usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_apellip);
            $sql->bindValue(3, $usu_apellim);
            $sql->bindValue(4, $usu_contra);
            $sql->bindValue(5, $usu_sex);
            $sql->bindValue(6, $usu_telefono);
            $sql->bindValue(7, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
        /* Funcion para insertar usuario */
        public function insert_usuario($usu_nom,$usu_apellip,$usu_apellim,$usu_correo, $usu_contra,$usu_sex,$usu_telefono,$rol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO usuario (usu_id, usu_nom,usu_apellip,usu_apellim,usu_correo, usu_contra,usu_sex,usu_telefono,rol_id,fech_reg, estado) VALUES (NULL,?,?,?,?,?,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_apellip);
            $sql->bindValue(3, $usu_apellim);
            $sql->bindValue(4, $usu_correo);
            $sql->bindValue(5, $usu_contra);
            $sql->bindValue(6, $usu_sex);
            $sql->bindValue(7, $usu_telefono);
            $sql->bindValue(8, $rol_id);

            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        /* Funcion para actualizar usuario */
        public function update_usuario($usu_id,$usu_nom,$usu_apellip,$usu_apellim,$usu_correo, $usu_contra,$usu_sex,$usu_telefono,$rol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE usuario
                SET
                    usu_nom= ?,
                    usu_apellip=?,
                    usu_apellim=?,
                    usu_correo=?,
                    usu_contra=?,
                    usu_sex=?,
                    usu_telefono=?,
                    rol_id=?
                WHERE
                    usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_apellip);
            $sql->bindValue(3, $usu_apellim);
            $sql->bindValue(4, $usu_correo);
            $sql->bindValue(5, $usu_contra);
            $sql->bindValue(6, $usu_sex);
            $sql->bindValue(7, $usu_telefono);
            $sql->bindValue(8, $rol_id);
            $sql->bindValue(9, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        /* Eliminar cambiar de estado a la usuario */
        public function delete_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE usuario
                SET
                    estado = 0
                WHERE
                    usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        /* Listar todas las usuario */
        public function get_usuario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuario WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        /* Listar todas las categorias */
        public function get_usuario_modal($cur_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuario 
                WHERE estado = 1
                AND usu_id not in (select usu_id from td_cursousu where cur_id=? AND estado=1)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cur_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>