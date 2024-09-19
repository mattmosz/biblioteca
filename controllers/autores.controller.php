<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

require_once('../models/autores.model.php');
error_reporting(0);
$autores = new AutoresModel();

switch($_GET["op"]){

    case 'todos':

        $datos = array();
        $datos = $autores->todos();
        while($row = mysqli_fetch_assoc($datos)){
            $todos[] = $row;
        }
        echo json_encode($todos);
    break;
    
    case 'uno':

        $autor_id = $_GET["autor_id"];
        $datos = array();
        $datos = $autores->uno($autor_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
    break;

    case 'insertar':

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $nacionalidad = $_POST["nacionalidad"];
        $datos = array();
        $datos = $autores->insertar($nombre, $apellido, $fecha_nacimiento, $nacionalidad);
        echo json_encode($datos);
    break;

    case 'actualizar':

        $autor_id = $_POST["autor_id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $nacionalidad = $_POST["nacionalidad"];
        $datos = array();
        $datos = $autores->actualizar($autor_id, $nombre, $apellido, $fecha_nacimiento, $nacionalidad);
        echo json_encode($datos);
    break;

    case 'eliminar':

        $autor_id = $_POST["autor_id"];
        $datos = array();
        $datos = $autores->eliminar($autor_id);
        echo json_encode($datos);
    break;

}