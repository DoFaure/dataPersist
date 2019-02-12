<?php
namespace Models;

class get_db_parameters{
	
	private $hn;
	private $db;
	private $un;
	private $pw;

	public function __construct(){
		$fp = fopen("../app/Config/parameters.json", "r");
		$donnees = fread($fp, filesize("../app/Config/parameters.json"));
		fclose($fp);
		$obj = json_decode($donnees, true);
		
		$this->hn = $obj['hn'];
		$this->db = $obj['db'];
		$this->un = $obj['un'];
		$this->pw = $obj['pw'];
	}

	public function getHN(){
		return $this->hn;
	}

	public function getDB(){
		return $this->db;
	}

	public function getUN(){
		return $this->un;
	}

	public function getPW(){
		return $this->pw;
	}


}