<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IngredientManager extends CI_Model {

	protected $table = "ingredient";

	public function get_ingredient($id) {

		$query = $this->db->query("SELECT * FROM ingredient WHERE id_ingredient = ?", array($id));

		return $query->result();

	}

	public function get_nom($id) {

		$query = $this->db->query("SELECT nom_ingredient FROM ingredient WHERE id_ingredient = ?", array($id));

		return $query->row();

	}

	public function get_id($nom_ingredient) {

		$query = $this->db->query("SELECT id_ingredient FROM ingredient WHERE nom_ingredient =  ?", array($nom_ingredient));

		if ($query->num_rows() > 0) {

			return $query->row()->id_ingredient;

		} else {

			return null;

		}

	}

	public function ajouter_ingredient($nom_ingredient) {

		$this->db->set('nom_ingredient', $nom_ingredient);

		$this->db->insert($this->table);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

}