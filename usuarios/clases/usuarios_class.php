<?PHP
class usuarios extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _usuarios_sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM usuarios u 
		LEFT JOIN usuarios_perfil up ON (u.idusuarios = up.idusuarios)
		LEFT JOIN perfil p  ON (up.idperfil= p.idperfil)".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getAcceso($pass, $login){
		$sql= $this->_usuarios_sql("*", "MD5(u.usuario)='".md5($login)."' AND u.password_md5 = '".md5($pass)."' AND u.estado = 1");
		$rs=$this->consultar($sql);
		if($rs[0]['idusuarios']>0){
			return $rs[0];
		}else{
			throw new Exception("Usuario o Contraseña Invalidos Intente de Nuevo.");
		}
	}
	public function getallUsers(){
		return $this->consultar($this->_usuarios_sql("u.*, UPPER(u.nombres) AS nombres, UPPER(u.apellidos) AS apellidos, UPPER(CONCAT_WS(' ',u.nombres, u.apellidos)) AS userName","","u.idusuarios","u.nombres ASC, u.apellidos ASC "));
	}

	public function getUser($idusuarios){
		$rs = $this->consultar($this->_usuarios_sql("u.*, UPPER(CONCAT_WS(' ',nombres, apellidos)) AS userName","u.idusuarios=".$idusuarios,"u.idusuarios","u.nombres ASC, u.apellidos ASC "));
		return $rs[0];
	}
	public function getPerfil($idusuarios){
		$rs = $this->consultar($this->_usuarios_sql("p.*, UPPER(p.descripcion) AS descripcion","u.idusuarios=".$idusuarios,"p.idperfil"));
		return $rs[0];
	}
	public function _combo($nombre, $id, $sel, $where){
		$rs=$this->consultar($this->_usuarios_sql("*, UPPER(CONCAT_WS(' ',u.nombres, u.apellidos)) AS userName",$where,"u.idusuarios","u.nombres"));
		$html='<select name="'.$nombre.'" id="'.$id.'" class="validate[required]">';
			$html.='<option value="" >select</option>';
		foreach ($rs as $u) {
			$html.='<option value="'.$u['idusuarios'].'" '.(($sel==$u['idusuarios'])?'selected="selected"':'').'>'.$u['userName'].'</option>';
		}
		$html.='</select>';
		return $html;
	}
}
?>