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
											<h4 class="panel-title" id="liste_utilisateurs"><a href="<?php echo site_url('administration/administrer_utilisateurs'); ?>">Liste des utilisateurs</a></h4>
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
						<h2 class="title text-center">Modifier un utilisateur</h2>

						<div class="loader"><h1>Chargement en cours</h1></div>
						
						<div class="signup-form">						    
						    <form class="formulaire_recette" method="post" action="<?php echo site_url('administration/modifier_utilisateur'); ?>">

								<input type="hidden" name="id_utilisateur" value="<?php if(isset($utilisateur)) { echo $utilisateur->id_utilisateur; } else { echo set_value('id_utilisateur'); }?>" id="id_utilisateur">			    	

						    	<label for="nom_utilisateur">Nom de l'utilisateur* :</label>
						        <input type="text" name="nom_utilisateur" id="nom_utilisateur" required placeholder="Nom de l'utilisateur" value="<?php if(isset($utilisateur)) { echo $utilisateur->nom_utilisateur; } else { echo set_value('nom_utilisateur'); }?>"></input>
						        <?php echo form_error('nom_utilisateur' , '<p style="color:red;">', '</p>'); ?>
						        <p class="feedbackCategorie"><?php if(isset($erreur_utilisateur) && !empty($erreur_utilisateur)) { echo $erreur_utilisateur; } ?></p>

						        <label for="prenom_utilisateur">Prénom de l'utilisateur* :</label>
						        <input type="text" name="prenom_utilisateur" id="prenom_utilisateur" required placeholder="Prénom de l'utilisateur" value="<?php if(isset($utilisateur)) { echo $utilisateur->prenom_utilisateur; } else { echo set_value('prenom_utilisateur'); }?>"></input>
						        <?php echo form_error('prenom_utilisateur' , '<p style="color:red;">', '</p>'); ?>
						        <p class="feedbackCategorie"><?php if(isset($erreur_utilisateur) && !empty($erreur_utilisateur)) { echo $erreur_utilisateur; } ?></p>

						        <label for="login">Login de l'utilisateur* :</label>
						        <input type="text" id="login" autocomplete="off" name="login" placeholder="Login" value="<?php if(isset($utilisateur)) { echo $utilisateur->login; } else { echo set_value('login'); }?>"/>
								<?php echo form_error('login' , '<p style="color:red;">', '</p>'); ?>
								<p class="feedbackLogin"><?php if(isset($erreur_login) && !empty($erreur_login)) { echo $erreur_login; } ?></p>

								<label for="email">Email de l'utilisateur* :</label>
								<input type="email" id="email" autocomplete="off" name="email" placeholder="Email" value="<?php if(isset($utilisateur)) { echo $utilisateur->email; } else { echo set_value('email'); }?>"/>
								<?php echo form_error('email' , '<p style="color:red;">', '</p>'); ?>
								<p class="feedbackEmail"><?php if(isset($erreur) && !empty($erreur)) { echo $erreur; } ?></p>

								<label for="niveau">Niveau de l'utilisateur* :</label>
								<input type="text" id="niveau" name="niveau" placeholder="Niveau de l'utilisateur" value="<?php if(isset($utilisateur)) { echo $utilisateur->niveau; } else { echo set_value('niveau'); }?>"/>
								<?php echo form_error('niveau' , '<p style="color:red;">', '</p>'); ?>
								

						        <button class="btn btn-default" type="submit">Envoyer la Catégorie</button>

					    	</form>
					    </div>
					</div>
				</div>
		</div>