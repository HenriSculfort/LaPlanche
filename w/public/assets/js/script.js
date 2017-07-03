

//***********************  AFFICHAGE DU BOUTON PAGE TOP en scroll *********************///
window.onscroll = function() { 
	scrollFunction() };

function scrollFunction() { 
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20 ) { 
		document.getElementById('btnPageTop').style.display = 'block';
	} else { 
		document.getElementById('btnPageTop').style.display = 'none';
	}
}

// Lorsque le bouton est cliqué.
function goToTop() { 
	document.body.scrollTop = 0; // Compatible Chrome, Safari et Opéra 
	document.documentElement.scrollTop = 0; // Pour IE et
}


// ******************** SLIDER DE DISTANCE MOTEUR RECHERCHE *************/

$('#distance').slider ({ 
	formatter: function(km) { 
		return 'Distance : ' + km + 'km';
	}
});