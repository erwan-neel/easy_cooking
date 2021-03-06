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
						<h2 class="title text-center">Créer une sous-catégorie</h2>

						<div class="loader"><h1>Chargement en cours</h1></div>
						
						<div class="signup-form">						    
						    <form class="formulaire_recette" method="post" action="<?php echo site_url('administration/ajouter_sous_categorie'); ?>">

								
								<label for="categorie_mere">Catégorie mère* :</label>
						        <select class="form-control" id="categorie_mere" required name="categorie_mere">
						        	<option value="">-- Catégories --</option>
						        	<?php foreach ($categories as $categorie) {
						        		
						        		echo "<option value=\"".$categorie->nom_categorie."\">".$categorie->nom_categorie."</option>";

						        	}?>								
								</select>
								<?php echo form_error('categorie_mere' , '<p style="color:red;">', '</p>'); ?>

								<label style="margin-top:10px" for="categorie_fille">Nom de la sous-catégorie* :</label>
						        <input type="text" name="categorie_fille" id="categorie_fille" required placeholder="Nom de la sous-catégorie" value="<?php echo set_value('categorie_fille'); ?>"></input>
						        <?php echo form_error('categorie' , '<p style="color:red;">', '</p>'); ?>
						        <p class="feedbackCategorie"><?php if(isset($erreur_categorie) && !empty($erreur_categorie)) { echo $erreur_categorie; } ?></p>					       

														    	
						        <button class="btn btn-default" type="submit">Envoyer la Sous-Catégorie</button>

					    	</form>
					    </div>
					</div>
				</div>
		</div>