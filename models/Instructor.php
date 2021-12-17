<?php
    class Instructor extends conectar{
        public function insert_instructor($ins_nombre,$ins_apellip,$ins_apellim,$ins_correo,$ins_sex,$ins_telefono){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO instructor (ins_id, ins_nombre, ins_apellip, ins_apellim, ins_correo, ins_sex, ins_telefono, fech_crea, estado) VALUES (NULL,?,?,?,?,?,?, now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ins_nombre);
            $sql->bindValue(2, $ins_apellip);
            $sql->bindValue(3, $ins_apellim);
            $sql->bindValue(4, $ins_correo);
            $sql->bindValue(5, $ins_sex);
            $sql->bindValue(6, $ins_telefono);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function update_instructor($ins_id,$ins_nombre,$ins_apellip,$ins_apellim,$ins_correo,$ins_sex,$ins_telefono){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE instructor
                SET
                    ins_nombre =?,
                    ins_apellip = ?,
                    ins_apellim = ?,
                    ins_correo = ?,
                    ins_sex = ?,
                    ins_telefono = ?
                WHERE
                    ins_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ins_nombre);
            $sql->bindValue(2, $ins_apellip);
            $sql->bindValue(3, $ins_apellim);
            $sql->bindValue(4, $ins_correo);
            $sql->bindValue(5, $ins_sex);
            $sql->bindValue(6, $ins_telefono);
            $sql->bindValue(7, $ins_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function delete_instructor($ins_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE instructor
                SET
                    estado = 0
                WHERE
                    ins_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ins_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_instructor(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM instructor WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_instructor_id($ins_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM instructor WHERE estado = 1 AND ins_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ins_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>
