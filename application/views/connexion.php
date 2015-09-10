<div class="container" style="margin-bottom: 60px;">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Connectez-vous :</h2>
						<?php echo form_open('accueil/connexion'); ?>
						
							<p class="feedbackConnexion"><?php if(isset($erreur_connexion) && !empty($erreur_connexion)) { echo $erreur_connexion; } ?></p>

							<input type="text" name="login_connexion" placeholder="Login" value="<?php echo set_value('login_connexion'); ?>"/>
							<?php echo form_error('login_connexion' , '<p style="color:red;">', '</p>'); ?>

							<input type="password" name="password_connexion" placeholder="Password" value="<?php echo set_value('password_connexion'); ?>"/>
							<?php echo form_error('password_connexion' , '<p style="color:red;">', '</p>'); ?>

							<button type="submit" class="btn btn-default">Connexion</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OU</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Inscrivez-vous !</h2>						

						<?php echo form_open('accueil/inscription'); ?>
						
							<input type="text" name="nom" placeholder="Nom" value="<?php echo set_value('nom'); ?>"/>
							<?php echo form_error('nom' , '<p style="color:red;">', '</p>'); ?>

							<input type="text" name="prenom" placeholder="Prénom" value="<?php echo set_value('prenom'); ?>"/>
							<?php echo form_error('prenom' , '<p style="color:red;">', '</p>'); ?>

							<input type="text" id="login" autocomplete="off" name="login" placeholder="Login" value="<?php echo set_value('login'); ?>"/>
							<?php echo form_error('login' , '<p style="color:red;">', '</p>'); ?>
							<p class="feedbackLogin"><?php if(isset($erreur_login) && !empty($erreur_login)) { echo $erreur_login; } ?></p>

							<input type="email" id="email" autocomplete="off" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>"/>
							<?php echo form_error('email' , '<p style="color:red;">', '</p>'); ?>
							<p class="feedbackEmail"><?php if(isset($erreur) && !empty($erreur)) { echo $erreur; } ?></p>

							<input type="password" name="mdp" placeholder="Password"/>
							<?php echo form_error('mdp' , '<p style="color:red;">', '</p>'); ?>

							<input type="password" name="mdp2" placeholder="Confirmer Password"/>
							<?php echo form_error('mdp2' , '<p style="color:red;">', '</p>'); ?>

							<button type="submit" id="submit_inscription" class="btn btn-default">Inscription</button>

						</form>
					</div><!--/sign up form-->
				</div>
			</div>
</div>