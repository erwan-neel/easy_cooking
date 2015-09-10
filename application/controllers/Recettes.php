<?php

class Recettes extends CI_Controller {

	protected $menu_categories;

	public function __construct() {

		parent::__construct();
		$this->load->library('layout');

		$this->layout->set_theme('easy_cooking');

		$this->layout->ajouter_css("animate");
		$this->layout->ajouter_css("bootstrap.min");
		$this->layout->ajouter_css("font-awesome.min");
		$this->layout->ajouter_css("jquery.dataTables");
		$this->layout->ajouter_css("main");
		$this->layout->ajouter_css("prettyPhoto");
		$this->layout->ajouter_css("price-range");
		$this->layout->ajouter_css("responsive");

		
		//$this->layout->ajouter_js("contact");
		//$this->layout->ajouter_js("gmaps");
		//$this->layout->ajouter_js("html5shiv");
		//$this->layout->ajouter_js("jquery.dataTables");
		$this->layout->ajouter_js("jquery");
		$this->layout->ajouter_js("bootstrap.min");
		$this->layout->ajouter_js("jquery.scrollUp.min");
		$this->layout->ajouter_js("price-range");
		$this->layout->ajouter_js("jquery.prettyPhoto");
		$this->layout->ajouter_js("main");
		$this->layout->ajouter_js("verif_inscription");

		$this->load->model('CategorieManager');
		$categorieManager = new CategorieManager();
		$this->menu_categories = $categorieManager->get_categories();

	}

	public function detail($slug) {

		$this->load->library('Recette');
		$this->load->library('Categorie');
		$this->load->model('CategorieManager');
		$this->load->model('RecetteManager');
		$this->load->model('UtilisateurManager');
		$this->load->model('IngredientManager');
		

		$recetteManager = new RecetteManager();
		$categorieManager = new CategorieManager();
		$ingredientManager = new IngredientManager();

		$recette = $recetteManager->get_recette_by_slug($slug);

		$data = array();
		$data['recette'] = $recette;

		// On récupère les catégories principales :
		$this->load->model('CategorieManager');

		$categorieManager = new CategorieManager();

		$categories = $categorieManager->get_categories();

		// On récupère dans un tableau les id_ingredients et les quantités en lien avec la recette :
		$id_ingredients = $recetteManager->get_ingredients($recette->id_recette);

		// Pour chacun des ingrédients, on stocke dans un tableau son nom et sa quantité :
		$ingredients = array();

		foreach ($id_ingredients as $row) {
			
			$donnees = array();
			$donnees['nom'] = $ingredientManager->get_nom($row->id_ingredient)->nom_ingredient;
			$donnees['quantite'] = $row->quantite;
			
			$ingredients[] = $donnees;

		}

		$data['ingredients'] = $ingredients;
		$data['categories'] = $categories;
		$data['menu_categories'] = $this->menu_categories;
		$this->layout->view('detail', $data);

	}

	public function categories($categorie=null) {

		// On commence par récupérer une recette aléatoire de la catégorie sélectionnée par l'utilisateur :
		$this->load->model('RecetteManager');

		$recetteManager = new RecetteManager();

		$recette = $recetteManager->get_random_by_categorie(urldecode($categorie));

		$data = array();

		if ($recette) {

			// On récupère les ingrédients de la recette :
			$ingredients = $recetteManager->get_ingredients($recette->id_recette);

			$data['ingredients'] = $ingredients;

		}

		// Ici on récupère les sous-catégories :
		$this->load->model('CategorieManager');

		$categorieManager = new CategorieManager();

		$id_categorie_mere = $categorieManager->get_id(urldecode($categorie))->id_categorie;

		$sous_categories = $categorieManager->get_sous_categories($id_categorie_mere);
		
		$data['sous_categories'] = $sous_categories;
		$data['recette'] = $recette;

		// Ici on récupère toutes les autres recettes correspondant à cettecatégorie :

		$recettes = $recetteManager->get_recettes_by_categorie($categorie);

		$nb_recettes = count($recettes);
		$nb_div = ceil($nb_recettes/3);

		$data['recettes'] = $recettes;
		$data['nb_div'] = $nb_div;
		$data['nb_recettes'] = $nb_recettes;
		$data['categorie'] = urldecode($categorie);
		$data['menu_categories'] = $this->menu_categories;

		$this->layout->view('categorie', $data);

	}

	public function sous_categorie() {

		if(isset($_GET['sous_categorie'])) {

			$this->load->model('CategorieManager');

			$categorieManager = new CategorieManager();

			$recettes = $categorieManager->get_recettes_by_ss_cat($_GET['sous_categorie']);

			echo json_encode($recettes);

		}

	}

}