<?php
    /* Llamando a cadena de Conexion */
    require_once("../config/conexion.php");
    /* Llamando a la clase */
    require_once("../models/Instructor.php");
    /* Inicializando Clase */
    $instructor = new Instructor();

    /* Opcion de solicitud de controller */
    switch($_GET["op"]){
        /* Guardar y editar cuando se tenga el ID */
        case "guardaryeditar":
            if(empty($_POST["ins_id"])){
                $instructor->insert_instructor($_POST["ins_nombre"],$_POST["ins_apellip"],$_POST["ins_apellim"],$_POST["ins_correo"],$_POST["ins_sex"],$_POST["ins_telefono"]);
            }else{
                $instructor->update_instructor($_POST["ins_id"],$_POST["ins_nombre"],$_POST["ins_apellip"],$_POST["ins_apellim"],$_POST["ins_correo"],$_POST["ins_sex"],$_POST["ins_telefono"]);
            }
            break;
        /* Creando Json segun el ID */
        case "mostrar":
            $datos = $instructor->get_instructor_id($_POST["ins_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["ins_id"] = $row["ins_id"];
                    $output["ins_nombre"] = $row["ins_nombre"];
                    $output["ins_apellip"] = $row["ins_apellip"];
                    $output["ins_apellim"] = $row["ins_apellim"];
                    $output["ins_correo"] = $row["ins_correo"];
                    $output["ins_sex"] = $row["ins_sex"];
                    $output["ins_telefono"] = $row["ins_telefono"];
                }
                echo json_encode($output);
            }
            break;
        /* Eliminar segun ID */
        case "eliminar":
            $instructor->delete_instructor($_POST["ins_id"]);
            break;
        /*  Listar toda la informacion segun formato de datatable */
        case "listar":
            $datos=$instructor->get_instructor();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["ins_nombre"];
                $sub_array[] = $row["ins_apellip"];
                $sub_array[] = $row["ins_apellim"];
                $sub_array[] = $row["ins_correo"];
                $sub_array[] = $row["ins_telefono"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["ins_id"].');"  id="'.$row["ins_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["ins_id"].');"  id="'.$row["ins_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        /*  Listar toda la informacion segun formato de datatable */
        case "combo":
            $datos=$instructor->get_instructor();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['ins_id']."'>".$row['ins_nombre']." ".$row['ins_apellip']." ".$row['ins_apellim']."</option>";
                }
                echo $html;
            }
            break;
    }
?>