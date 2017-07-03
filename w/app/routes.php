<?php

$w_routes = array(
	['GET|POST', '/', 'Default#listWhereCourts', 'accueil'],
	['GET|POST', '/terrains/', 'Terrains#listAllCourts', 'terrains'],
	['GET|POST', '/contact/', 'Contact#sendForm', 'contact'],

	['GET|POST', '/users/add', 'Users#add', 'users_add'],
	['GET|POST', '/login', 'Users#login', 'users_login'],
	['GET', '/logout', 'Users#logout', 'users_logout'],

	['GET|POST', '/myspace/', 'Users#mySpace', 'users_myspace']
	);