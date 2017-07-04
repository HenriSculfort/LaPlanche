<?php

$w_routes = array(

	['GET|POST', '/', 'Default#listWhereCourts', 'accueil'],
	['GET|POST', '/connexion/', 'Users#login', 'connexion'],
	['GET|POST', '/terrains/', 'Terrains#listAllCourts', 'terrains'],
	['GET|POST', '/terrains/search/', 'Terrains#searchCourts', 'search_terrains'],

	['GET|POST', '/contact/', 'Contact#sendForm', 'contact'],

	['GET|POST', '/users/add', 'Users#add', 'users_add'],
	['GET|POST', '/users/insert', 'Users#insert', 'users_insert'],
	['GET|POST', '/login', 'Users#login', 'users_login'],
	['GET', '/logout', 'Users#logout', 'users_logout'],

	['GET|POST', '/forgotten/', 'Tokens#formTokens', 'users_tokensForm'],
	['GET|POST', '/forgotten/Ajax', 'Tokens#creatTokens', 'users_tokensAjax'],

	['GET|POST', '/myspace/', 'Users#mySpace', 'users_myspace'],

	['GET|POST', '/changePassword/', 'resetPass#changePass', 'users_changePassword'],
	['GET|POST', '/changePassword/Ajax', 'resetPass#resetPass', 'users_changePasswordAjax'],
	);