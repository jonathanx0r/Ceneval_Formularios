<?php
	/*crea la conexion a la base de datos.*/
	$hostname = "p:148.216.0.150"; 
	$username = "rdglpz";
	$password = "root";
	$bdeDatos = "umichccu_sistemaIncidentes";

	if (!isset($_SESSION)){
		session_start();	
	}
	
	$conexion_db = new mysqli($hostname, $username, $password,$bdeDatos);

	if ($conexion_db->connect_error) {
	    die("Connection failed: " . $conexion_db->connect_error);
	}
	
?>