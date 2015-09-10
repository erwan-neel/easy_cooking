<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UtilisateurManager extends CI_Model {

	protected $table = "utilisateur";

	public function ajouter_utilisateur(Utilisateur $u) {

		$this->db->set('nom_utilisateur', $u->nom());
		$this->db->set('prenom_utilisateur', $u->prenom());
		$this->db->set('email', $u->email());
		$this->db->set('mot_de_passe', $u->password());
		$this->db->set('login', $u->login());
		$this->db->set('niveau', $u->niveau());

		return $this->db->insert($this->table);
	}

	public function get_utilisateur_by_id($id) {

		$query = $this->db->query("SELECT * FROM utilisateur WHERE id_utilisateur = ?", array($id));

		return $query->row_array();

	}

	public function get_utilisateur_by_id_object($id) {

		$query = $this->db->query("SELECT * FROM utilisateur WHERE id_utilisateur = ?", array($id));

		return $query->row();

	}

	public function get_utilisateurs() {

		$query = $this->db->query("SELECT * FROM utilisateur");

		return $query->result();

	}

	public function get_id($login) {

		$query = $this->db->query("SELECT id_utilisateur FROM utilisateur WHERE login = ?", array($login));

		return $query->row();

	}

	public function supprimer_utilisateur($id) {

		$this->db->delete('utilisateur', array('id_utilisateur' => $id));

	}
	
}