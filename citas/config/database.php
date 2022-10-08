<?php
class database{
public $host = "localhost" ; //servidor
public $user = "root";
public $pass ="";
public $db = "citas";
public $conexion;

function connectToDatabase[] {
$this=>conexion = mysqli_connect($this=>host, $this=>user, $this=>pass, $this=>db );

if (mysqli_connect_error()){
echo 'error de conexion' . mysqli_connect_error();
}
return $this=> conexion;

}
}