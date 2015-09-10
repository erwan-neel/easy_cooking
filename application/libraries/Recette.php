<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recette {

	protected $_id_recette;
	protected $_id_utilisateur;
	protected $_id_categorie;
	protected $_id_sous_categorie;
	protected $_titre;
	protected $_nombre_personnes;
	protected $_categorie_prix;
	protected $_categorie_difficulte;
	protected $_duree;
	protected $_description;
	protected $_photo;
	protected $_slug;

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

	public function id_recette() {

		return $this->_id_recette;

	}

	public function id_utilisateur() {

		return $this->_id_utilisateur;

	}

	public function id_categorie() {

		return $this->_id_categorie;

	}

	public function id_sous_categorie() {

		return $this->_id_sous_categorie;

	}

	public function titre() {

		return $this->_titre;

	}

	public function nombre_personnes() {

		return $this->_nombre_personnes;

	}

	public function categorie_prix() {

		return $this->_categorie_prix;

	}

	public function categorie_difficulte() {

		return $this->_categorie_difficulte;

	}

	public function duree() {

		return $this->_duree;

	}

	public function description() {

		return $this->_description;

	}

	public function photo() {

		return $this->_photo;

	}

	public function slug() {

		return $this->_slug;

	}


	// Liste des setters :

	public function setId_recette($id) {

		$id = (int) $id;

    	if ($id>0) {

    		$this->_id_recette = $id;

    	}

	}

	public function setId_utilisateur($id) {

		$id = (int) $id;

    	if ($id>0) {

    		$this->_id_utilisateur = $id;

    	}

	}

	public function setId_categorie($id) {

		$id = (int) $id;

    	if ($id>0) {

    		$this->_id_categorie = $id;

    	}

	}

	public function setId_sous_categorie($id) {

		$id = (int) $id;

    	if ($id>0) {

    		$this->_id_sous_categorie = $id;

    	}

	}

	public function setTitre($titre) {

		if (is_string($titre)) {

    		$this->_titre = $titre;

    	}

	}

	public function setNombre_personnes($nombre) {

		$nombre = (int) $nombre;

		if($nombre>0) {

			$this->_nombre_personnes = $nombre;

		}

	}

	public function setCategorie_prix($categorie) {

		if (is_string($categorie)) {

    		$this->_categorie_prix = $categorie;

    	}

	}

	public function setCategorie_difficulte($categorie) {

		if (is_string($categorie)) {

    		$this->_categorie_difficulte = $categorie;

    	}

	}

	public function setDuree($duree) {

		$duree = (int) $duree;

		if($duree>0) {

			$this->_duree = $duree;

		}

	}

	public function setDescription($description) {

		if(is_string($description)) {

			$this->_description = $description;

		}

	}

	public function setPhoto($photo) {

		if(is_string($photo)) {

			$this->_photo = $photo;

		}

	}

	public function setSlug($slug) {

		if(is_string($slug)) {

			$this->_slug = $slug;

		}

	}

}