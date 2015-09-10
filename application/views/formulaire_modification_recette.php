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
											<h4 class="panel-title" id="liste_recettes"><a href="#">Liste des utilisateurs</a></h4>
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
						<h2 class="title text-center">Modifier une recette</h2>

						<div class="loader"><h1>Chargement en cours</h1></div>

						<div class="signup-form">						    
						    <form class="formulaire_recette" method="post" enctype="multipart/form-data" action="<?php echo site_url('administration/modifier'); ?>">

						    	<label for="titre">Titre de la recette* :</label>
						        <input type="text" name="titre" id="titre" placeholder="Titre de la recette" value="<?php if(isset($recette)) { echo $recette->titre; } else { echo set_value('titre'); }?>"></input>
						        <?php echo form_error('titre' , '<p style="color:red;">', '</p>'); ?>

						        <label for="categorie">Catégorie* :</label>
						        <select class="form-control" id="categorie" name="categorie">
						        	<option value="">-- Catégories --</option>
						        	<?php foreach ($categories as $categorie) {
						        		
						        		if($categorie->id_categorie == $recette->id_categorie) {

						        			echo "<option value=\"".$categorie->nom_categorie."\" selected>".$categorie->nom_categorie."</option>";

						        		} else {

						        			echo "<option value=\"".$categorie->nom_categorie."\">".$categorie->nom_categorie."</option>";

						        		}
						  

						        	}?>								
								</select>
								<?php echo form_error('categorie' , '<p style="color:red;">', '</p>'); ?>

								<label for="sous_categorie">Sous-Catégorie :</label>
						        <select class="form-control" id="sous_categorie" name="sous_categorie">
						        	<option value="">-- Sous-Catégories --</option>	

						        	<?php foreach ($sous_categories as $sous_categorie) {
						        		
						        		if($sous_categorie->id_categorie == $recette->id_sous_categorie) {

						        			echo "<option value=\"".$sous_categorie->nom_categorie."\" selected>".$sous_categorie->nom_categorie."</option>";

						        		} else {

						        			echo "<option value=\"".$sous_categorie->nom_categorie."\">".$sous_categorie->nom_categorie."</option>";

						        		}
						  

						        	}?>	

								</select>	
								<?php echo form_error('sous_categorie' , '<p style="color:red;">', '</p>'); ?>

								<input type="hidden" name="id_recette" value="<?php echo $recette->id_recette; ?>" id="id_recette">

								<div id="liste_ingredients">						        	

						        		<?php

						        			$compteur = 0;

						        			foreach ($ingredients as $ingredient) {

						        				$compteur++;

						        				echo '<div class="ingredient_detail">';

						        				echo '<label for="ingredients">Ingrédient* :</label><input class="form-ingredient" value="'.$ingredient->nom_ingredient.'" name="ingredient_'.$compteur.'" type="text" id="ingredients" placeholder="Ingredient"></input> ';
						        				echo '<label for="quantite">Quantité* :</label><input class="form-quantite" value="'.$ingredient->quantite.'" name="quantite_'.$compteur.'" type="text" id="quantite" placeholder="ex : 200g"></input>';

						        				echo "</div>";
						           			}

						        		?>
						        		
						        		<?php echo form_error('ingredient_'.$compteur , '<p style="color:red;">', '</p>'); ?>
						        		<?php echo form_error('quantite_'.$compteur , '<p style="color:red;">', '</p>'); ?>
						        						        
						        	
						        </div>

						        <div>
						        	<button class="btn-ingredient" id="btn-ingredient" type="button">Ingrédient en +</button>
						        	<button class="btn-ingredient" id="btn-ingredient-en-moins" type="button">Ingrédient en -</button>
						        </div>

						        <input type="hidden" name="nb_ingredients" value="1" id="compteur_ingredients">

						        <label for="preparation">Préparation* :</label>
						        <textarea class="form-control" id="preparation" name="preparation"><?php if(isset($recette)) { echo $recette->description; } else { echo set_value('description'); }?></textarea>
						        <?php echo form_error('preparation' , '<p style="color:red;">', '</p>'); ?>

						        <label for="nb_personnes">Nombre de personnes* :</label>
						        <input type="number" min="1"  name="nb_personnes" id="nb_personnes" placeholder="Veuillez saisir un nombre" value="<?php if(isset($recette)) { echo $recette->nombre_personnes; } else { echo set_value('description'); } ?>"></input>
						        <?php echo form_error('nb_personnes' , '<p style="color:red;">', '</p>'); ?>

						        <label for="duree">Durée (en minutes)* :</label>
						        <input type="number" min="1" name="duree"  id="duree" placeholder="Veuillez saisir un nombre" value="<?php if(isset($recette)) { echo $recette->duree; } else { echo set_value('duree'); } ?>"></input>
						        <?php echo form_error('duree' , '<p style="color:red;">', '</p>'); ?>

						        <label for="prix">Prix* :</label>
						        <select class="form-control" id="prix" name="prix">
						        	<?php 
						        		if($recette->categorie_prix == "Economique") {

						        			echo '<option selected>Economique</option>';
						        			echo '<option>Normal</option>';
						        			echo '<option>Cher</option>';

						        		} elseif ($recette->categorie_prix == "Normal") {

						        			echo '<option>Economique</option>';
						        			echo '<option selected>Normal</option>';
						        			echo '<option>Cher</option>';
						        			# code...
						        		} else {

						        			echo '<option>Economique</option>';
						        			echo '<option>Normal</option>';
						        			echo '<option selected>Cher</option>';

						        		}

						        	?>
								  
								</select>
								<?php echo form_error('prix' , '<p style="color:red;">', '</p>'); ?>

								<label for="difficulte">Difficulté* :</label>
						        <select class="form-control" id="difficulte" name="difficulte">

						        	<?php 
						        		if($recette->categorie_difficulte == "Facile") {

						        			echo '<option selected>Facile</option>';
						        			echo '<option>Normal</option>';
						        			echo '<option>Difficile</option>';

						        		} elseif ($recette->categorie_difficulte == "Normal") {

						        			echo '<option>Facile</option>';
						        			echo '<option selected>Normal</option>';
						        			echo '<option>Difficile</option>';
						        			# code...
						        		} else {

						        			echo '<option>Facile</option>';
						        			echo '<option>Normal</option>';
						        			echo '<option selected>Difficile</option>';

						        		}

						        	?>
								 
								</select>
								<?php echo form_error('difficulte' , '<p style="color:red;">', '</p>'); ?>

								<label for="photo">Photo : (taille max : 2Mo, largeur max : 2000px, hauteur max : 2000px) Laissez le champ vide si vous ne voulez pas modifier votre photo.</label>
								<input type="file" name="photo"/>
								<?php echo $this->upload->display_errors('<p>', '</p>'); ?>

						        <button class="btn btn-default" type="submit">Envoyer la Recette</button>
					    	</form>
					    </div>
					</div>
				</div>
		</div>