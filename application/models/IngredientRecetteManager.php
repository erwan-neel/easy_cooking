<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IngredientRecetteManager extends CI_Model {

	protected $table = "ingredient_recette";

	public function ajouter($id_ingredient, $id_recette, $quantite) {

		$this->db->set('id_ingredient', $id_ingredient);
		$this->db->set('id_recette', $id_recette);
		$this->db->set('quantite', $quantite);

		$this->db->insert($this->table);

	}

}