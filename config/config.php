<?php

class ClaseConectar{

    public $conexion;
    protected $db;
    private $host = "localhost";
    private $usuario = "root";
    private $pass = "";
    private $base = "ev_parcial1";

    public function ProcedimientoConectar(){
        $this->conexion = mysqli_connect($this->host, $this->usuario, $this->pass, $this->base);
        mysqli_query($this->conexion, "SET NAMES 'utf8'");
        if($this->conexion->connect_error){
            die("Error de conexión: " . $this->conexion->connect_error);
        }
        $this->db = $this->conexion;
        if($this->db==0) die ("Error de conexión: " . $this->conexion->connect_error); 

        return $this->conexion;
    }
}