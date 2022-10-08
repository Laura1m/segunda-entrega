<?php 

$conn; 
function conectar(){ 
global $conn; 
$conn = mysql_connect("localhost","root","") or die (mysql_error()); 
mysql_select_db("registrarse",$conn) or die (mysql_error());	
} 

function desconectar() { 
mysql_close($conn); 
} 

?> 