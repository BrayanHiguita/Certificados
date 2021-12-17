<?php
    class Curso extends conectar{
        public function insert_curso($cat_id,$cur_nom,$cur_descrip,$cur_fechaini,$cur_fechafin,$ins_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO curso (cur_id, cat_id, cur_nom, cur_descrip, cur_fechaini, cur_fechafin, ins_id, fech_crea, estado) VALUES (NULL,?,?,?,?,?,?, now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $cur_nom);
            $sql->bindValue(3, $cur_descrip);
            $sql->bindValue(4, $cur_fechaini);
            $sql->bindValue(5, $cur_fechafin);
            $sql->bindValue(6, $ins_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function update_curso($cur_id,$cat_id,$cur_nom,$cur_descrip,$cur_fechaini,$cur_fechafin,$ins_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE curso
                SET
                    cat_id =?,
                    cur_nom = ?,
                    cur_descrip = ?,
                    cur_fechaini = ?,
                    cur_fechafin = ?,
                    ins_id = ?
                WHERE
                    cur_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $cur_nom);
            $sql->bindValue(3, $cur_descrip);
            $sql->bindValue(4, $cur_fechaini);
            $sql->bindValue(5, $cur_fechafin);
            $sql->bindValue(6, $ins_id);
            $sql->bindValue(7, $cur_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function delete_curso($cur_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE curso
                SET
                    estado = 0
                WHERE
                    cur_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cur_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_curso(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                curso.cur_id,
                curso.cur_nom,
                curso.cur_descrip,
                curso.cur_fechaini,
                curso.cur_fechafin,
                curso.cat_id,
                categoria.cat_nom,
                curso.ins_id,
                instructor.ins_nombre,
                instructor.ins_apellip,
                instructor.ins_apellim,
                instructor.ins_correo,
                instructor.ins_sex,
                instructor.ins_telefono
                FROM curso
                INNER JOIN categoria on curso.cat_id = categoria.cat_id
                INNER JOIN instructor on curso.ins_id = instructor.ins_id
                WHERE curso.estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_curso_id($cur_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM curso WHERE estado = 1 AND cur_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cur_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function delete_curso_usuario($curdet_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE td_cursousu
                SET
                    estado = 0
                WHERE
                    curdet_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $curdet_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function insert_curso_usuario($cur_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO td_cursousu (curdet_id,cur_id,usu_id,fech_crea,estado) VALUES (NULL,?,?,now(),1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cur_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();

            $sql1="select last_insert_id() as 'curdet_id'";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetch(pdo::FETCH_ASSOC);
        }
    }
?>
