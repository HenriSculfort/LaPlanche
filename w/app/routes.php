<?php
	
	$w_routes = array(
		['GET|POST', '/', 'Default#listWhereCourts', 'accueil'],
		['GET|POST', '/terrains/', 'Terrains#listAllCourts', 'terrains'],
		['GET|POST', '/contact/', 'Contact#sendForm', 'contact'],
		['GET|POST', '/connexion/', 'Users#login', 'connexion'],
		['GET|POST', '/myspace/', 'Users#mySpace', 'users_myspace'],
		['GET|POST', '/forgotten/', 'Tokens#formTokens', 'users_tokensForm'],
		['GET|POST', '/forgotten/Ajax', 'Tokens#creatTokens', 'users_tokensAjax']

	);