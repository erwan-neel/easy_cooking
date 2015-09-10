<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2 class="title text-center">Administration</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->

							<?php 

								if($_SESSION['niveau'] == 1) {

								?>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title" id="liste_recettes"><a href="<?php echo site_url('administration/administrer_utilisateurs'); ?>">Liste des utilisateurs</a></h4>
										</div>
									</div>

								<?php

								}

							?>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title" id="creer_recette"><a href="<?php echo site_url('administration/ajouter_recette'); ?>">Créer une recette</a></h4>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title" id="liste_recettes"><a href="<?php echo site_url('administration/administrer'); ?>">Liste des recettes</a></h4>
								</div>
							</div>

							<?php 

								if($_SESSION['niveau'] == 1) {

								?>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title" id="liste_recettes"><a href="<?php echo site_url('administration/ajouter_categorie'); ?>">Créer une catégorie</a></h4>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title" id="liste_recettes"><a href="<?php echo site_url('administration/administrer_categories'); ?>">Liste des catégories</a></h4>
										</div>
									</div>

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title" id="liste_recettes"><a href="<?php echo site_url('administration/ajouter_sous_categorie'); ?>">Créer une sous-catégorie</a></h4>
										</div>
									</div>								

									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title" id="liste_recettes"><a href="<?php echo site_url('administration/administrer_sous_categories'); ?>">Liste des sous-catégories</a></h4>
										</div>
									</div>

								<?php

								}

							?>	
						
						</div><!--/category-products-->					
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">

					<div class="left-sidebar">
						<h2 class="title text-center">Créer une recette</h2>

						<div class="loader"><h1>Chargement en cours</h1></div>
						
						<div class="signup-form">						    
						    <form class="formulaire_recette" method="post" enctype="multipart/form-data" action="<?php echo site_url('administration/ajouter_recette'); ?>">

						    	

						    	<label for="titre">Titre de la recette* :</label>
						        <input type="text" name="titre" id="titre" required placeholder="Titre de la recette" value="<?php echo set_value('titre'); ?>"></input>
						        <?php echo form_error('titre' , '<p style="color:red;">', '</p>'); ?>

						        <label for="categorie">Catégorie* :</label>
						        <select class="form-control" id="categorie" required name="categorie">
						        	<option value="">-- Catégories --</option>
						        	<?php foreach ($categories as $key => $value) {
						        		
						        		echo "<option value=\"".$value."\">".$value."</option>";

						        	}?>								
								</select>
								<?php echo form_error('categorie' , '<p style="color:red;">', '</p>'); ?>

								<label for="sous_categorie">Sous-Catégorie :</label>
						        <select class="form-control" id="sous_categorie" name="sous_categorie">
						        	<option value="">-- Sous-Catégories --</option>								  
								</select>	
								<?php echo form_error('sous_categorie' , '<p style="color:red;">', '</p>'); ?>				    

						        <div id="liste_ingredients">

						        	<div class="ingredient_detail">
						        		<label for="ingredients">Ingrédient* :</label><input class="form-ingredient" required name="ingredient_1" type="text" id="ingredients" placeholder="Ingredient"></input>

						        		<label for="quantite">Quantité* :</label><input class="form-quantite" required name="quantite_1" type="text" id="quantite" placeholder="ex : 200g"></input>

						        		<?php echo form_error('ingredient_1' , '<p style="color:red;">', '</p>'); ?>
						        		<?php echo form_error('quantite_1' , '<p style="color:red;">', '</p>'); ?>
						        	</div>						        
						        	
						        </div>

						        <div>
						        	<button class="btn-ingredient" id="btn-ingredient" type="button">Ingrédient en +</button>
						        	<button class="btn-ingredient" id="btn-ingredient-en-moins" type="button">Ingrédient en -</button>
						        </div>

						        <input type="hidden" name="nb_ingredients" value="1" id="compteur_ingredients">

						        <label for="preparation">Préparation* :</label>
						        <textarea class="form-control" id="preparation" name="preparation" required></textarea>
						        <?php echo form_error('preparation' , '<p style="color:red;">', '</p>'); ?>

						        <label for="nb_personnes">Nombre de personnes* :</label>
						        <input type="number" min="1"  name="nb_personnes" id="nb_personnes" placeholder="Veuillez saisir un nombre" required></input>
						        <?php echo form_error('nb_personnes' , '<p style="color:red;">', '</p>'); ?>

						        <label for="duree">Durée (en minutes)* :</label>
						        <input type="number" min="1" name="duree"  id="duree" placeholder="Veuillez saisir un nombre" required></input>
						        <?php echo form_error('duree' , '<p style="color:red;">', '</p>'); ?>

						        <label for="prix">Prix* :</label>
						        <select class="form-control" id="prix" name="prix" required>
								  <option>Economique</option>
								  <option>Normal</option>
								  <option>Cher</option>
								</select>
								<?php echo form_error('prix' , '<p style="color:red;">', '</p>'); ?>

								<label for="difficulte">Difficulté* :</label>
						        <select class="form-control" id="difficulte" name="difficulte" required>
								  <option>Facile</option>
								  <option>Normal</option>
								  <option>Difficile</option>
								</select>
								<?php echo form_error('difficulte' , '<p style="color:red;">', '</p>'); ?>

								<label for="photo">Photo : (taille max : 2Mo, largeur max : 2000px, hauteur max : 2000px)</label>
								<input type="file" name="photo" />
								<?php echo $this->upload->display_errors('<p>', '</p>'); ?>

						        <button class="btn btn-default" type="submit">Envoyer la Recette</button>
					    	</form>
					    </div>
					</div>
				</div>
		</div>