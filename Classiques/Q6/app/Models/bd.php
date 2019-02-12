<?php
namespace Models;
use PDO;

class BD{

	private $bdd;

	public function __construct($hn, $bd, $un, $pw){
	  try {
	    $this->bdd = new PDO('mysql:host='.$hn.';dbname='.$bd, $un, $pw);
	    $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $this->bdd->exec("SET NAMES utf8"); // Force l'affichage en utf-8
	  }
	  catch(PDOException $e){
	      echo $e->getMessage();
	  }
	}

	public function supprimerISBN($conn, $isbn){
		$query  = "DELETE FROM classiques WHERE isbn=$isbn";
		$result = $conn->query($query);
		if (!$result) echo "Échec de la suppression : $query<br>" .
			$conn->error . "<br><br>";
	}

	public function ajouterLivre($conn, $auteur, $titre, $categorie, $annee, $isbn){
		$query = "INSERT INTO classiques VALUES"."($auteur, $titre, $categorie, $annee, $isbn)";
		$result = $conn->query($query);
		if (!$result) echo "Échec de l'insertion : $query<br>" .
			$conn->error . "<br><br>";
	}

	public function retournerListeLivres($conn){
		$query  = "SELECT * FROM classiques";
		$result = $conn->query($query);
		if (!$result) die ("Échec de l'accès à la base de données : " . $conn->error);
		return $result;
	}

	public function connexion(){
		return $this->bdd;
	}

}