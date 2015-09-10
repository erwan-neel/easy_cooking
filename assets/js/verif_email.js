$(document).ready(function(){

	var getUrl = window.location;
	var baseUrl = getUrl.protocol +"//"+getUrl.host+"/"+getUrl.pathname.split('/')[1];

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
				} else {

					if (data=="1") {

						$('#email').css({
						'background-image':'url('+baseUrl+'/assets/images/inscription/non_valide.png)',
						'background-repeat': 'no-repeat',
						'background-position':'97%'
						});

						$('.feedbackEmail').text('Adresse email déjà utilisée.');

					} else {

						$('#email').css({
						'background-image':'url('+baseUrl+'/assets/images/inscription/non_valide.png)',
						'background-repeat': 'no-repeat',
						'background-position':'97%'
						});

						$('.feedbackEmail').text('Format de l\'adresse email invalide.');

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

		}

	});


});