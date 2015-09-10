<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Catégories</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->

							<?php 

								foreach ($categories as $categorie) {

									$url = site_url("recettes/categories/".$categorie->nom_categorie);

									echo '<div class="panel panel-default">';
									echo '<div class="panel-heading">';
									echo '<h4 class="panel-title"><a href="'.$url.'">'.$categorie->nom_categorie.'</a></h4>';
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
						<h2 class="title text-center">Recette du jour</h2>

						<div class="productinfo">
							<div class="col-md-8">
								<img src="<?php echo img_url('recettes/'.$photo); ?>" alt="" class="img-thumbnail"/>
							</div>
						</div>
						
						<div class="recette">
							<div class="col-md-4">
								<h2><?php echo strtoupper($titre); ?></h2>
								<p>Ingrédients :</p>
								<ul><?php

								for ($i=0; $i<count($ingredients) ; $i++) { 
									if($i>=3) {
										echo "<li>...</li>";
										break;
									} else {
										echo "<li>- ".$ingredients[$i]['nom']." (".$ingredients[$i]['quantite'].") </li>";
									}
								}

								?>
								</ul>
								<p><?php echo substr(nl2br($description), 0, 45), "..."; ?></p>

								<a href="<?php echo site_url('recettes/detail/'.$recette->id_recette()) ?>"><button class="btn btn-primary btn-accueil get" type="button">+ de détails</button></a>						
							</div>							
						</div>					

					</div><!--features_items-->
				</div>

			</div>
</div>