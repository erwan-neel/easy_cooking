<?php

class Accueil extends CI_Controller {

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
		//$this->layout->ajouter_js("verif_email");

		// On charge les catégories dans le menu
		$this->load->model('CategorieManager');
		$categorieManager = new CategorieManager();
		$this->menu_categories = $categorieManager->get_categories();

	}

	public function index() {

		// On charge les différentes classes et models :
		$this->load->library('recette');
		$this->load->model('recetteManager');

		$this->load->library('ingredient');
		$this->load->model('ingredientManager');

		// On instancie les managers :
		$recetteManager = new RecetteManager();
		$ingredientManager = new IngredientManager();

		// On récupère les données relatives à une recette aléatoirement :
		$donnees = $recetteManager->get_random();
		$recette = new Recette($donnees);

		// On récupère dans un tableau les id_ingredients et les quantités en lien avec la recette :
		$id_ingredients = $recetteManager->get_ingredients($recette->id_recette());

		// Pour chacun des ingrédients, on stocke dans un tableau son nom et sa quantité :
		$ingredients = array();

		foreach ($id_ingredients as $row) {
			
			$donnees = array();
			$donnees['nom'] = $ingredientManager->get_nom($row->id_ingredient)->nom_ingredient;
			$donnees['quantite'] = $row->quantite;
			
			$ingredients[] = $donnees;

		}

		$slug = url_title($recette->titre());

		// On récupère les catégories principales :
		$this->load->model('CategorieManager');

		$categorieManager = new CategorieManager();

		$categories = $categorieManager->get_categories();

		$data = array();
		$data['recette'] = $recette;
		$data['id_recette'] = $recette->id_recette();
		$data['titre'] = $recette->titre();
		$data['photo'] = $recette->photo();
		$data['description'] = $recette->description();
		$data['ingredients'] = $ingredients; // Il s'agit d'un tableau de tableaux
		$data['categories'] = $categories;
		$data['active'] = "accueil";
		$data['menu_categories'] = $this->menu_categories;

		$this->layout->view('accueil', $data);

	}

	public function connexion() {

		if(is_connected()) {

			redirect('accueil');

		} else {

			$this->load->helper('form');

			$this->load->library('form_validation');

			// On fixe les règles concernant le formulaire de connexion :
			$this->form_validation->set_rules('login_connexion', '"Login de l\'utilisateur"', 'trim|required|alpha_dash|encode_php_tags');
			$this->form_validation->set_rules('password_connexion', '"Mot de passe de l\'utilisateur"', 'trim|required|alpha_dash|encode_php_tags');

			if($this->form_validation->run()) {
			//	Le formulaire est valide

				// On cherche le mot de passe associé au pseudo en base de données :
				$resultat = $this->db->query("SELECT mot_de_passe, niveau FROM utilisateur WHERE login = ?", array($this->input->post('login_connexion')));

				if($resultat->num_rows()>0) {

					$row = $resultat->row();
					$mdp = $row->mot_de_passe;
					$niveau = $row->niveau;

					if ($mdp==$this->input->post('password_connexion')) {
						
						$_SESSION['login'] = $this->input->post('login_connexion');
						$_SESSION['niveau'] = $niveau;

						redirect('accueil');

					} else {

						$data = array();

						$data['erreur_connexion'] = "Votre pseudo ou votre mot de passe est invalide.";
						$data['menu_categories'] = $this->menu_categories;

						$this->layout->view('connexion', $data);

					}

				} else {

						$data = array();

						$data['erreur_connexion'] = "Votre pseudo ou votre mot de passe est invalide.";
						$data['menu_categories'] = $this->menu_categories;

						$this->layout->view('connexion', $data);

				}
				

				/*// On instancie les variables de session :
				$_SESSION['login'] = $this->input->post('login_connexion');

				// On redirige l'utilisateur vers la page d'accueil :
				redirect('accueil');*/

			}
			else {
			//	Le formulaire est invalide ou vide
				$data = array();
				$data['menu_categories'] = $this->menu_categories;

				$this->layout->view('connexion', $data);
			}

		}

	}

	public function inscription() {

		if(is_connected()) {

			redirect('accueil');

		} else {

				$this->load->helper('form');
		
				$this->load->library('form_validation');
		
				// On fixe les règles concernant le formulaire d'inscription :
				$this->form_validation->set_rules('nom', '"Nom de l\'utilisateur"', 'trim|required|alpha_dash|encode_php_tags');
				$this->form_validation->set_rules('prenom', '"Prénom de l\'utilisateur"', 'trim|required|alpha_dash|encode_php_tags');
				$this->form_validation->set_rules('login', '"Login de l\'utilisateur"', 'trim|required|alpha_dash|encode_php_tags');
				$this->form_validation->set_rules('email', '"Email de l\'utilisateur"', 'trim|required|valid_email|encode_php_tags');
				$this->form_validation->set_rules('mdp', '"Mot de passe de l\'utilisateur"', 'trim|required|alpha_dash|encode_php_tags');
				$this->form_validation->set_rules('mdp2', '"Mot de passe de vérification"', 'trim|required|alpha_dash|encode_php_tags|matches[mdp]');
		
				if($this->form_validation->run()) {
				//	Le formulaire est valide
					
					// On vérifie que l'adresse mail n'est pas déjà utilisée :
					$mail = $this->input->post('email');
					$mail = htmlspecialchars($mail);
		
					$resultat = $this->db->query("SELECT * FROM utilisateur WHERE email = ?", array($mail));
					$rows = $resultat->num_rows();
		
					if($rows>0) {	
		
						$data = array();
						$data['erreur'] = "Cette adresse email est déjà utilisée...";
						$data['menu_categories'] = $this->menu_categories;

						$this->layout->view('inscription', $data);
		
					} else {
						
						// On vérifie désormais que le pseudo n'est pas déjà utilisé :
						$pseudo = $this->input->post('login');
		
						$resultat2 = $this->db->query("SELECT * FROM utilisateur WHERE login = ?", array($pseudo));
						$rows2 = $resultat2->num_rows();
		
						if($rows2>0) {
		
							$data2 = array();
							$data2['erreur_login'] = "Ce login est déjà utilisé...";
							$data2['menu_categories'] = $this->menu_categories;

							$this->layout->view('inscription', $data2);
		
						} else {
		
							// Ici on instancie les variables de session et on enregistre l'utilisateur en base de données :
							// On charge les éléments nécessaires :
							$this->load->library('utilisateur');
							$this->load->model('utilisateurManager');
		
							// On récupère les données envoyées par le formulaire d'inscription afin d'instancier un objet Utilisateur :
							$utilisateur = new Utilisateur();
							$utilisateur->setNom($this->input->post('nom'));
							$utilisateur->setPrenom($this->input->post('prenom'));
							$utilisateur->setLogin($this->input->post('login'));
							$utilisateur->setEmail($this->input->post('email'));
							$utilisateur->setPassword($this->input->post('mdp'));
							$utilisateur->setNiveau('2');
		
							// On ajoute l'utilisateur en bdd via le manager :
							$this->utilisateurManager->ajouter_utilisateur($utilisateur);
		
							// On instancie les variables de session :
							$this->session->set_userdata('login', $utilisateur->login());
							$this->session->set_userdata('niveau', $utilisateur->niveau());
		
							// On redirige l'utilisateur vers la page d'accueil :
							redirect('accueil');
		
						}
		
					}
		
		
					
		
				}
				else {
				//	Le formulaire est invalide ou vide
					$data = array();
					$data['menu_categories'] = $this->menu_categories;

					$this->layout->view('inscription', $data);
				}

		}

	}

	// Cette méthode est appelée via Ajax pour vérifier la disponibilité d'un pseudo
	public function verif_pseudo() {

		if(isset($_POST['login']) && !empty($_POST['login'])) {

			$login = htmlspecialchars($_POST['login']);

			$query = $this->db->query('SELECT * FROM utilisateur WHERE login = ?', array($login));

			$rows = $query->num_rows();
		
			if($rows==1) {

				echo "0";

			} else {

				echo "1";

			}

			$query->free_result();

		}

	}

	public function verif_email() {

		if(isset($_POST['email']) && !empty($_POST['email'])) {

			$email = htmlspecialchars($_POST['email']);

			if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.+[a-z]{2,4}$#", $email)) {

				$query = $this->db->query('SELECT * FROM utilisateur WHERE email = ?', array($email));

				$rows = $query->num_rows();
			
				if($rows==1) {

					echo "1";

				} else {

					echo "2";

				}

			} else {

				echo "0";

			}			

			//$query->free_result();

		}

	}

	public function test() {

		$this->load->library('recette');
		$this->load->model('recetteManager');

		$recetteManager = new RecetteManager();
		
		$donnees = $recetteManager->get_recette(1);

		$recette = new Recette($donnees);

		echo $recette->titre();

	}

	public function deconnexion() {

		$this->session->sess_destroy();

		redirect('accueil');

	}

}