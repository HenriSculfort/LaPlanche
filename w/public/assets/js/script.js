

//***********************  AFFICHAGE DU BOUTON PAGE TOP en scroll *********************///
$(document).ready( function(){
    
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } 
        else {
            $('.scrollToTop').fadeOut();
        }
    });
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0}, 800);
        return false;
    });
});


// ******************** SLIDER DE DISTANCE MOTEUR RECHERCHE *************/

$('#distance').slider ({ 
	formatter: function(km) { 
		return 'Distance : ' + km + 'km';
	}
});