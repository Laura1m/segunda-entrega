<?php 




function mailActivacion($dir_correo, $usuario, $enlace){ 
$dominio = "http://localhost/"; 
$destinatario = $dir_correo; 
$asunto = "Activar Usuario"; 
$cuerpo = ' 
<html> 
<head> 
<title>Activar usuario</title> 
</head> 
<body> 
<h1>Hola'; 
$cuerpo .= $usuario; 
$cuerpo .= '<p><b>Gracias por registrarte en COLORATE</b>.</p> 
<p>Para completar el registro tienes que confirmar que has recibido el e-mail en el siguiente enlace:</p> 
<p style=text-align:center><a href='; 
$cuerpo .= $dominio . $enlace; 
$cuerpo .= " target=_blank>Activa tu usuario</a></p></body></html>"; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0rn"; 
$headers .= "Content-type: text/html; charset=iso-8859-1rn"; 

//dirección del remitente 
$headers .= "From: Admin <akitumail@gmail.com>rn"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
$headers .= "Reply-To: aki tu mail@gmail.comrn"; 

//ruta del mensaje desde origen a destino 
//$headers .= "Return-path: holahola@desarrolloweb.comrn"; 

//direcciones que recibián copia 
//$headers .= "Cc: maria@desarrolloweb.comrn"; 

//direcciones que recibirán copia oculta 
//$headers .= "Bcc: pepe@pepe.com,juan@juan.comrn"; 

//En localhost el envío de e-mail a veces no funciona, hay que configurar algunas cosas. 
mail($destinatario,$asunto,$cuerpo,$headers); 

} 

function generar_txtAct($longitud,$especiales){ 
// Array con los valores a escojer 
$semilla = array(); 
$semilla[] = array('a','e','i','o','u'); 
$semilla[] = array('b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','w','x','y','z'); 
$semilla[] = array('0','1','2','3','4','5','6','7','8','9'); 
$semilla[] = array('A','E','I','O','U'); 
$semilla[] = array('B','C','D','F','G','H','J','K','L','M','N','P','Q','R','S','T','V','W','X','Y','Z'); 
$semilla[] = array('0','1','2','3','4','5','6','7','8','9'); 

// si puede contener caracteres especiales, aumentamos el array $semilla 
if ($especiales) { $semilla[] = array('$','#','%','&','@','-','?','¿','!','¡','+','-','*'); } 

// creamos la clave con la longitud indicada 
for ($bucle=0; $bucle < $longitud; $bucle++) 
{ 
// seleccionamos un subarray al azar 
$valor = mt_rand(0, count($semilla)-1); 
// selecccionamos una posicion al azar dentro del subarray 
$posicion = mt_rand(0,count($semilla[$valor])-1); 
// cojemos el caracter y lo agregamos a la clave 
$clave .= $semilla[$valor][$posicion]; 
} 
// devolvemos la clave 
return $clave; 
} 

//FUNCION PARA INSERTAR EL REGISTRO EN LA TABLA users_temp 
function insertarReg($name_, $username_, $password1_, $email_){ 

//Declaramos esta variable global, para poder usarla en toda la aplicación 
global $url; 
//LLamar a la función para generar el texto aleatorio para Activar Usuario. 
//Le pasamos como parámetro los caracteres que queremos generar y si los queremos especiales o no 
$clave = generar_txtAct(20,false); 
//Montamos la estructura del enlace con la clave. 
$url = "activar.php?id=" . $clave; 


/*Teneis que declarar las variables $servidor, $usuario,$password y 
$sdb (base de datos). En mi caso para Localhost tengo lo siguiente:*/ 
$servidor = "localhost"; 
$usuario = "root"; 
$password = ""; 
$sdb = "registrarse"; 

$ilink3=mysql_connect($servidor,$usuario,$password) or die(mysql_error()); 
mysql_select_db($sdb,$ilink3); 

$inserta= "insert into users_temp (nombre,usersTemp,password,email,fecAlta,txt_Activ) values ('$name_','$username_','$password1_','$email_',CURDATE(),'$clave')"; 
$resultado3=mysql_query($inserta,$ilink3) or die (mysql_error()); 

if (!$resultado3) 
return false; 
else 
return true; 
} 

/*function validateName($name){ 
//NO cumple longitud minima 
if(strlen($name) < 5) 
return false; 
//SI longitud pero NO solo caracteres A-z 
else if(!preg_match("/^[a-zA-Z]+$/", $name)) 
return false; 
// SI longitud, SI caracteres A-z 
else 
return true; 
}*/ 

function validateName($name){ 
$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_"; 
$caracter1KO = 0; 
if(strlen($name) < 5): 
return false; 
else: 
for ($i=0; $i<strlen($name); $i++){ 
if (strpos($permitidos, substr($name,$i,1))===false){ 
$caracter1KO = 1; 
} 
} 
endif; 
if ($caracter1KO == 1 || strlen($name) <= 4): 
return false; 
else: 
return true; 
endif; 
} 

function validateUsername($username){ 
$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_ "; 
$caracterKO = 0; 
if(strlen($username) < 5): 
return false; 
else: 
for ($i=0; $i<strlen($username); $i++){ 
if (strpos($permitidos, substr($username,$i,1))===false){ 
$caracterKO = 1; 
} 
} 
endif; 
if ($caracterKO == 1 || strlen($username) <= 4): 
return false; 
else: 
return true; 
endif; 
} 


function validateExistUsername($username){ 
/*Teneis que declarar las variables $servidor, $usuario,$password y 
$sdb (base de datos). En mi caso para Localhost tengo lo siguiente:*/ 
$servidor = "localhost"; 
$usuario = "root"; 
$password = ""; 
$sdb = "registrarse"; 

$ilink=mysql_connect($servidor,$usuario,$password) or die(mysql_error()); 

mysql_select_db($sdb,$ilink); 
$consulta= "select usersTemp from users_temp where usersTemp = '$username'"; 
$resultado=mysql_query($consulta,$ilink) or die (mysql_error()); 
if (mysql_num_rows($resultado)>0) 
return false; 
else 
return true; 
} 

function validatePassword1($password1){ 
//NO tiene minimo de 5 caracteres o mas de 12 caracteres 
if(strlen($password1) < 5 || strlen($password1) > 12) 
return false; 
// SI longitud, NO VALIDO numeros y letras 
else if(!preg_match("/^[0-9a-zA-Z]+$/", $password1)) 
return false; 
// SI rellenado, SI email valido 
else 
return true; 
} 

function validatePassword2($password1, $password2){ 
//NO coinciden 
if($password1 != $password2) 
return false; 
else 
return true; 
} 

function validateEmail($email){ 

 // First, we check that there's one @ symbol, and that the lengths are right
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                return false;
            }
        }
        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                    return false;
                }
            }
        }

        return true;
    }



function validateExistMail($mail){ 
/*Teneis que declarar las variables $servidor, $usuario,$password y 
$sdb (base de datos). En mi caso para Localhost tengo lo siguiente:*/ 
$servidor = "localhost"; 
$usuario = "root"; 
$password = ""; 
$sdb = "registrarse"; 

$ilink2=mysql_connect($servidor,$usuario,$password) or die(mysql_error()); 
mysql_select_db($sdb,$ilink2); 
$consulta2= "select id_usersTemp from users_temp where email = '$mail'"; 
$resultado2=mysql_query($consulta2,$ilink2) or die (mysql_error()); 
if (mysql_num_rows($resultado2)>0) 
return false; 
else 
return true; 
} 

?> 