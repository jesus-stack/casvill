<?php
$nombre=$_POST["nombre"];
$email=$_POST["email"];
$fecha=new Datetime($_POST["fecha"]);
$hoy=new DateTime('now');
$genero=$_POST["genero"];
$grado=''; 
foreach($_POST["grado"] as $option){
   $grado=$grado.','.$option;
}

$mensaje=$_POST["mensaje"];

$interval=$fecha->diff($hoy);
$edad=$interval->format('%y');
       
$body="\nNombre: ".$nombre."\nEmail: ".$email.
    "\nfecha de nacimiento: ".$fecha->format('d-m-Y')."\nEdad:  ".$edad."\nGenero: ".$genero.
    "\nGrado Academico: ".$grado."\n\nMensaje\n".$mensaje;

mail("jisusquiros2001@gmail.com","Contacto",$body);
header("Location:contacto.html");