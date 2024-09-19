<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

require_once('../models/autor_x_libro.model.php');
error_reporting(0);
$autor_x_libro = new AutorXLibroModel();

switch($_GET["op"]){

    case 'todos':

        $datos = array();
        $datos = $autor_x_libro->todos();
        while($row = mysqli_fetch_assoc($datos)){
            $todos[] = $row;
        }
        echo json_encode($todos);
    break;
    
    case 'uno':

        $autor_x_libro_id = $_GET["autor_x_libro_id"];
        $datos = array();
        $datos = $autor_x_libro->uno($autor_x_libro_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
    break;

    case 'insertar':

        $autor_id = $_POST["autor_id"];
        $libro_id = $_POST["libro_id"];
        $datos = array();
        $datos = $autor_x_libro->insertar($autor_id, $libro_id);
        echo json_encode($datos);
    break;

    case 'actualizar':

        $autor_x_libro_id = $_POST["autor_x_libro_id"];
        $autor_id = $_POST["autor_id"];
        $libro_id = $_POST["libro_id"];
        $datos = array();
        $datos = $autor_x_libro->actualizar($autor_x_libro_id, $autor_id, $libro_id);
        echo json_encode($datos);
    break;

    case 'eliminar':

        $autor_x_libro_id = $_POST["autor_x_libro_id"];
        $datos = array();
        $datos = $autor_x_libro->eliminar($autor_x_libro_id);
        echo json_encode($datos);
    break;

}
