<?php
	
	$w_routes = array(
		['GET|POST', '/', 'Default#listWhereCourts', 'accueil'],
		['GET|POST', '/terrains/', 'Terrains#listAllCourts', 'terrains'],
		['GET|POST', '/contact/', 'Contact#sendForm', 'contact'],
		['GET|POST', '/connexion/', 'Users#login', 'connexion'],
		['GET|POST', '/myspace/', 'Users#mySpace', 'users_myspace']
	);