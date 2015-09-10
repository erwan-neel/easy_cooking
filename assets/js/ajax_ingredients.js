$(document).ready(function(){

	var getUrl = window.location;
	var baseUrl = getUrl.protocol +"//"+getUrl.host+"/"+getUrl.pathname.split('/')[1];

	var compteur_ingredients = $(".ingredient_detail").length;

	$('#compteur_ingredients').val(compteur_ingredients);

	$('#btn-ingredient-en-moins').hide();

	$('.form-ingredient').autocomplete({
		source : baseUrl+"/administration/ajax_ingredients"
	});

	$('#btn-ingredient').click(function(){

		compteur_ingredients++;

		$('#liste_ingredients').append('<div class="ingredient_detail"><label for="ingredients">Ingrédient* :</label><input class="form-ingredient" required name="ingredient_'+compteur_ingredients+'" type="text" placeholder="Ingredient"> </input><label for="quantite">Quantité* : </label><input class="form-quantite" required name="quantite_'+compteur_ingredients+'" type="text" placeholder="ex : 200g"></input></div>');
		
		$('.form-ingredient').autocomplete({
			source : baseUrl+"/administration/ajax_ingredients"
		});

		$('#compteur_ingredients').val(compteur_ingredients);

		$('#btn-ingredient-en-moins').show();

	});

	$('#btn-ingredient-en-moins').click(function(){

		if(compteur_ingredients>1) {

			$('#liste_ingredients div').last().remove();

			compteur_ingredients--;

			$('#compteur_ingredients').val(compteur_ingredients);

		}		

	});

	if(compteur_ingredients>1) {

		$('#btn-ingredient-en-moins').show();

	}

	// Liste déroulante des sous-catégories dépendant de la catégorie sélectionnée :

	var $categorie = $('#categorie');
	var $sous_categorie = $('#sous_categorie');

	$categorie.on('change', function(){
		var val = $(this).val(); // on récupère la valeur de la catégorie

		if (val !='') {
			$sous_categorie.empty(); // on vide la liste des sous-catégories

			$.ajax({
				url: baseUrl+'/administration/sous_categorie',
				data: 'categorie='+val, // on envoie $_GET['categorie']
				dataType: 'json',
				success: function(json) {
					$.each(json, function(index, value) {
						$sous_categorie.append('<option value="'+value+'">'+value+'</option>');
					});
				}
			});
		}
	});

	// Demander validation avant de supprimer une recette :
	/*$("#supprimer_recette").click(function() {

		var msg = "Etes-vous sûr de vouloir supprimer cette recette ?";

		if(confirm(msg)) {

			location.replace()

		}

	})*/

});