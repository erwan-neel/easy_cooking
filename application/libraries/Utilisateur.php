<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur {

	private $_id_utilisateur;
	private $_nom;
	private $_prenom;
	private $_email;
	private $_password;
	private $_login;
	private $_niveau;

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

    // Liste des getters

    public function id_utilisateur() {

    	return $this->_id_utilisateur;

    }

    public function nom() {

    	return $this->_nom;

    }

    public function prenom() {

    	return $this->_prenom;

    }

    public function email() {

    	return $this->_email;

    }

    public function password() {

    	return $this->_password;

    }

    public function login() {

    	return $this->_login;

    }

    public function niveau() {

    	return $this->_niveau;

    }

    // Liste des setters

    public function setId_utilisateur($id) {

    	$id = (int) $id;

    	if ($id>0) {

    		$this->_id_utilisateur = $id;

    	}

    }

    public function setNom($nom) {

    	if (is_string($nom)) {

    		$this->_nom = $nom;

    	}

    }

    public function setPrenom($prenom) {

    	if (is_string($prenom)) {

    		$this->_prenom = $prenom;

    	}

    }

    public function setEmail($email) {

    	if (is_string($email)) {

    		$this->_email = $email;

    	}

    }

    public function setPassword($password) {

    	if (is_string($password)) {

    		$this->_password = $password;

    	}

    }

    public function setLogin($login) {

    	if (is_string($login)) {

    		$this->_login = $login;

    	}

    }

    public function setNiveau($niveau) {

    	$niveau = (int) $niveau;

    	if ($niveau>0) {

    		$this->_niveau = $niveau;

    	}

    }

}