$(document).ready(function(){

	var getUrl = window.location;
	var baseUrl = getUrl.protocol +"//"+getUrl.host+"/"+getUrl.pathname.split('/')[1];

	$('#login').keyup(function(){

		var login = $('#login').val();

		login = $.trim(login);

		if(login!="") {

			$.post(baseUrl+"/accueil/verif_pseudo", {login:login}, function(data){

				if(data=="1"){

					$('.feedbackLogin').text('');

					$('#login').css({
						'background-image':'url('+baseUrl+'/assets/images/inscription/valide.png)',
						'background-repeat': 'no-repeat',
						'background-position':'97%'
					});

					$('#submit_inscription').removeAttr('disabled');

				} else {
					$('#login').css({
						'background-image':'url('+baseUrl+'/assets/images/inscription/non_valide.png)',
						'background-repeat': 'no-repeat',
						'background-position':'97%'
					});

					$('.feedbackLogin').text('Pseudo indisponible');

					$('#submit_inscription').attr('disabled', 'disabled');

				}

			});

		} else {

			$('.feedbackLogin').text('Veuillez saisir un pseudo.');

			$('#login').css({
						'background-image':'url('+baseUrl+'/assets/images/inscription/non_valide.png)',
						'background-repeat': 'no-repeat',
						'background-position':'97%'
			});

			$('#submit_inscription').attr('disabled', 'disabled');

		}

	});

	$('#email').keyup(function(){

		var email = $('#email').val();

		email = $.trim(email);

		if(email!="") {

			$.post(baseUrl+"/accueil/verif_email", {email:email}, function(data){

				if(data=="2"){

					$('.feedbackEmail').text('');

					$('#email').css({
						'background-image':'url('+baseUrl+'/assets/images/inscription/valide.png)',
						'background-repeat': 'no-repeat',
						'background-position':'97%'
					});

					$('#submit_inscription').removeAttr('disabled');
					
				} else {

					if (data=="1") {

						$('#email').css({
						'background-image':'url('+baseUrl+'/assets/images/inscription/non_valide.png)',
						'background-repeat': 'no-repeat',
						'background-position':'97%'
						});

						$('.feedbackEmail').text('Adresse email déjà utilisée.');

						$('#submit_inscription').attr('disabled', 'disabled');

					} else {

						$('#email').css({
						'background-image':'url('+baseUrl+'/assets/images/inscription/non_valide.png)',
						'background-repeat': 'no-repeat',
						'background-position':'97%'
						});

						$('.feedbackEmail').text('Format de l\'adresse email invalide.');

						$('#submit_inscription').attr('disabled', 'disabled');

					}
					

				}

			});

		} else {

			$('.feedbackEmail').text('Veuillez saisir une adresse email.');

			$('#email').css({
						'background-image':'url('+baseUrl+'/assets/images/inscription/non_valide.png)',
						'background-repeat': 'no-repeat',
						'background-position':'97%'
			});

			$('#submit_inscription').attr('disabled', 'disabled');

		}

	});


});