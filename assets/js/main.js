/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});

	// Liste déroulante des sous-catégories dépendant de la catégorie sélectionnée :

	var getUrl = window.location;
	var baseUrl = getUrl.protocol +"//"+getUrl.host+"/"+getUrl.pathname.split('/')[1];
	var $sous_categorie = $('.ss_cat');

	$sous_categorie.on('click', function(){
		
		var val = $(this).text(); // on récupère la valeur de la catégorie

		if (val !='') {

			$(".features_items").empty(); // on vide la liste des sous-catégories
			

			$.ajax({
				url: baseUrl+'/recettes/sous_categorie',
				data: 'sous_categorie='+val, // on envoie $_GET['categorie']
				dataType: 'json',
				success: function(json) {

					$("#list_ss_cat").hide();

					$("#list_ss_cat").append('<h2 class="title text-center">Recettes pour " '+val+' "</h2>');

					$.each(json, function(index, value) {

						$("#list_ss_cat").append('<div class="col-sm-4"><div class="product-image-wrapper"><div class="productinfo text-center"><a href="'+baseUrl+'/recettes/detail/'+value.id_recette+'"><img src="'+baseUrl+'/assets/images/recettes/miniature_'+value.photo+'" alt="" class="img-thumbnail"/><h4>'+value.titre+'</h4></a></div></div></div>');
											
					});

					$("#list_ss_cat").show('50000');
				}
			});
		}
	});
});
