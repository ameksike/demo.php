<?php
class Noticias extends Controller
{
	public $text;

	public function saveComentario($comentario, $idnoticia=1, $idUsuario=1){
		$arrNoticias = array();
		$dbname = $this->cfg['db']['name'];

		$query  = "INSERT INTO `$dbname`.`comentarios` (
			comentario,
			id_noticias,
			idUsuario,
			fCreacion,
			estado
		) VALUES (
			'$comentario',
			'$idnoticia',
			'$idUsuario',
			'".date('Y-m-d H:i:s')."',
			'user'
		)";

		$this->db->exec($query, false);
	}

	public function getComentariosById($idnoticia=1 ){
		$arrNoticias = array();
		$dbname = $this->cfg['db']['name'];
		$query = "SELECT * 
			FROM `$dbname`.`comentarios` 
			WHERE id_noticias=$idnoticia";

		$out = $this->db->exec($query);
		return $out;
	}

	public function getNoticiaById($idnoticia=1 ){
		$arrNoticias = array();
		$dbname = $this->cfg['db']['name'];
		$query = "SELECT * 
			FROM `$dbname`.`noticias` 
			WHERE idNoticias=$idnoticia";

		$out   = $this->db->exec($query);
		return $out[0];
	}

	public function save($titulo, $publicacion, $idUsuario=1)
	{
		$arrNoticias = array();
		$dbname = $this->cfg['db']['name'];

		$query  = "INSERT INTO `$dbname`.`noticias` (
			titulo,
			publicacion,
			fPublicacion,
			idUsuario
		) VALUES (
			'$titulo',
			'$publicacion',
			'".date('Y-m-d H:i:s')."',
			'$idUsuario'
		)";
		$this->db->exec($query, false);
	}

	public function listar($cond){
		$arrNoticias = array();
		$dbname = $this->cfg['db']['name'];
		$query = "SELECT * FROM `$dbname`.`noticias`";

		if(isset($cond["dateini"]))
			$query .=  " WHERE fPublicacion >= '".$cond["dateini"]."' ";
		if(isset($cond["dateend"]))
			$query .=  " and fPublicacion <= '".$cond["dateend"]."' ";
		$query .=  "ORDER BY fPublicacion DESC";
		//	ORDER BY fPublicacion DESC"; //WHERE fPublicacion < '".date('Y-m-d H:i:s')."' 
		$out   = $this->db->exec($query);
		return $out;
	}

	public function getConfig( ){
		print_r($this->cfg['lst']);
		return $this->cfg;
	}

	public function getPost($data){
		return "
			<div class='content'>
										  <div class='Post'>
                        <div class='Post-tl'></div>
                        <div class='Post-tr'>
                          <div></div>
                        </div>
                        <div class='Post-bl'>
                          <div></div>
                        </div>
                        <div class='Post-br'>
                          <div></div>
                        </div>
                        <div class='Post-tc'>
                          <div></div>
                        </div>
                        <div class='Post-bc'>
                          <div></div>
                        </div>
                        <div class='Post-cl'>
                          <div></div>
                        </div>
                        <div class='Post-cr'>
                          <div></div>
                        </div>
                        <div class='Post-cc'></div>
                        <div class='Post-body'>
                          <div class='Post-inner'>                            
                            <div class='PostContent'>
                                <form action='usuario.php' method='post' name='form123'>
				$data
				</form>                                
                            </div>
                            <div class='cleared'></div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
		";
	}
}
