<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Catégories</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->

							<?php 

								foreach ($categories as $categorie) {

									echo '<div class="panel panel-default">';
									echo '<div class="panel-heading">';
									echo '<h4 class="panel-title"><a href="'.site_url("recettes/categories/".$categorie->nom_categorie).'">'.$categorie->nom_categorie.'</a></h4>';
									echo '</div>';
									echo '</div>';
									# code...
								}

							?>

							
						
						</div><!--/category-products-->					
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Information</h2>

						
						<p style="text-align:center">Vous devez être inscrit et connecté à votre compte pour pouvoir ajouter une recette.<br>Pas encore inscrit sur le site ? Suivez ce lien : <a href="<?php echo site_url('accueil/inscription'); ?>">Inscription</a></p>
										

					</div><!--features_items-->
				</div>

			</div>
</div>