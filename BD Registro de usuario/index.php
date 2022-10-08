
<?php 





//Comprobacion de datos 
//variables valores por defecto 
$name = ""; 
$nameValue = ""; 
$username = ""; 
$usernameValue = ""; 
$password1 = ""; 
$password2 = ""; 
$passwordValue = ""; 
$email1 = ""; 
$emailValue = ""; 
$existusername = ""; 
$existEmail = ""; 

$existeU = 0; 
$existeE = 0; 


//Validacion de datos enviados 
if(isset($_POST['send'])){ 
if(!validateName($_POST['name'])) 
$name = "error"; 
if(!validateUsername($_POST['username'])) 
$username = "error"; 
if(!validateExistUsername($_POST['username'])) 
$existusername = "error"; 
if(!validatePassword1($_POST['password1'])) 
$password1 = "error"; 
if(!validatePassword2($_POST['password1'], $_POST['password2'])) 
$password2 = "error"; 
if(!validateEmail($_POST['email'])) 
$email1 = "error"; 
if(!validateExistMail($_POST['email'])) 
$existEmail = "error"; 
//Guardamos valores para que no tenga que reescribirlos 
$nameValue = $_POST['name']; 
$usernameValue = $_POST['username']; 
$emailValue = $_POST['email']; 
$passwordValue = $_POST['password2']; 


//Comprobamos si todo ha ido bien 
if($name != "error" && $username != "error" && $password1 != "error" && $password2 != "error" && $email1 != "error"){	
if($existusername == "error"){ 
$existeU = 1;	
} 
if($existEmail == "error"){ 
$existeE = 1;	
} 
if (!$existeU && !$existeE){ 
$status = 1; 
} 
} 


} 


?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ES"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>Registro de usuarios</title> 
<link rel="stylesheet" href="main.css" type="text/css" media="screen" /> 
</head> 
<body> 
<div class="wrapper">	
<div class="section"> 
<?php if(!isset($status)): ?> 

<h1>Formulario de Registro</h1> 

<form id="form1" action="index.php" method="post"> 
<label for="name">Nombre 
<?php if ($name == "error"): 
echo "<span style=color:red>A-z, mínimo 5 caracteres</span>"; 
else: 
echo "<span style=color:green>"; 
endif;
?></label><br />

<input tabindex="1" name="name" id="name" type="text" class="text <?php echo $name ?>" value="<?php echo $nameValue ?>" /><br />   

<label for="username">Nombre de usuario 
<?php 
if ($username == "error" || $existusername == "error"): 
if ($existusername == "error"): 
echo "<span style=color:red>El usuario " . $usernameValue . " ya existe</span>"; 
else: 
echo "<span style=color:red>Caracteres de A-z, mínimo 5 caracteres (No números)</span>"; 
endif; 
else: 
//echo "<span style=color:green>Caracteres de A-z, mínimo 5 caracteres (No números)</span>"; 
endif; ?> 
</label><br />   

<input tabindex="2" name="username" id="username" type="text" class="text <?php if ($existeU == 1):	echo $existusername; else: echo $username; endif;?>" value="<?php echo $usernameValue;?>" /><br />  

<label for="password1">Contraseña 
<?php if ($password1 == "error"): 
echo "<span style=color:red>Mínimo 5 caracteres, máximo 12 caracteres, letras y números</span>"; 
else: 
echo "<span style=color:green>"; 
endif; ?></label><br />   
<input tabindex="3" name="password1" id="password1" type="password" class="text <?php echo $password1 ?>" value="" /><br />   

<!-- METODO 1 -->
<!--<label for="password2">Repetir Contraseña <?php if ($password2 == "error"): echo "<span style=color:red>"; else: echo "<span style=color:green>"; endif; ?>Debe ser igual a la anterior</span></label><br /> -->  

<!-- METODO 2 -->
<label for="password2">Repetir Contraseña 
<?php if ($password2 == "error"): 
echo "<span style=color:red>Debe ser igual a la anterior</span>"; 
else: 
echo "<span style=color:green>"; 
endif;
 ?></label><br />  

<input tabindex="4" name="password2" id="password2" type="password" class="text <?php echo $password2 ?>" value="" /> <br />  

<label for="email"> <span>Email</span> 
<?php 
if ($email1 == "error" || $existEmail == "error"): 
if ($existEmail == "error"): 
echo "<span style=color:red>El email " . $emailValue . " ya existe"; 
else: 
echo "<span style=color:red>Escribe un email válido por favor"; 
endif; 
else: 
//echo "<span style=color:green>Escribe un email válido por favor</span>"; 
endif; ?> 
</label> <br />  
<input tabindex="5" name="email" id="email" type="text" class="text <?php echo $email1 ?>" value="<?php echo $emailValue ?>" /> <br />  
<div> 
<input tabindex="6" name="send" id="send" type="submit" class="submit" value="Enviar formulario" /><b /> 
</div> 
</form> 

<?php else: ?> 
<?php
$respuesta=insertarReg($nameValue, $usernameValue, $passwordValue, $emailValue);

if($respuesta==1): ?>
<h1>Registro introducido correctamente en la base de datos</h1> 

<div class="respuesta_insert"> 
<p>Gracias por registrarte.</p> 
<p>Te hemos mandado un mail a <span style="color:green"><?php echo $emailValue; ?></span> para que confirmes el alta. Si no lo recibes comprueba la bandeja de correo no deseado</p> 
<p>Gracias!</p> 
<br><br> 
<p>Administrador</p> 

<!-- <p>La clave que se enviará por URL es --> <?php //echo $url; ?> </p> 
</div> 

<?php mailActivacion($emailValue, $username, $url); ?> 

<!-- 
<div style="font-color: red"> 
<ul> 
<li>Name: <?php $nameValue; ?></li> 
<li>Username: <?php $usernameValue; ?></li> 
<li>Password: <?php $passwordValue; ?></li> 
<li>Email: <?php $emailValue; ?></li> 
</ul> --> 

<?php else: ?>
<p style="font-color: red">No se ha podido insertar el registro en nuestra base de datos</p>
<!--<h1>�Formulario enviado con �xito!</h1>-->
<?php endif; ?>
<?php endif; ?>
</div> 
</div> 
</body> 
</html> 
