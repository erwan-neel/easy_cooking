<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorie {

	protected $_id_categorie;
	protected $_id_categorie_mere;
	protected $_nom_categorie;

	public function __construct(array $donnees=NULL) {

		if($donnees) {

			$this->hydrate($donnees);

		}
		
	}

	public function hydrate(array $donnees) {

	    foreach ($donnees as $key => $value) {

		    $method = 'set'.ucfirst($key);
		      
		    if (method_exists($this, $method))
		 	{
		        $this->$method($value);
		    }
	    }
	}

	public function id_categorie() {

		return $this->_id_categorie;

	}

	public function id_categorie_mere() {

		return $this->_id_categorie_mere;

	}

	public function nom_categorie() {

		return $this->_nom_categorie;

	}

	public function setId_categorie($id) {

		$id = (int) $id;

		if($id>0) {

			$this->_id_categorie = $id;

		}

	}

	public function setId_categorie_mere($id) {

		$id = (int) $id;

		if($id>0) {

			$this->_id_categorie_mere = $id;

		}

	}

	public function setNom_categorie($nom) {

		if(is_string($nom)) {

			$this->_nom_categorie = $nom;

		}

	}

}