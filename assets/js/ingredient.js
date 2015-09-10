$(document).ready(function(){

	$('#btn-ingredient').click(function(){

		$(this).before('<div><label for="ingredients">Ingrédient :</label><input class="form-ingredient" type="text" placeholder="Ingredient"> </input><label for="quantite">Quantité : </label><input class="form-quantite" type="text" placeholder="ex : 200g"></input></div>');

	});

});