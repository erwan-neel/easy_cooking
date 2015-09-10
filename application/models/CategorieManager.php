<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategorieManager extends CI_Model {

	protected $table = "categorie";

	public function get_categorie_by_id($id) {

		$query = $this->db->query("SELECT * FROM categorie WHERE id_categorie = ?", array($id));

		return $query->row_array();

	}

	public function get_categories() {

		$query = $this->db->query("SELECT nom_categorie, id_categorie FROM categorie WHERE id_categorie_mere is NULL");

		return $query->result_object();

	}

	public function get_sous_categories($id_categorie) {

		$query = $this->db->query("SELECT * FROM categorie WHERE id_categorie_mere = ?", array($id_categorie));

		return $query->result_object();

	}

	public function get_all_sous_categories() {

		$query = $this->db->query("SELECT t1.nom_categorie, t1.id_categorie, t2.nom_categorie as nom_cat_mere FROM categorie as t1  INNER JOIN categorie as t2 on t1.id_categorie_mere = t2.id_categorie WHERE t1.id_categorie_mere is NOT NULL");

		return $query->result_object();

	}


	public function get_id($nom_categorie) {

		$query = $this->db->query("SELECT id_categorie FROM categorie WHERE nom_categorie = ?", array($nom_categorie));

		return $query->row();

	}

	public function get_recettes_by_ss_cat($ss_cat) {

		$query = $this->db->query("SELECT recette.titre, recette.photo, recette.id_recette FROM recette INNER JOIN categorie on recette.id_sous_categorie = categorie.id_categorie WHERE categorie.nom_categorie = ?", array($ss_cat));

		return $query->result_array();

	}

	public function get_categorie_mere($id_ss_cat) {

		$query = $this->db->query("SELECT t1.id_categorie, t2.nom_categorie as nom_cat_mere, t1.nom_categorie as nom_cat_fille 
								   FROM categorie as t1
								   INNER JOIN categorie as t2 ON t1.id_categorie_mere = t2.id_categorie
								   WHERE t1.id_categorie = ?", array($id_ss_cat));

		return $query->row();

	}

	public function ajouter_categorie($nom_categorie) {

		$this->db->set('nom_categorie', $nom_categorie);		

		$this->db->insert($this->table);

	}

	public function ajouter_sous_categorie($nom_sous_categorie, $id_cat_mere) {

		$this->db->set('id_categorie_mere', $id_cat_mere);

		$this->db->set('nom_categorie', $nom_sous_categorie);

		$this->db->insert($this->table);

	}

	public function supprimer_categorie($id) {

		$this->db->delete('categorie', array('id_categorie' => $id));

	}

}