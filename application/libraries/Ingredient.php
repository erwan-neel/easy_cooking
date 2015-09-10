<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingredient {

	protected $_id_ingredient;
	protected $_nom;

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

	public function id_ingredient() {

		return $this->_id_ingredient;

	}

	public function nom() {

		return $this->_nom;

	}

	public function setId_ingredient($id) {

		$id = (int) $id;

		if($id>0) {

			$this->_id_ingredient = $id;

		}

	}

	public function setNom($nom) {

		if(is_string($nom)) {

			$this->_nom = $nom;

		}

	}

}