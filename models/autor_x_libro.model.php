<?php

require_once('../config/config.php');

class AutorXLibroModel{

    public function todos(){

        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM autor_x_libro";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($autor_x_libro_id){

        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM autor_x_libro WHERE autor_x_libro_id = $autor_x_libro_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($autor_id, $libro_id){
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            $cadena = "INSERT INTO autor_x_libro (autor_id, libro_id) VALUES ($autor_id, $libro_id)";
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

    public function actualizar($autor_x_libro_id, $autor_id, $libro_id){
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            $cadena = "UPDATE autor_x_libro SET autor_id = $autor_id, libro_id = $libro_id WHERE autor_x_libro_id = $autor_x_libro_id";
            if(mysqli_query($con, $cadena)){
                return $autor_x_libro_id;
            }else{
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        }finally{
            $con->close();
        }
    }

    public function eliminar($autor_x_libro_id){
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            $cadena = "DELETE FROM autor_x_libro WHERE autor_x_libro_id = $autor_x_libro_id";
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