<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Administration</h2>
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
				
				<div id="zone" class="col-sm-9 padding-right">

					<div class="left-sidebar">

						<h2 class="title text-center">Liste des utilisateurs</h2>

						<div class="loader"><h1>Chargement en cours</h1></div>

						<?php if(isset($confirmation)) {echo $confirmation;}?>

						<table class="table_admin" id="tableau_recette">
							<thead>
								<tr class="tr_titre">
									<th>Nom</th>
									<th>Prénom</th>
									<th>Email</th>
									<th>Login</th>
									<th>Niveau</th>
									<th>Modifier</th>
									<th>Supprimer</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($utilisateurs as $utilisateur) {
										
										echo "<tr><td>".$utilisateur->nom_utilisateur."</td>";
										echo "<td>".$utilisateur->prenom_utilisateur."</td>";
										echo "<td>".$utilisateur->email."</td>";
										echo "<td>".$utilisateur->login."</td>";
										echo "<td>".$utilisateur->niveau."</td>";
										echo '<td><a href="'.site_url('administration/modifier_utilisateur/'.$utilisateur->id_utilisateur).'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></td>';
										echo '<td><a href="'.site_url('administration/supprimer_utilisateur/'.$utilisateur->id_utilisateur).'" id="supprimer_recette" onclick="return confirm(\'Voulez-vous vraiment supprimer cet utilisateur ?\');"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td></tr>';
										

									}
								?>								
							</tbody>
						</table>

					</div>

					
				</div>

			</div>
		</div>