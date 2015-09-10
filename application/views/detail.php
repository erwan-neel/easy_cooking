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

					<div class="wrapp">
						<div class="features_items"><!--features_items-->
							<h2 class="title text-center"><?php echo $recette->titre; ?></h2>

							<div class="wrapp">
								<div class="col-sm-8" style="margin-bottom:25px">
									<img src="<?php echo img_url('recettes/'.$recette->photo); ?>" alt="" class="img-thumbnail photo-recette"/>
								</div>
							
								<div class="col-sm-4">
									<div class="blog-post-area">								
										<div class="single-blog-post">							
											<div class="post-meta">
												<ul class="pull-left">
													<li><i class="fa fa-user"></i> <?php if ($recette->login) { echo $recette->login; } else { echo "Inconnu"; } ?></li><br><br>
													<li><i class="fa fa-clock-o"></i> <?php echo $recette->duree." minutes"; ?></li><br><br>
													<li><i class="fa fa-euro"></i> <?php echo $recette->categorie_prix; ?></li><br><br>
													<li><i class="fa fa-signal"></i> <?php echo $recette->categorie_difficulte; ?></li><br><br>
													<?php

													if($recette->nom_categorie) {

														echo "<li> Catégorie : ".$recette->nom_categorie."</li><br><br>";

													} else {

														echo "<li> Catégorie : Aucune </li><br><br>";

													}

													

													if($recette->nom_sous_categorie) {

														echo "<li> Sous-Catégorie : ".$recette->nom_sous_categorie."</li><br><br>";

													}
 
													?>													
												</ul>
												
											</div>
										</div>
									</div><!--/blog-post-area-->
								</div>
							</div>
						
							
							<div class="recette">
								<div class="col-md-6">
									<p>Ingrédients (<?php echo $recette->nombre_personnes; ?> personnes) :</p>
									<ul><?php

								for ($i=0; $i<count($ingredients) ; $i++) { 

									echo "<li>- ".$ingredients[$i]['nom']." (".$ingredients[$i]['quantite'].") </li>";

								}

								?>
								</ul>
									<P>Préparation :</p>
									<p><?php echo nl2br($recette->description); ?></p>						
								</div>

							</div>		

						</div><!--features_items-->
					</div>					

				</div>
			</div>
		</div>