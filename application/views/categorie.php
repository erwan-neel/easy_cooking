<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2><?php echo $categorie; ?></h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
							<?php 

							if(!empty($sous_categories)) {

								foreach ($sous_categories as $sous_categorie) {

									echo '<div class="panel panel-default">';
									echo '<div class="panel-heading">';
									echo '<h4 class="panel-title"><a href="#" class="ss_cat">'.$sous_categorie->nom_categorie.'</a></h4>';
									echo '</div>';
									echo '</div>';
									# code...
								}

							}

							?>
						
						</div><!--/category-products-->					
					
					</div>
				</div>

				<div class="col-sm-9 padding-right">

					<div class="wrapp">
						<div id="list_ss_cat" class="features_items"><!--features_items-->
							<h2 class="title text-center">Recette " <?php echo $categorie; ?> " du jour</h2>

							<?php if($recette == null) {

								echo "<p style='text-align:center'>Aucune recette n'a encore été postée dans cette catégorie.<br>N'hésitez pas à en ajouter une en cliquant sur ce lien : <a href='".site_url('administration/ajouter_recette')."'>Ajouter une recette</a></p>";

							} else {

							?>

							<div class="productinfo">
								<div class="col-md-8">
									<img src="<?php echo img_url('recettes/'.$recette->photo); ?>" alt="" class="img-thumbnail"/>
								</div>
							</div>
							
							<div class="recette">
								<div class="col-md-4">
									
										<h2><?php echo strtoupper($recette->titre); ?></h2>
										<p>Ingrédients :</p>
										<ul><?php

										for ($i=0; $i<count($ingredients) ; $i++) { 

											if($i>=3) {
												echo "<li>...</li>";
												break;
											} else {
												echo "<li>- ".$ingredients[$i]->nom_ingredient." (".$ingredients[$i]->quantite.") </li>";
											}
										}

										?>
										</ul>
										<p><?php echo substr(nl2br($recette->description), 0, 45), "..."; ?></p>

										<a href="<?php echo site_url('recettes/detail/'.$recette->id_recette); ?>"><button class="btn btn-primary btn-accueil get" type="button">+ de détails</button></a>						
								</div>								
							</div>		

						</div><!--features_items-->
					</div>

					<div class="wrapp">
						<div  class="features_items"><!--features_items-->
							<h2 class="title text-center">Recettes pour " <?php echo $categorie; ?> "</h2>

								<?php

									for($i=0; $i<$nb_div; $i++) {

										echo '<div style="overflow:hidden">';

										if(($i+1) == $nb_div) {											

											for($j=$i*3; $j<$nb_recettes; $j++) {

												echo '<div class="col-sm-4">';
												echo '<div class="product-image-wrapper">';
												echo '<div class="productinfo text-center"><a href="'.site_url('recettes/detail/'.$recettes[$j]->id_recette).'"><img src="'.img_url('recettes/miniature_'.$recettes[$j]->photo).'" alt="" class="img-thumbnail"/><h4>'.$recettes[$j]->titre.'</h4></a></div>';
												echo '</div>';
												echo '</div>';

											}

										} else {	

											$deb = $i*3;
											$fin = $deb+3;										

											for($j=$deb; $j<$fin; $j++) {

												echo '<div class="col-sm-4">';
												echo '<div class="product-image-wrapper">';
												echo '<div class="productinfo text-center"><a href="'.site_url('recettes/detail/'.$recettes[$j]->id_recette).'"><img src="'.img_url('recettes/miniature_'.$recettes[$j]->photo).'" alt="" class="img-thumbnail"/><h4>'.$recettes[$j]->titre.'</h4></a></div>';
												echo '</div>';
												echo '</div>';

											}

										}										

										echo '</div>';

									}

								?>							
														

						</div><!--features_items-->
					</div>	

					<?php } ?>				

				</div>
			</div>
</div>