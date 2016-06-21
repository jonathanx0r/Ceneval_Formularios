<?php
/*objeto que inserta un nuevo usuario en la base de datos,
por default lo inserta como no vaido (0 no valido, 1 valido).*/
class inserta{
	/*variables*/
	private $campos_a_insertar;
	private $nombre_campos;
	private $tabla;
	/*constructor*/
	public function __construct($fields, $name_fields, $table){
		$this->campos_a_insertar = $fields;
		$this->nombre_campos = $name_fields;
		$this->tabla = $table;
	}
	/*metodos*/
	public function insertar_en_tabla(){
		include 'conectar.php';
		$campos_tabla = crea_cadena($this->nombre_campos,0);
		$campos_add = crea_cadena($this->campos_a_insertar,1);
		$query = "insert into $this->tabla ($campos_tabla) values ($campos_add)";
		/*echo $query;*/
		$result = mysqli_query($conexion_db, $query);

		if (!$result){
		    /*echo "Fallo al ejecutar la consulta: (" . $conexion_db->errno . ") " . $conexion_db->error;*/
		    return -1;
		}else{
			/*header('Location: ../../Sitio_Final.html'); colocar redireccionamiento correcto*/
		}
	}
}

function crea_cadena($valores,$flag){
	$cadena="";
	if ($flag==0){
		for($i=0;$i<count($valores);$i++){
			if ($i==0){
				$cadena=$valores[$i];
			}else{
				$cadena=$cadena.", ".$valores[$i];
			}
		}
		return $cadena;
	}else if ($flag==1){
		for($i=0;$i<count($valores);$i++){
			if ($i==0){
				$cadena="'".$valores[$i]."'";
			}else{
				$cadena=$cadena.", '".$valores[$i]."'";
			}
		}
		return $cadena;
	}
}

?>