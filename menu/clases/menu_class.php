<?php
if(isset($_SERVER) && isset($_SERVER['SERVER_NAME'])){
	$SERVER_NAME = 'http://'.$_SERVER['SERVER_NAME'].'/';
        
        define('XNG_WEBSITE_URL', $SERVER_NAME);
}

class menu extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
                include($_SERVER['DOCUMENT_ROOT'].'xng/lib/bootstrap.php');
                $this->Faktury = new \Faktury\Data\FakturyRepository();
	}
      

	public function _menu_sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql="SELECT ".$campos." 
		FROM menu m
		INNER JOIN modulo_menu mm ON (m.idmenu=mm.idmenu)
		INNER JOIN modulo mo ON (mm.idmodulo=mo.idmodulo)
		INNER JOIN permisos p ON (p.modulo_idmodulo=mo.idmodulo)
		INNER JOIN perfil pe ON (p.perfil_idperfil=pe.idperfil)".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		return $sql;
	}

	private function get_menus($idperfil, $padre){
		$campos ="m.idmenu, m.descripcion, m.enlace, m.orden";
		$where="pe.idperfil=".$idperfil." AND m.estado=1 AND p.ver=1 AND m.visible=1";
                 //   if($padre)
                        $where .= " AND m.padre=".$padre;
		$groupby = "m.idmenu";
		$orderby = "m.orden";
		return $this->consultar($this->_menu_sql($campos,$where,$groupby,$orderby));
	}
	public function getMenuData($where){
		$campos ="m.*";
		$groupby = "m.idmenu";
		$orderby = "m.orden";
		$rs= $this->consultar($this->_menu_sql($campos,$where,$groupby,$orderby));
		return $rs[0];
	}
	public function make_menu ($idperfil,$padre=0){
		$html='<ul>';
		$padres = $this->get_menus($idperfil,$padre);
		if(!empty($padres)){
			foreach ($padres as $p) {
				$html.='<li>';
				$html.='<a href="'.(($p['enlace']=="")?'#': XNG_WEBSITE_URL .($p['enlace'])).'">'.$p['descripcion'].'</a>';
				$html.=$this->make_menu($idperfil,$p['idmenu']);
				$html.='</li>';
			}
			return $html.='</ul>';
		}
	}
	public function menu_lateral($idperfil,$padre){
                
                $Menu = $this->Faktury->FindIdParentBySeoName(ltrim($_SERVER['REQUEST_URI'], '/'));
                //var_dump($Menu);
		$campos ="m.idmenu, m.descripcion, m.enlace, m.orden";
		$where="pe.idperfil=".$idperfil." AND m.estado=1 AND p.ver=1 AND m.visible=0";
              //   if($padre)
                     $where .= " AND m.padre=".$Menu['idmenu'];
		$groupby = "m.idmenu";
		$orderby = "m.orden";
                $padres= $this->consultar($this->_menu_sql($campos,$where,$groupby,$orderby));
		$html='<ul>';
                
		if(!empty($padres)){
			foreach ($padres as $p) {
				$html.='<li onclick="cargar_contenido(this)" id="'.XNG_WEBSITE_URL.''.$p['enlace'].'" value="'.$p['idmenu'].'">';
				$html.='<a>'.$p['descripcion'].'';
				$html.='<span></span>';
				$html.='</a>';
				$html.=$this->make_menu($idperfil,$p['idmenu']);
				$html.='</li>';
			}
			return $html.='</ul>';
		}
	}
	public function submenu_option($id,$tab,$idp){
		$tab=$tab."&nbsp;&nbsp;&nbsp;&nbsp;";
		$sel="";
		$HTML_SubMenu="";
		$submenu=$this->consultar($this->_menu_sql("m.idmenu,m.descripcion, m.estado","m.padre=".$id,"m.idmenu","m.orden"));
		if(count($submenu)>0){
			foreach($submenu as $sm){
				$style='';
				if( $sm['estado']==0){
					$style='style="color:#999; text-decoration:line-through;"';
				}
				if($idp!=""){
					//echo $idp;
					echo $sel = ($sm['idmenu']==$idp)?'selected="selected"':'';
				}
				$HTML_SubMenu.='<option value="'.$sm['idmenu'].'" '.$sel.' '.$style.'>'.$tab.$sm['descripcion'].'</option>';
				$HTML_SubMenu.=$this->submenu_option($sm['idmenu'],$tab,$idp);
			}
		}
		return $HTML_SubMenu;
	}
	//arbol de archivos
	public function FileTree($ruta){
		//echo $i=$_SERVER['DOCUMENT_ROOT'].str_replace("index.php","",$_SERVER['PHP_SELF']);
		echo $this->indexof($ruta,0,$ruta);
	}
	private function indexof($i,$p,$url){
		$HTML_Tree="";
		$class="";
		if($p!=0){
			$class='class="directorioClose"';
		}
		if(is_dir($i)){
			$v=md5(rand());
			if($dir=opendir($i)){
				$HTML_Tree.= '<ul id="ul_'.$v.'" '.$class.'>';
				while(($file=readdir($dir))!== false){
					if($file!="." && $file!=".."){
						$v=md5(rand());
						$HTML_Tree1=$this->indexof($i.$file."/",$p+1,$url);
						$class="";
						$funcion="";
						if($HTML_Tree1 !=""){
							$class='class="directorio"';
							$funcion='onclick="openF(\'li_'.$v.'\');"';						
						}else{
							$class='class="fileTree"';
							$funcion='onclick="selectF(\''.str_replace($url,"",$i.$file).'\',this);"';
						}
						
						$HTML_Tree.='<li '.$class.' id="li_'.$v.'">';
						$HTML_Tree.='<a '.$funcion.' id="a_'.$file.'_'.$v.'">'.'<span class="span">'.$file.'</span></a>';
						$HTML_Tree.=$HTML_Tree1;
						$HTML_Tree.='</li>';
						//$j++;
					}
				}
				$HTML_Tree.='</ul>';
			}
		}
		return $HTML_Tree;
	}
	//dibujar una lista con los menu para edicion
	public function DrawMenuList($id,$url){
		$HTML_Menu="";
		$enlace="";
		$enlace=$url."?id=";
		$menu = $this->consultar($this->_menu_sql("m.idmenu,m.descripcion, m.estado","m.padre=".$id,"m.idmenu","m.orden"));
		if(count($menu)>0){
			$HTML_Menu.="<ul>";
			foreach($menu as $m){
				$style='';
				if( $m['estado']==0){
					$style='color:#999; text-decoration:line-through;';
				}
				$HTML_Menu.='<li>';
				$HTML_Menu.='<a style="'.$style.'" class="drop" onclick="_editar(\''.$url.'\', '.$m['idmenu'].')">'.$m['descripcion'].'</a>';
				//$HTML_Menu.=$enlace.$m['id_menu'];
				$HTML_Menu.=$this->DrawMenuList($m['idmenu'],$url);
				$HTML_Menu.='</li>';
			}
			$HTML_Menu.="</ul>";
		}
		return $HTML_Menu;
	}

}
?>