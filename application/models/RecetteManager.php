<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RecetteManager extends CI_Model {

	protected $table = "recette";

	public function get_recette($id) {

		$query = $this->db->query("SELECT * FROM recette WHERE id_recette = ?", array($id));

		return $query->row_array();

	}

	// Retourne la recette sous forme d'objet
	public function get_recette_object($id) {

		$query = $this->db->query("SELECT * FROM recette WHERE id_recette = ?", array($id));

		return $query->row();

	}

	public function get_ingredients($id) {

		$query = $this->db->query("SELECT * FROM ingredient_recette as t1 LEFT JOIN ingredient as t2 on t1.id_ingredient = t2.id_ingredient WHERE id_recette = ?", array($id));

		return $query->result();

	}

	public function get_random() {

		$query = $this->db->query("SELECT COUNT(*) AS nb_de_lignes FROM recette");

		$nb_de_lignes = $query->first_row()->nb_de_lignes;

		$offset = rand(0, $nb_de_lignes-1);

		$query->free_result();

		$query2 = $this->db->query("SELECT * FROM recette LIMIT $offset, 1");

		return $query2->row_array();

	}

	public function get_random_by_categorie($categorie) {

		$query = $this->db->query("select recette.id_recette from recette inner join categorie on recette.id_categorie = categorie.id_categorie where nom_categorie = ?", array($categorie));

		$recettes = $query->result();

		$tab = array();

		foreach ($recettes as $recette) {

			$tab[] = $recette->id_recette;
			# code...
		}

		$query->free_result();

		if ($tab!=null) {

			$rand_key = array_rand($tab);		
		
			$query2 = $this->db->query("SELECT * FROM recette WHERE id_recette = ?", array($tab[$rand_key]));
		
			return $query2->row();

		} else {

			return null;

		}

	}

	// Permet de récupérer toutes les recettes d'un utilisateur --> pour la partie administration
	public function get_recettes($id) {

		$query = $this->db->query("SELECT t1.id_recette, t1.titre, t2.nom_categorie, t3.nom_categorie as nom_sous_categorie FROM recette as t1
								   LEFT JOIN categorie as t2 ON t1.id_categorie = t2.id_categorie
								   LEFT JOIN categorie as t3 ON t1.id_sous_categorie = t3.id_categorie
								   WHERE t1.id_utilisateur = ?", array($id));

		return $query->result();

	}

	public function get_recette_by_name($nom) {

		$query = $this->db->query("SELECT * FROM recette WHERE titre = ?", array($nom));

		return $query->row_array();

	}

	// Cette méthode a été modifiée pour recevoir un id et non un slug
	public function get_recette_by_slug($id) {

		$query = $this->db->query("select t1.id_recette, t2.login, t3.nom_categorie, t4.nom_categorie as nom_sous_categorie, t1.titre, t1.nombre_personnes, t1.categorie_prix, t1.categorie_difficulte, t1.duree, t1.photo, t1.description, t1.slug
								   from recette as t1 
								   left join utilisateur as t2 on t1.id_utilisateur = t2.id_utilisateur
								   left join categorie as t3 on t1.id_categorie = t3.id_categorie
								   left join categorie as t4 on t1.id_sous_categorie = t4.id_categorie
								   WHERE t1.id_recette = ?", array($id));

		return $query->row();

	}

	public function get_recettes_by_categorie($categorie) {

		$query = $this->db->query("SELECT t1.id_recette, t1.titre, t1.photo FROM recette as t1 INNER JOIN categorie as t2 ON t1.id_categorie = t2.id_categorie WHERE t2.nom_categorie = ?", array($categorie));

		return $query->result();

	}

	public function ajouter_recette(Recette $r) {

		$this->db->set('id_utilisateur', $r->id_utilisateur());
		$this->db->set('id_categorie', $r->id_categorie());
		$this->db->set('id_sous_categorie', $r->id_sous_categorie());
		$this->db->set('titre', $r->titre());
		$this->db->set('nombre_personnes', $r->nombre_personnes());
		$this->db->set('categorie_prix', $r->categorie_prix());
		$this->db->set('categorie_difficulte', $r->categorie_difficulte());
		$this->db->set('duree', $r->duree());
		$this->db->set('photo', $r->photo());
		$this->db->set('description', $r->description());
		$this->db->set('slug', $r->slug());

		$this->db->insert($this->table);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

}