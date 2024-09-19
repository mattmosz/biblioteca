<?php

require_once('../config/config.php');

class LibrosModel
{

    public function todos()
    {

        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM libros";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($libro_id)
    {

        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM libros WHERE libro_id = $libro_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($titulo, $genero, $fecha_publicacion, $isbn)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            $cadena = "INSERT INTO libros (titulo, genero, fecha_publicacion, isbn) VALUES ('$titulo', '$genero', '$fecha_publicacion', '$isbn')";
            if (mysqli_query($con, $cadena)) {

                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function actualizar($libro_id, $titulo, $genero, $fecha_publicacion, $isbn)
    {

        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            $cadena = "UPDATE libros SET titulo = '$titulo', genero = '$genero', fecha_publicacion = '$fecha_publicacion', isbn = '$isbn' WHERE libro_id = $libro_id";
            if (mysqli_query($con, $cadena)) {
                return $libro_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($libro_id)
    {

        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            $cadena = "DELETE FROM libros WHERE libro_id = $libro_id";
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
