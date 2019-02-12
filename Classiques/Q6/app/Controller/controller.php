<?php 
namespace Controller;

use Models\BD;
use Models\get_db_parameters;
use Util\View;

class Controller
{
	private $myBd;
	private $conn;
    private $view;

	public function __construct(){
		if(ENVIRONMENT == 'development') {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        }

        $this->view = new View();
		$parametersBD = new get_db_parameters();
		$this->myBd = new BD($parametersBD->getHN(), $parametersBD->getDB(), $parametersBD->getUN(), $parametersBD->getPW());
		$this->conn = $this->myBd->connexion();
	}
  
	public function get_post($conn, $var){
		return $conn->quote($_POST[$var]);
	}

	public function routeur(){
		//Supprimer Livre
		if (isset($_POST['supprimer']) && isset($_POST['isbn'])){
			$isbn = $this->get_post($this->conn, 'isbn');
			$this->myBd->supprimerISBN($this->conn, $isbn);
		}

		//Ajouter Livre
		if (isset($_POST['auteur'])    &&
			isset($_POST['titre'])     &&
			isset($_POST['categorie']) &&
			isset($_POST['annee'])     &&
			isset($_POST['isbn']))
		{
			$auteur    = $this->get_post($this->conn, 'auteur');
			$titre     = $this->get_post($this->conn, 'titre');
			$categorie = $this->get_post($this->conn, 'categorie');
			$annee     = $this->get_post($this->conn, 'annee');
			$isbn      = $this->get_post($this->conn, 'isbn');
			$this->myBd->ajouterLivre($this->conn, $auteur, $titre, $categorie, $annee, $isbn);
		}

		//Afficher Livres
		$liste = $this->myBd->retournerListeLivres($this->conn);

		//Appel de la vue
        echo $this->view->render('index', compact('liste'));

    	$this->conn = null;
	}
}