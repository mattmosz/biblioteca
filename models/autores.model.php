<?php

require_once('../config/config.php');

class AutoresModel{

    public function todos(){

        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM autores";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($autor_id){

        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM autores WHERE autor_id = $autor_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $apellido, $fecha_nacimiento, $nacionalidad){

        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            $cadena = "INSERT INTO autores (nombre, apellido, fecha_nacimiento, nacionalidad) VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$nacionalidad')";
            if(mysqli_query($con, $cadena)){

                return $con->insert_id;
            }else{
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        }finally{
            $con->close();
        }
    }

    public function actualizar($autor_id, $nombre, $apellido, $fecha_nacimiento, $nacionalidad){

        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            $cadena = "UPDATE autores SET nombre = '$nombre', apellido = '$apellido', fecha_nacimiento = '$fecha_nacimiento', nacionalidad = '$nacionalidad' WHERE autor_id = $autor_id";
            if(mysqli_query($con, $cadena)){
                return $autor_id;
            }else{
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        }finally{
            $con->close();
        }
    }

    public function eliminar($autor_id){

        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            $cadena = "DELETE FROM autores WHERE autor_id = $autor_id";
            if(mysqli_query($con, $cadena)){
                return 1;
            }else{
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        }finally{
            $con->close();
        }
    }

}