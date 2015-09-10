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
						<h2 class="title text-center">Modifier une catégorie</h2>

						<div class="loader"><h1>Chargement en cours</h1></div>
						
						<div class="signup-form">						    
						    <form class="formulaire_recette" method="post" action="<?php echo site_url('administration/modifier_categorie'); ?>">

								<input type="hidden" name="id_categorie" value="<?php echo $id; ?>" id="id_categorie">			    	

						    	<label for="categorie">Nom de la catégorie* :</label>
						        <input type="text" name="categorie" id="categorie" required placeholder="Nom de la catégorie" value="<?php if(isset($categorie)) { echo $categorie; } else { echo set_value('categorie'); }?>"></input>
						        <?php echo form_error('categorie' , '<p style="color:red;">', '</p>'); ?>
						        <p class="feedbackCategorie"><?php if(isset($erreur_categorie) && !empty($erreur_categorie)) { echo $erreur_categorie; } ?></p>					       

						        <button class="btn btn-default" type="submit">Envoyer la Catégorie</button>

					    	</form>
					    </div>
					</div>
				</div>
		</div>