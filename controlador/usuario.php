<?php
 /* Llamando a cadena de Conexion */
 require_once("../config/conexion.php");
 /* Llamando a la clase */
 require_once("../models/Usuario.php");
 /* Inicializando Clase */
 $usuario = new Usuario();
 /* Opcion de solicitud de controller */
 switch($_GET["op"]){

     /* MicroServicio para poder mostrar el listado de cursos de un usuario con certificado */
        case "listar_cursos":
            $datos=$usuario->get_cursos_x_usuario($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["cur_nom"];
                $sub_array[] = $row["cur_fechaini"];
                $sub_array[] = $row["cur_fechafin"];
                $sub_array[] = $row["ins_nombre"]." ".$row["ins_apellip"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["curdet_id"].');"  id="'.$row["curdet_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
                $data[] = $sub_array;
            }

         $results = array(
             "sEcho"=>1,
             "iTotalRecords"=>count($data),
             "iTotalDisplayRecords"=>count($data),
             "aaData"=>$data);
         echo json_encode($results);
         break;
        /* Microservicio para mostar informacion del certificado con el curd_id */
        case "mostrar_curso_detalle":
            $datos= $usuario->get_curso_x_id_detalle($_POST["curdet_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["curdet_id"] = $row["curdet_id"];
                    $output["cur_id"] = $row["cur_id"];
                    $output["cur_nom"] = $row["cur_nom"];
                    $output["cur_descrip"] = $row["cur_descrip"];
                    $output["cur_fechaini"] = $row["cur_fechaini"];
                    $output["cur_fechafin"] = $row["cur_fechafin"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apellip"] = $row["usu_apellip"];
                    $output["usu_apellim"] = $row["usu_apellim"];
                    $output["ins_id"] = $row["ins_id"];
                    $output["ins_nombre"] = $row["ins_nombre"];
                    $output["ins_apellip"] = $row["ins_apellip"];
                    $output["ins_apellim"] = $row["ins_apellim"];
                }

                echo json_encode($output);
            }
        
            break;
       /* Total de Cursos por usuario para el dashboard */
       case "total":
        $datos=$usuario->get_total_cursos_x_usuario($_POST["usu_id"]);
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row)
            {
                $output["total"] = $row["total"];
            }
            echo json_encode($output);
        }
        break;
       /* MicroServicio para poder mostrar el listado de cursos de un usuario con certificado */
       case "listar_cursos_top10":
            $datos=$usuario->get_cursos_x_usuario_top10($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["cur_nom"];
                $sub_array[] = $row["cur_fechaini"];
                $sub_array[] = $row["cur_fechafin"];
                $sub_array[] = $row["ins_nombre"]." ".$row["ins_apellip"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["curdet_id"].');"  id="'.$row["curdet_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;
       /* Mostrar informacion del usuario en la vista perfil */
       case "mostrar":
            $datos = $usuario->get_usuario_x_id($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apellip"] = $row["usu_apellip"];
                    $output["usu_apellim"] = $row["usu_apellim"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_sex"] = $row["usu_sex"];
                    $output["usu_contra"] = $row["usu_contra"];
                    $output["usu_telefono"] = $row["usu_telefono"];
                    $output["rol_id"] = $row["rol_id"]; 
                }
                echo json_encode($output);
            }
            break;
       /* Actualizar datos de perfil */
       case "update_perfil":
            $usuario->update_usuario_perfil(
                $_POST["usu_id"],
                $_POST["usu_nom"],
                $_POST["usu_apellip"],
                $_POST["usu_apellim"],
                $_POST["usu_contra"],
                $_POST["usu_sex"],
                $_POST["usu_telefono"]
            );
            break;
       /* Guardar y editar cuando se tenga el ID */
       case "guardaryeditar":
            if(empty($_POST["usu_id"])){
                $usuario->insert_usuario($_POST["usu_nom"],$_POST["usu_apellip"],$_POST["usu_apellim"],$_POST["usu_correo"],$_POST["usu_contra"],$_POST["usu_sex"],$_POST["usu_telefono"],$_POST["rol_id"]);
            }else{
                $usuario->update_usuario($_POST["usu_id"],$_POST["usu_nom"],$_POST["usu_apellip"],$_POST["usu_apellim"],$_POST["usu_correo"],$_POST["usu_contra"],$_POST["usu_sex"],$_POST["usu_telefono"],$_POST["rol_id"]);
            }
            break;
       /* Eliminar segun ID */
       case "eliminar":
            $usuario->delete_usuario($_POST["usu_id"]);
            break;
       /*  Listar toda la informacion segun formato de datatable */
       case "listar":
            $datos=$usuario->get_usuario();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["usu_nom"];
                $sub_array[] = $row["usu_apellip"];
                $sub_array[] = $row["usu_apellim"];
                $sub_array[] = $row["usu_correo"];
                $sub_array[] = $row["usu_telefono"];
                if($row["rol_id"]==1){
                    $sub_array[]="Usuario";
                }else{
                    $sub_array[]="Admin";
                }
                $sub_array[] = '<button type="button" onClick="editar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';                
                $data[] = $sub_array;   
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
       /* Listar todos los usuarios pertenecientes a un curso */ 
       case "listar_cursos_usuario":
            $datos=$usuario->get_cursos_usuario_x_id($_POST["cur_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["cur_nom"];
                $sub_array[] = $row["usu_nom"]." ".$row["usu_apellip"]." ".$row["usu_apellim"];
                $sub_array[] = $row["cur_fechaini"];
                $sub_array[] = $row["cur_fechafin"];
                $sub_array[] = $row["ins_nombre"]." ".$row["ins_apellip"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["cur_id"].');"  id="'.$row["cur_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cur_id"].');"  id="'.$row["cur_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;
       case "listar_detalle_usuario":
                $datos=$usuario->get_usuario_modal($_POST["cur_id"]);
                $data= Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = "<input type='checkbox' name='detallecheck[]' value='". $row["usu_id"] ."'>";
                    $sub_array[] = $row["usu_nom"];
                    $sub_array[] = $row["usu_apellip"];
                    $sub_array[] = $row["usu_apellim"];
                    $sub_array[] = $row["usu_correo"];
                    $data[] = $sub_array;
                }
    
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                break;
    }
        
?>