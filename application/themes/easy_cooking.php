<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $titre; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
    <!--Boucle pour inclure les différents liens css-->
    <?php foreach($css as $url): ?>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
	<?php endforeach; ?>


    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    
</head><!--/head-->

<body>

<div class="page">

	<div class="main_bloc">

	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">						
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="<?php echo site_url('accueil'); ?>"><img src="<?php echo img_url('home/logo_4.jpg'); ?>" alt="" /></a>
						</div>
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i><?php if(isset($_SESSION['login'])) {echo $_SESSION['login'];} else {echo "Inscription/Connexion";} ?><span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">

										<?php

										if(isset($_SESSION['login']) && !empty($_SESSION['login'])) {

											echo '<li><a href="'.site_url("accueil/deconnexion").'">Déconnexion</a></li>';
											//echo '<li><a href="#">Mon compte</a></li>';

										} else {

											echo '<li><a href="'.site_url('accueil/inscription').'">Inscription</a></li>';
											echo '<li><a href="'.site_url('accueil/connexion').'">Connexion</a></li>';

										} ?>							            
							            
							         </ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="<?php echo site_url('accueil'); ?>" <?php if(isset($active) && $active=="accueil") { echo 'class="active"'; } ?>>Accueil</a></li>
								<li><a href="#">Catégories</a>
									<ul role="menu" class="sub-menu">
										<?php

											foreach($menu_categories as $menu_cat) {

												echo ' <li><a href="'.site_url('recettes/categories/'.$menu_cat->nom_categorie).'">'.$menu_cat->nom_categorie.'</a></li>';

											}

										?> 
	                                </ul>
	                            </li>
								<li><a href="<?php echo site_url('administration/ajouter_recette'); ?>" <?php if(isset($active) && $active=="ajouter_recette") { echo 'class="active"'; } ?>>Ajouter une recette</a></li>

								<?php

									if(isset($_SESSION['login']) && !empty($_SESSION['login'])) {

										if(isset($active) && $active=="administrer") {

											echo '<li><a href="'.site_url("administration/administrer").'" class="active">Administration</a></li>';

										} else {

											echo '<li><a href="'.site_url("administration/administrer").'">Administration</a></li>';

										}
																				

									}											

								?>
								<li><a href="#">Contact</a></li>
							</ul>
						</div>
					</div>
					<!--<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>-->
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section>
		<?php echo $output; ?>
	</section>

	</div>
	
	<footer id="footer"><!--Footer-->
		
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>EASY COOKING</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="<?php echo site_url('accueil'); ?>">Accueil</a></li>
								<li><a href="<?php echo site_url('administration/ajouter_recette'); ?>">Ajouter une recette</a></li>
								<li><a href="#">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Recettes</h2>
							<ul class="nav nav-pills nav-stacked">
								<?php

									foreach ($menu_categories as $menu) {
										
										echo '<li><a href="'.site_url('recettes/categories/'.$menu->nom_categorie).'">'.$menu->nom_categorie.'</a></li>';

									}

								?>
															
							</ul>
						</div>
					</div>
					
					<div class="col-sm-3 col-sm-offset-5">
						<div class="single-widget">
							<h2>Nous Suivre</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Obtenez nos dernières informations...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->

</div>

	<?php foreach($js as $url): ?>
		<script type="text/javascript" src="<?php echo $url; ?>"></script> 
	<?php endforeach; ?>

  
</body>
</html>