<?php

class Administration extends CI_Controller {

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
			$this->layout->ajouter_css("jquery-ui.min");
			$this->layout->ajouter_css("jquery-ui.structure.min");
			$this->layout->ajouter_css("jquery-ui.theme.min");

			
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
			$this->layout->ajouter_js("jquery-ui-1.11.4.custom/jquery-ui");
			$this->layout->ajouter_js("ajax_ingredients");
			$this->layout->ajouter_js("jquery.dataTables");
			$this->layout->ajouter_js("tri_tableau");
			$this->layout->ajouter_js("loading");


			// On charge les catégories dans le menu
			$this->load->model('CategorieManager');
			$categorieManager = new CategorieManager();
			$this->menu_categories = $categorieManager->get_categories();

		

	}

	public function administrer_utilisateurs() {

		if(is_connected() && $_SESSION['niveau'] == 1) {

			$this->load->model('UtilisateurManager');

			$utilisateurManager = new UtilisateurManager();
			$utilisateurs = $utilisateurManager->get_utilisateurs();

			$data = array();

			// Si l'on envoie un message de confirmation de suppression d'une sous-catégorie depuis la méthode "supprimer" :
			if($this->session->flashdata('message')) { $data['confirmation'] = $this->session->flashdata('message'); }

			$data['utilisateurs'] = $utilisateurs;
			$data['menu_categories'] = $this->menu_categories;

			$this->layout->view('liste_utilisateurs', $data);

		} else {

			redirect('accueil');

		}


	}

	public function administrer_sous_categories() {

		// On vérifie qu'il s'agit bien d'un admin :
		if(is_connected() && $_SESSION['niveau'] == 1) {

			// On récupère les différentes catégories pour les passer à la vue :

			$this->load->model('CategorieManager');

			$categorieManager = new CategorieManager();

			$sous_categories = $categorieManager->get_all_sous_categories();

			$data = array();

			// Si l'on envoie un message de confirmation de suppression d'une sous-catégorie depuis la méthode "supprimer" :
			if($this->session->flashdata('message')) { $data['confirmation'] = $this->session->flashdata('message'); }

			$data['sous_categories'] = $sous_categories;
			$data['menu_categories'] = $this->menu_categories;

			$this->layout->view('liste_sous_categories', $data);

		} else {

			redirect('accueil');

		}

	}

	public function administrer_categories() {

		// On vérifie qu'il s'agit bien d'un admin :
		if(is_connected() && $_SESSION['niveau'] == 1) {

			// On récupère les différentes catégories pour les passer à la vue :

			$this->load->model('CategorieManager');

			$categorieManager = new CategorieManager();

			$categories = $categorieManager->get_categories();

			$data = array();

			// Si l'on envoie un message de confirmation de suppression d'une catégorie depuis la méthode "supprimer" :
			if($this->session->flashdata('message')) { $data['confirmation'] = $this->session->flashdata('message'); }

			$data['categories'] = $categories;
			$data['menu_categories'] = $this->menu_categories;

			$this->layout->view('liste_categories', $data);

		} else {

			redirect('accueil');

		}

	}

	public function administrer() {

		if(!is_connected()) {

			redirect('accueil');

		} else {

			// On charge les modèles
			$this->load->model('UtilisateurManager');
			$this->load->model('RecetteManager');

			if($_SESSION['niveau']==1) {

				//On récupère l'ensemble des recettes du site :
				$recetteManager = new RecetteManager();
				$recettes = $recetteManager->get_all_recettes();

				$data = array();

				// Si l'on envoie un message de confirmation de suppression d'une recette depuis la méthode "supprimer" :
				if($this->session->flashdata('message')) { $data['confirmation'] = $this->session->flashdata('message'); }

				$data['recettes'] = $recettes;
				$data['active'] = "administrer";
				$data['menu_categories'] = $this->menu_categories;

				$this->layout->view('admin_utilisateur', $data);

			}else {

				// On récupère l'id de l'utilisateur :
				$utilisateurManager = new UtilisateurManager();
				$id_utilisateur = $utilisateurManager->get_id($_SESSION['login'])->id_utilisateur;

				//On récupère les recettes qui lui sont associées :
				$recetteManager = new RecetteManager();
				$recettes = $recetteManager->get_recettes($id_utilisateur);

				$data = array();

				// Si l'on envoie un message de confirmation de suppression d'une recette depuis la méthode "supprimer" :
				if($this->session->flashdata('message')) { $data['confirmation'] = $this->session->flashdata('message'); }

				$data['recettes'] = $recettes;
				$data['active'] = "administrer";
				$data['menu_categories'] = $this->menu_categories;

				$this->layout->view('admin_utilisateur', $data);

			}

			

		}

	}

	public function ajouter_categorie() {

		// On vérifie qu'il s'agit bien d'un admin :
		if(is_connected() && $_SESSION['niveau'] == 1) {

			$this->load->helper('form');
			$this->load->library('form_validation');

			// On fixe les règles concernant l'ajout d'une recette :
			$this->form_validation->set_rules('categorie', '"Nom de la catégorie"', 'trim|required|encode_php_tags');

			if($this->form_validation->run()) {

				// On récupère le nom de la catégorie
				$categorie = $this->input->post('categorie');

				// On vérifie qu'elle n'existe pas déjà en bdd :
				$this->load->model('CategorieManager');

				$categorieManager = new CategorieManager();

				$id_categorie = $categorieManager->get_id($categorie);

				if($id_categorie == null) {

					$categorieManager->ajouter_categorie($categorie);

					redirect('administration/administrer_categories');

				} else {

					$erreur_categorie = "Cette catégorie existe déjà...";

					$data = array();

					$data['erreur_categorie'] = $erreur_categorie;
					$data['menu_categories'] = $this->menu_categories;

					$this->layout->view('ajouter_categorie', $data);

				}

			} else {

				$data = array();

				$data['menu_categories'] = $this->menu_categories;

				$this->layout->view('ajouter_categorie', $data);

			}			

		} else {

			redirect('accueil');

		}

	}

	public function ajouter_sous_categorie() {

		// On vérifie qu'il s'agit bien d'un admin :
		if(is_connected() && $_SESSION['niveau'] == 1) {

			$this->load->helper('form');
			$this->load->library('form_validation');

			// On fixe les règles concernant l'ajout d'une recette :
			$this->form_validation->set_rules('categorie_mere', '"Nom de la catégorie mère"', 'trim|required|encode_php_tags');
			$this->form_validation->set_rules('categorie_fille', '"Nom de la sous-catégorie"', 'trim|required|encode_php_tags');


			if($this->form_validation->run()) {

				$this->load->model('CategorieManager');

				$categorieManager = new CategorieManager();

				// On vérifie que la sous-catégorie n'existe pas déjà
				$id_sous_categorie = $categorieManager->get_id($this->input->post('categorie_fille'));

				if($id_sous_categorie == null) {

					$id_categorie_mere = $categorieManager->get_id($this->input->post('categorie_mere'))->id_categorie;

					$categorieManager->ajouter_sous_categorie($this->input->post('categorie_fille'), $id_categorie_mere);

					redirect('administration/administrer_sous_categories');	

				} else {

					$erreur_categorie = "Cette sous-catégorie existe déjà...";

					$data = array();

					$data['erreur_categorie'] = $erreur_categorie;
					$data['menu_categories'] = $this->menu_categories;

					$this->layout->view('ajouter_sous_categorie', $data);

				}

			} else {

				// On récupère les différentes catégories pour les passer à la vue :

				$this->load->model('CategorieManager');

				$categorieManager = new CategorieManager();

				$categories = $categorieManager->get_categories();

				$data = array();

				$data['categories'] = $categories;
				$data['menu_categories'] = $this->menu_categories;

				$this->layout->view('ajouter_sous_categorie', $data);

			}			

		} else {

			redirect('accueil');

		}

	}

	public function ajouter_recette() {

		if(!is_connected()) {

			$this->load->model('CategorieManager');

			$categorieManager = new CategorieManager();

			$categories = $categorieManager->get_categories();

			$data = array();

			$data['categories'] = $categories;
			$data['active'] = "ajouter_recette";
			$data['menu_categories'] = $this->menu_categories;

			$this->layout->view('information_ajouter_recette', $data);

		} else {

		$this->load->helper('form');
		$this->load->library('form_validation');

		// On fixe les règles concernant l'ajout d'une recette :
		$this->form_validation->set_rules('titre', '"Titre de la recette"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('categorie', '"Nom de la catégorie"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('sous_categorie', '"Nom de la sous_catégorie"', 'trim|encode_php_tags');
		

		$compteur_ingredients = (int) $this->input->post('nb_ingredients');

		for($i=1; $i<=$compteur_ingredients; $i++) {

			$this->form_validation->set_rules('ingredient_'.$i, '"Nom de l\'ingrédient"', 'trim|required|encode_php_tags');
			$this->form_validation->set_rules('quantite_'.$i, '"Quantité de l\'ingrédient"', 'trim|required|encode_php_tags');

		}

		$this->form_validation->set_rules('preparation', '"Préparation de la recette"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('nb_personnes', '"Nombre de personnes"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('duree', '"Durée de la recette"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('prix', '"Catégorie de prix"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('difficulte', '"Catégorie de difficulté"', 'trim|required|encode_php_tags');

		// On contrôle l'upload de la photo :
		$config['upload_path'] = './assets/images/recettes/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '2048';
		$config['max_width'] = '2000';
		$config['max_height'] = '2000';

		$this->load->library('upload', $config);


	    	if($this->form_validation->run()) {
			// Le formulaire est valide				

			    // On teste si une photo a été envoyée
			    if ($_FILES['photo']['name']==null) {

			    	// Ici le formulaire est valide mais aucune photo n'a été envoyée

			    	$this->load->library('Recette');
					$this->load->library('Utilisateur');
					$this->load->library('Categorie');
					$this->load->model('CategorieManager');
					$this->load->model('RecetteManager');
					$this->load->model('UtilisateurManager');
					$this->load->model('IngredientManager');
					$this->load->model('IngredientRecetteManager');

					// On récupère l'id de l'utilisateur :
					$utilisateurManager = new UtilisateurManager();
					$id_utilisateur = $utilisateurManager->get_id($_SESSION['login'])->id_utilisateur;

					// On récupère l'id de la catégorie :
					$id_sous_categorie = null;

					$categorieManager = new CategorieManager();
					$id_categorie = $categorieManager->get_id($this->input->post('categorie'))->id_categorie;

					// On récupère l'id de la sous_catégorie (s'il n'est pas null):
					if ($this->input->post('sous_categorie')!=null) {

						$id_sous_categorie = $categorieManager->get_id($this->input->post('sous_categorie'))->id_categorie;

					}

					
					// On instancie un objet recette
					$recette = new Recette();


					$recette->setId_utilisateur($id_utilisateur);
					$recette->setId_categorie($id_categorie);
					$recette->setId_sous_categorie($id_sous_categorie);
					$recette->setTitre($this->input->post('titre'));
					$recette->setNombre_personnes($this->input->post('nb_personnes'));
					$recette->setCategorie_prix($this->input->post('prix'));
					$recette->setCategorie_difficulte($this->input->post('difficulte'));
					$recette->setDuree($this->input->post('duree'));
					$recette->setDescription($this->input->post('preparation'));
					$recette->setPhoto('defaut.jpg');

					$slug = url_title($recette->titre());

					$recette->setSlug($slug);

					// On ajoute la recette en bdd et on récupère son id :
					$recetteManager = new RecetteManager();

					$id_recette = $recetteManager->ajouter_recette($recette);

					// Ici on s'occuppe des ingrédients !
					$nb_ingredients = (int) $this->input->post('nb_ingredients');

					$ingredientManager = new IngredientManager();
					$ingredientRecetteManager = new IngredientRecetteManager();

					for ($i=1; $i<=$nb_ingredients ; $i++) { 

						$nom_ingredient = $this->input->post('ingredient_'.$i);
						$id_ingredient = $ingredientManager->get_id($nom_ingredient);

						if ($id_ingredient==null) {
						// On ajoute ici le nouvel ingrédient en bdd :

							$id_ingredient = $ingredientManager->ajouter_ingredient($nom_ingredient);

							$quantite = $this->input->post('quantite_'.$i);

							$ingredientRecetteManager->ajouter($id_ingredient, $id_recette, $quantite);

						} else {

							$quantite = $this->input->post('quantite_'.$i);

							$ingredientRecetteManager->ajouter($id_ingredient, $id_recette, $quantite);

						}

					}

					redirect('recettes/detail/'.$id_recette);

			    } else {

			    	// Ici, le formulaire est valide et une photo a été envoyée, on vérifie donc qu'elle correspond aux bons critères
			    	if (!$this->upload->do_upload('photo') == true) {

				    	// Le formulaire est vide ou invalide
						$this->load->model('CategorieManager');

						//On récupère les noms des différentes catégories afin d'implémenter la liste déroulante du formulaire dynamiquement
						$categorieManager = new CategorieManager();

						$result = $categorieManager->get_categories();	

						$categories = array();	

						foreach ($result as $row) {
							
							$categories[] = $row->nom_categorie;

						}

						$data = array();
						$data['categories'] = $categories;
						$data['menu_categories'] = $this->menu_categories;

						$this->layout->view('formulaire_recette', $data);

			   		} else {
				    	// Ici l'upload est valide, on envoie les données en bdd !

				    	$data_photo = array('upload_data' => $this->upload->data());

				    	$this->load->library('Recette');
						$this->load->library('Utilisateur');
						$this->load->library('Categorie');
						$this->load->model('CategorieManager');
						$this->load->model('RecetteManager');
						$this->load->model('UtilisateurManager');
						$this->load->model('IngredientManager');
						$this->load->model('IngredientRecetteManager');

						// On récupère l'id de l'utilisateur :
						$utilisateurManager = new UtilisateurManager();
						$id_utilisateur = $utilisateurManager->get_id($_SESSION['login'])->id_utilisateur;

						// On récupère l'id de la catégorie :
						$id_sous_categorie = null;

						$categorieManager = new CategorieManager();
						$id_categorie = $categorieManager->get_id($this->input->post('categorie'))->id_categorie;

						// On récupère l'id de la sous_catégorie (s'il n'est pas null):
						if ($this->input->post('sous_categorie')!=null) {

							$id_sous_categorie = $categorieManager->get_id($this->input->post('sous_categorie'))->id_categorie;

						}


						// On instancie un objet recette
						$recette = new Recette();


						$recette->setId_utilisateur($id_utilisateur);
						$recette->setId_categorie($id_categorie);
						$recette->setId_sous_categorie($id_sous_categorie);
						$recette->setTitre($this->input->post('titre'));
						$recette->setNombre_personnes($this->input->post('nb_personnes'));
						$recette->setCategorie_prix($this->input->post('prix'));
						$recette->setCategorie_difficulte($this->input->post('difficulte'));
						$recette->setDuree($this->input->post('duree'));
						$recette->setDescription($this->input->post('preparation'));
						$recette->setPhoto($data_photo['upload_data']['file_name']);

						//On crée une miniature de l'image :
						$config['image_library'] = 'gd2';
						$config['source_image'] = $data_photo['upload_data']['full_path'];
						$config['new_image'] = "miniature_".$data_photo['upload_data']['file_name'];
						//$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = false;
						$config['width'] = 500;
						$config['height'] = 375;

						$this->load->library('image_lib', $config);

						$this->image_lib->resize();

						$slug = url_title($recette->titre());

						$recette->setSlug($slug);

						// On ajoute la recette en bdd et on récupère son id :
						$recetteManager = new RecetteManager();

						$id_recette = $recetteManager->ajouter_recette($recette);

						// Ici on s'occuppe des ingrédients !
						$nb_ingredients = (int) $this->input->post('nb_ingredients');

						$ingredientManager = new IngredientManager();
						$ingredientRecetteManager = new IngredientRecetteManager();

						for ($i=1; $i<=$nb_ingredients ; $i++) { 

							$nom_ingredient = $this->input->post('ingredient_'.$i);
							$id_ingredient = $ingredientManager->get_id($nom_ingredient);

							if ($id_ingredient==null) {
							// On ajoute ici le nouvel ingrédient en bdd :

								$id_ingredient = $ingredientManager->ajouter_ingredient($nom_ingredient);

								$quantite = $this->input->post('quantite_'.$i);

								$ingredientRecetteManager->ajouter($id_ingredient, $id_recette, $quantite);

							} else {

								$quantite = $this->input->post('quantite_'.$i);

								$ingredientRecetteManager->ajouter($id_ingredient, $id_recette, $quantite);

							}

						}

						redirect('recettes/detail/'.$id_recette);

			    	}

			    }
			    // Si l'upload n'est pas valide, on réaffiche le formulaire
			} else {
			// Le formulaire est vide ou invalide
				$this->load->model('CategorieManager');

				//On récupère les noms des différentes catégories afin d'implémenter la liste déroulante du formulaire dynamiquement
				$categorieManager = new CategorieManager();

				$result = $categorieManager->get_categories();	

				$categories = array();	

				foreach ($result as $row) {
					
					$categories[] = $row->nom_categorie;

				}

				$data = array();
				$data['categories'] = $categories;
				$data['active'] = "ajouter_recette";
				$data['menu_categories'] = $this->menu_categories;

				$this->layout->view('formulaire_recette', $data);

			}

		}		

	}

	public function modifier($id=null) {

		if(!is_connected()) {

			redirect('accueil');

		} else {

		$this->load->helper('form');
		$this->load->library('form_validation');

		// On fixe les règles concernant l'ajout d'une recette :
		$this->form_validation->set_rules('titre', '"Titre de la recette"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('categorie', '"Catégorie de la recette"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('sous_categorie', '"Sous-Catégorie de la recette"', 'trim|encode_php_tags');

		$this->form_validation->set_rules('preparation', '"Préparation de la recette"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('nb_personnes', '"Nombre de personnes"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('duree', '"Durée de la recette"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('prix', '"Catégorie de prix"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('difficulte', '"Catégorie de difficulté"', 'trim|required|encode_php_tags');

		// On contrôle l'upload de la photo :
		$config['upload_path'] = './assets/images/recettes/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '2048';
		$config['max_width'] = '2000';
		$config['max_height'] = '2000';

		$this->load->library('upload', $config);

		if($this->form_validation->run()) {

			// On teste si une photo a été envoyée
			if ($_FILES['photo']['name']==null) {
			// Ici le formulaire est valide mais aucune photo n'a été envoyée

				// On récupère les ids correspondants aux catégories :
				$this->load->model('CategorieManager');

				$categorieManager = new CategorieManager();
				$id_categorie = (int) $categorieManager->get_id($this->input->post('categorie'))->id_categorie;

				if($this->input->post('sous_categorie'))
				{$id_sous_categorie = (int) $categorieManager->get_id($this->input->post('sous_categorie'))->id_categorie;}
				// On place l'ensemble des champs dans un tableau pour pouvoir les mettre à jour :
				$slug = url_title($this->input->post('titre'));

				$data = array(
							'titre' => $this->input->post('titre'),
							'id_categorie' => $id_categorie,
							'id_sous_categorie' => $id_sous_categorie,
							'description' => $this->input->post('preparation'),
							'nombre_personnes' => $this->input->post('nb_personnes'),
							'duree' => $this->input->post('duree'),
							'categorie_prix' => $this->input->post('prix'),
							'categorie_difficulte' => $this->input->post('difficulte'),
							'slug' => $slug
						);

				// On met à jour les données :
				$this->db->where('id_recette', $this->input->post('id_recette'));
				$this->db->update('recette', $data);

				// Ici on s'occuppe des ingrédients :

				// On commence par supprimer tous les ingrédients de la table ingredient_recette associée à la recette en question :
				$this->db->delete('ingredient_recette', array('id_recette' => $this->input->post('id_recette')));

				// Puis on récupère les ingrédients du formulaire et on les ajoute en bdd :
				$nb_ingredients = (int) $this->input->post('nb_ingredients');

				
				$this->load->model('IngredientManager');
				$this->load->model('IngredientRecetteManager');

				$ingredientManager = new IngredientManager();
				$ingredientRecetteManager = new IngredientRecetteManager();

					for ($i=1; $i<=$nb_ingredients ; $i++) { 

						$nom_ingredient = $this->input->post('ingredient_'.$i);
						$id_ingredient = $ingredientManager->get_id($nom_ingredient);

						if ($id_ingredient==null) {
						// On ajoute ici le nouvel ingrédient en bdd :

							$id_ingredient = $ingredientManager->ajouter_ingredient($nom_ingredient);

							$quantite = $this->input->post('quantite_'.$i);

							$ingredientRecetteManager->ajouter($id_ingredient, $this->input->post('id_recette'), $quantite);

						} else {

							$quantite = $this->input->post('quantite_'.$i);

							$ingredientRecetteManager->ajouter($id_ingredient, $this->input->post('id_recette'), $quantite);

						}

					}

				redirect('recettes/detail/'. $this->input->post('id_recette'));

			} else {

			// Ici, le formulaire est valide et une photo a été envoyée, on vérifie donc qu'elle correspond aux bons critères
			    	if (!$this->upload->do_upload('photo') == true) {

				    	// Le formulaire est vide ou invalide
						$this->load->model('CategorieManager');
						$this->load->model('RecetteManager');
						$this->load->model('IngredientManager');

						// On récupère la recette correspondante
						$recetteManager = new RecetteManager();
						$recette = $recetteManager->get_recette_object($id);

						if($recette==null) {

							$recette = $recetteManager->get_recette_object($this->input->post('id_recette'));

						}

						// On récupère les catégories
						$categorieManager = new CategorieManager();
						$categories = $categorieManager->get_categories();

						$sous_categories = null;

						// On récupère les sous-catégories :
						if ($recette) {

							$sous_categories = $categorieManager->get_sous_categories($recette->id_categorie);

						}

						// On récupère les ingrédients de la recette
						$ingredients = null;

						if ($recette) {

							$ingredients = $recetteManager->get_ingredients($recette->id_recette);

						}	
						

						$data = array();
						$data['recette'] = $recette;
						$data['categories'] = $categories;
						$data['sous_categories'] = $sous_categories;
						$data['ingredients'] = $ingredients;
						$data['menu_categories'] = $this->menu_categories;

						$this->layout->view('formulaire_modification_recette', $data);

					} else {
				    	// Ici l'upload est valide, on envoie les données en bdd :
						// On récupère les ids correspondants aux catégories :

						$data_photo = array('upload_data' => $this->upload->data());

						//On crée une miniature de l'image :
						$config['image_library'] = 'gd2';
						$config['source_image'] = $data_photo['upload_data']['full_path'];
						$config['new_image'] = "miniature_".$data_photo['upload_data']['file_name'];
						//$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = false;
						$config['width'] = 500;
						$config['height'] = 375;

						$this->load->library('image_lib', $config);

						$this->image_lib->resize();

						$this->load->model('CategorieManager');

						$categorieManager = new CategorieManager();
						$id_categorie = (int) $categorieManager->get_id($this->input->post('categorie'))->id_categorie;
						$id_sous_categorie = (int) $categorieManager->get_id($this->input->post('sous_categorie'))->id_categorie;

						// On place l'ensemble des champs dans un tableau pour pouvoir les mettre à jour :
						$slug = url_title($this->input->post('titre'));

						$data = array(
									'titre' => $this->input->post('titre'),
									'id_categorie' => $id_categorie,
									'id_sous_categorie' => $id_sous_categorie,
									'description' => $this->input->post('preparation'),
									'nombre_personnes' => $this->input->post('nb_personnes'),
									'duree' => $this->input->post('duree'),
									'categorie_prix' => $this->input->post('prix'),
									'categorie_difficulte' => $this->input->post('difficulte'),
									'photo' => $data_photo['upload_data']['file_name'],
									'slug' => $slug
								);

						// On met à jour les données :
						$this->db->where('id_recette', $this->input->post('id_recette'));
						$this->db->update('recette', $data);

						// Ici on s'occuppe des ingrédients :

						// On commence par supprimer tous les ingrédients de la table ingredient_recette associée à la recette en question :
						$this->db->delete('ingredient_recette', array('id_recette' => $this->input->post('id_recette')));

						// Puis on récupère les ingrédients du formulaire et on les ajoute en bdd :
						$nb_ingredients = (int) $this->input->post('nb_ingredients');

						$this->load->model('IngredientManager');
						$this->load->model('IngredientRecetteManager');

						$ingredientManager = new IngredientManager();
						$ingredientRecetteManager = new IngredientRecetteManager();

							for ($i=1; $i<=$nb_ingredients ; $i++) { 

								$nom_ingredient = $this->input->post('ingredient_'.$i);
								$id_ingredient = $ingredientManager->get_id($nom_ingredient);

								if ($id_ingredient==null) {
								// On ajoute ici le nouvel ingrédient en bdd :

									$id_ingredient = $ingredientManager->ajouter_ingredient($nom_ingredient);

									$quantite = $this->input->post('quantite_'.$i);

									$ingredientRecetteManager->ajouter($id_ingredient, $this->input->post('id_recette'), $quantite);

								} else {

									$quantite = $this->input->post('quantite_'.$i);

									$ingredientRecetteManager->ajouter($id_ingredient, $this->input->post('id_recette'), $quantite);

								}

							}

						redirect('recettes/detail/'. $this->input->post('id_recette'));

					}

			}

		} else {

			$this->load->model('CategorieManager');
			$this->load->model('RecetteManager');
			$this->load->model('IngredientManager');

			// On récupère la recette correspondante
			$recetteManager = new RecetteManager();
			$recette = $recetteManager->get_recette_object($id);

			if($recette==null) {

				$recette = $recetteManager->get_recette_object($this->input->post('id_recette'));

			}

			// On récupère les catégories
			$categorieManager = new CategorieManager();
			$categories = $categorieManager->get_categories();

			$sous_categories = null;

			// On récupère les sous-catégories :
			if ($recette) {

				$sous_categories = $categorieManager->get_sous_categories($recette->id_categorie);

			}

			// On récupère les ingrédients de la recette
			$ingredients = null;

			if ($recette) {

				$ingredients = $recetteManager->get_ingredients($recette->id_recette);

			}	
			

			$data = array();
			$data['recette'] = $recette;
			$data['categories'] = $categories;
			$data['sous_categories'] = $sous_categories;
			$data['ingredients'] = $ingredients;
			$data['active'] = "ajouter_recette";
			$data['menu_categories'] = $this->menu_categories;

			$this->layout->view('formulaire_modification_recette', $data);

		}

		}	

	}

	// Sert pour l'appel ajax afin de remplir le formulaire d'ajout de recette :
	
	public function sous_categorie() {

		$json = array();

		if (isset($_GET['categorie'])) {
			
			// On récupère dans un premier temps l'id de la catégorie mère
			$query = $this->db->query("SELECT id_categorie FROM categorie WHERE nom_categorie = ?", array($_GET['categorie']));

			$id_categorie = $query->row()->id_categorie;

			$query->free_result();

			$query2 = $this->db->query("SELECT nom_categorie FROM categorie WHERE id_categorie_mere = ?", array($id_categorie));

			foreach ($query2->result_array() as $row) {

				$sous_categorie = $row['nom_categorie'];
			
				array_push($json, $sous_categorie);

			}

			echo json_encode($json);

		}

	}

	// sert pour l'ajax du formulaire d'ajout de recette :
	public function ajax_ingredients() {

		// La variable 'term' est envoyée par le plugin 'autocomplete' :
		$term = $_GET['term'];

		$query = $this->db->query("SELECT * FROM ingredient WHERE nom_ingredient LIKE ?", array($term.'%'));

		$array = array();

		foreach ($query->result_array() as $row) {

			$ingredient = $row['nom_ingredient'];
		
			array_push($array, $ingredient);

		}

		/*if($donnee = $query->row_array()) {

			array_push($array, $donnee['nom_ingredient']);

		}*/

		$query->free_result();

		echo json_encode($array);

	}

	public function supprimer($id) {

		if(!is_connected()) {

			redirect('accueil');

		} else {

		$this->db->delete('recette', array('id_recette' => $id));

		$confirmation = '<p id="confirmation">La recette a bien été supprimée.</p>';

		$this->session->set_flashdata('message', $confirmation);

		redirect('Administration/administrer');

	}

	}

	public function supprimer_categorie($id) {

		// On vérifie qu'il s'agit bien d'un admin :
		if(is_connected() && $_SESSION['niveau'] == 1) {

			$this->load->model('CategorieManager');

			$categorieManager = new CategorieManager();

			$categorieManager->supprimer_categorie($id);

			$confirmation = '<p id="confirmation">La catégorie a bien été supprimée.</p>';

			$this->session->set_flashdata('message', $confirmation);

			redirect('Administration/administrer_categories');

		} else {

			redirect('accueil');

		}

	}

	public function supprimer_utilisateur($id) {

		// On vérifie qu'il s'agit bien d'un admin :
		if(is_connected() && $_SESSION['niveau'] == 1) {

			$this->load->model('UtilisateurManager');

			$utilisateurManager = new UtilisateurManager();

			$utilisateurManager->supprimer_utilisateur($id);

			$confirmation = '<p id="confirmation">L\'utilisateur a bien été supprimé.</p>';

			$this->session->set_flashdata('message', $confirmation);

			redirect('Administration/administrer_utilisateurs');

		} else {

			redirect('accueil');

		}

	}

	public function modifier_utilisateur($id=null) {

		// On vérifie qu'il s'agit bien d'un admin :
		if(is_connected() && $_SESSION['niveau'] == 1) {

			$this->load->helper('form');
			$this->load->library('form_validation');

			// On fixe les règles concernant l'ajout d'une recette :
			$this->form_validation->set_rules('nom_utilisateur', '"Nom de l\'utilisateur"', 'trim|required|encode_php_tags');
			$this->form_validation->set_rules('prenom_utilisateur', '"Prénom de l\'utilisateur"', 'trim|required|encode_php_tags');
			$this->form_validation->set_rules('login', '"Login de l\'utilisateur"', 'trim|required|encode_php_tags');
			$this->form_validation->set_rules('email', '"Email de l\'utilisateur"', 'trim|required|encode_php_tags');
			$this->form_validation->set_rules('niveau', '"Niveau de l\'utilisateur"', 'trim|required|encode_php_tags');

			if($this->form_validation->run()) {

				$this->load->model('UtilisateurManager');
				$utilisateurManager = new UtilisateurManager();

				// On récupère les données de l'ancien utilisateur :
				$old_utilisateur = $utilisateurManager->get_utilisateur_by_id_object($this->input->post('id_utilisateur'));

				// On vérifie si l'email a été mis à jour :
				if($old_utilisateur->email == $this->input->post('email')) {

					// Ici les email sont identiques, il faut alors procéder de même avec les logins
					if($old_utilisateur->login == $this->input->post('login')) {

						// Ici, les logins sont identiques, on peut mettre les données à jour :
						$data = array('nom_utilisateur' => $this->input->post('nom_utilisateur'),
									  'prenom_utilisateur' => $this->input->post('prenom_utilisateur'),
									  'login' => $this->input->post('login'),
									  'email' => $this->input->post('email'),
									  'niveau' => $this->input->post('niveau'));

						// On met à jour les données :
						$this->db->where('id_utilisateur', $this->input->post('id_utilisateur'));
						$this->db->update('utilisateur', $data);						
		
						// On redirige l'utilisateur vers la page d'accueil :
						redirect('administration/administrer_utilisateurs');

					} else {

						// Ici les logins sont différents, il faut vérifier que le nouveau login n'est pas déjà utilisé
						$pseudo = $this->input->post('login');
		
						$resultat2 = $this->db->query("SELECT * FROM utilisateur WHERE login = ?", array($pseudo));
						$rows2 = $resultat2->num_rows();
			
						if($rows2>0) {
			
							$data2 = array();
							$data2['erreur_login'] = "Ce login est déjà utilisé...";
							$data2['menu_categories'] = $this->menu_categories;

							$this->layout->view('modifier_utilisateur', $data2);

						} else {

							// On peut mettre à jour les données :
							$data = array('nom_utilisateur' => $this->input->post('nom_utilisateur'),
									  'prenom_utilisateur' => $this->input->post('prenom_utilisateur'),
									  'login' => $this->input->post('login'),
									  'email' => $this->input->post('email'),
									  'niveau' => $this->input->post('niveau'));

							// On met à jour les données :
							$this->db->where('id_utilisateur', $this->input->post('id_utilisateur'));
							$this->db->update('utilisateur', $data);						
			
							// On redirige l'utilisateur vers la page d'accueil :
							redirect('administration/administrer_utilisateurs');

						}

					}

				} else {

					// Ici l'adresse mail a été modifiée, il faut alors vérifier qu'elle n'est pas déjà présente en bdd :
					$mail = $this->input->post('email');
					$mail = htmlspecialchars($mail);
			
					$resultat = $this->db->query("SELECT * FROM utilisateur WHERE email = ?", array($mail));
					$rows = $resultat->num_rows();

					$resultat->free_result();

					if($rows>0) {	
			
							$data = array();
							$data['erreur'] = "Cette adresse email est déjà utilisée...";
							$data['menu_categories'] = $this->menu_categories;

							$this->layout->view('modifier_utilisateur', $data);
			
					} else {

						// Ici, l'adresse mail n'a pas encore été utilisée, il faut maintenant comparer les logins :
						if($old_utilisateur->login == $this->input->post('login')) {

							// Ici, les logins sont identiques, on peut mettre les données à jour :
							$data = array('nom_utilisateur' => $this->input->post('nom_utilisateur'),
										  'prenom_utilisateur' => $this->input->post('prenom_utilisateur'),
										  'login' => $this->input->post('login'),
										  'email' => $this->input->post('email'),
										  'niveau' => $this->input->post('niveau'));

							// On met à jour les données :
							$this->db->where('id_utilisateur', $this->input->post('id_utilisateur'));
							$this->db->update('utilisateur', $data);						
			
							// On redirige l'utilisateur vers la page d'accueil :
							redirect('administration/administrer_utilisateurs');

						} else {

							// Ici les logins sont différents, il faut vérifier que le nouveau login n'est pas déjà utilisé
							$pseudo = $this->input->post('login');
			
							$resultat2 = $this->db->query("SELECT * FROM utilisateur WHERE login = ?", array($pseudo));
							$rows2 = $resultat2->num_rows();
				
							if($rows2>0) {
				
								$data2 = array();
								$data2['erreur_login'] = "Ce login est déjà utilisé...";
								$data2['menu_categories'] = $this->menu_categories;

								$this->layout->view('modifier_utilisateur', $data2);

							} else {

								// On peut mettre à jour les données :
								$data = array('nom_utilisateur' => $this->input->post('nom_utilisateur'),
										  'prenom_utilisateur' => $this->input->post('prenom_utilisateur'),
										  'login' => $this->input->post('login'),
										  'email' => $this->input->post('email'),
										  'niveau' => $this->input->post('niveau'));

								// On met à jour les données :
								$this->db->where('id_utilisateur', $this->input->post('id_utilisateur'));
								$this->db->update('utilisateur', $data);						
				
								// On redirige l'utilisateur vers la page d'accueil :
								redirect('administration/administrer_utilisateurs');

							}

						}

					}

				}

			} else {

				$this->load->model('UtilisateurManager');

				$utilisateurManager = new UtilisateurManager();
				$utilisateur = $utilisateurManager->get_utilisateur_by_id_object($id);

				$data = array();

				$data['menu_categories'] = $this->menu_categories;
				$data['utilisateur'] = $utilisateur;

				$this->layout->view('modifier_utilisateur', $data);

			}

		} else {

			redirect('accueil');

		}

	}

	public function modifier_categorie($id=null) {

		// On vérifie qu'il s'agit bien d'un admin :
		if(is_connected() && $_SESSION['niveau'] == 1) {

			$this->load->helper('form');
			$this->load->library('form_validation');

			// On fixe les règles concernant l'ajout d'une recette :
			$this->form_validation->set_rules('categorie', '"Nom de la catégorie"', 'trim|required|encode_php_tags');

			if($this->form_validation->run()) {

				$data = array('nom_categorie' => $this->input->post('categorie'));

				// On met à jour les données :
				$this->db->where('id_categorie', $this->input->post('id_categorie'));
				$this->db->update('categorie', $data);

				redirect('administration/administrer_categories');

			} else {

				$this->load->model('CategorieManager');

				$categorieManager = new CategorieManager();

				$donnees = $categorieManager->get_categorie_by_id($id);

				$categorie = $donnees['nom_categorie'];

				$data = array();

				$data['categorie'] = $categorie;
				$data['id'] = $id;
				$data['menu_categories'] = $this->menu_categories;

				$this->layout->view('modifier_categorie', $data);

			}

		} else {

			redirect('accueil');

		}

	}

	public function supprimer_sous_categorie($id) {

		// On vérifie qu'il s'agit bien d'un admin :
		if(is_connected() && $_SESSION['niveau'] == 1) {

			$this->load->model('CategorieManager');

			$categorieManager = new CategorieManager();

			$categorieManager->supprimer_categorie($id);

			$confirmation = '<p id="confirmation">La sous-catégorie a bien été supprimée.</p>';

			$this->session->set_flashdata('message', $confirmation);

			redirect('Administration/administrer_sous_categories');

		} else {

			redirect('accueil');

		}

	}

	public function modifier_sous_categorie($id=null) {

		// On vérifie qu'il s'agit bien d'un admin :
		if(is_connected() && $_SESSION['niveau'] == 1) {

			$this->load->helper('form');
			$this->load->library('form_validation');

			// On fixe les règles concernant l'ajout d'une recette :
			//$this->form_validation->set_rules('categorie_mere', '"Nom de la catégorie mère"', 'trim|required|encode_php_tags');
			$this->form_validation->set_rules('categorie_fille', '"Nom de la sous-catégorie"', 'trim|required|encode_php_tags');

			if($this->form_validation->run()) {

				// On récupère l'id de la catégorie mère :
				$this->load->model('CategorieManager');

				$categorieManager = new CategorieManager();

				$data = array('nom_categorie' => $this->input->post('categorie_fille'));

				// On met à jour les données :
				$this->db->where('id_categorie', $this->input->post('id_categorie'));
				$this->db->update('categorie', $data);

				redirect('administration/administrer_sous_categories');

			} else {

				$this->load->model('CategorieManager');

				$categorieManager = new CategorieManager();

				$sous_categorie = $categorieManager->get_categorie_mere($id);

				$data = array();

				$data['sous_categorie'] = $sous_categorie;
				$data['id'] = $id;
				$data['menu_categories'] = $this->menu_categories;

				$this->layout->view('modifier_sous_categorie', $data);

			}

		} else {

			redirect('accueil');

		}

	}

}