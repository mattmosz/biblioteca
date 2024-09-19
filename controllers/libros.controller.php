<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

require_once('../models/libros.model.php');
error_reporting(0);
$libros = new LibrosModel();

switch($_GET["op"]){

    case 'todos':

        $datos = array();
        $datos = $libros->todos();
        while($row = mysqli_fetch_assoc($datos)){
            $todos[] = $row;
        }
        echo json_encode($todos);
    break;
    
    case 'uno':

        if (isset($_GET["libro_id"])) {
            $libro_id = $_GET["libro_id"];
            $datos = array();
            $datos = $libros->uno($libro_id);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
        } else {
            echo json_encode(array("error" => "libro_id no está definido"));
        }
    break;

    case 'insertar':

        $titulo = $_POST["titulo"];
        $genero = $_POST["genero"];
        $fecha_publicacion = $_POST["fecha_publicacion"];
        $isbn = $_POST["isbn"];
        $datos = array();
        $datos = $libros->insertar($titulo, $genero, $fecha_publicacion, $isbn);
        echo json_encode($datos);
    break;

    case 'actualizar':

        $libro_id = $_POST["libro_id"];
        $titulo = $_POST["titulo"];
        $genero = $_POST["genero"];
        $fecha_publicacion = $_POST["fecha_publicacion"];
        $isbn = $_POST["isbn"];
        $datos = array();
        $datos = $libros->actualizar($libro_id, $titulo, $genero, $fecha_publicacion, $isbn);
        echo json_encode($datos);
    break;

    case 'eliminar':

        $libro_id = $_POST["libro_id"];
        $datos = array();
        $datos = $libros->eliminar($libro_id);
        echo json_encode($datos);
    break;

}