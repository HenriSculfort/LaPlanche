<?php
$w_routes = array(
	['GET|POST', '/', 'Default#listWhereCourts', 'accueil'],
	['GET|POST', '/connexion', 'Users#login', 'connexion'],
	['GET|POST', '/courts', 'Courts#listAllCourts', 'courts'],
	['GET|POST', '/courts/search', 'Courts#searchCourts', 'search_courts'],

	['GET|POST', '/contact', 'Contact#sendForm', 'contact'],

	['GET|POST', '/users/add', 'Users#add', 'users_add'],
	['GET|POST', '/users/insert', 'Users#insert', 'users_insert'],
    
	['GET|POST', '/login', 'Users#login', 'users_login'],
	['GET', '/logout', 'Users#logout', 'users_logout'],
	
    ['GET|POST', '/forgotten', 'Tokens#formTokens', 'users_tokensForm'],
	['GET|POST', '/forgotten/Ajax', 'Tokens#creatTokens', 'users_tokensAjax'],
	['GET|POST', '/myspace', 'Users#mySpace', 'users_myspace'],
	['GET|POST', '/myspace/Ajax', 'Courts#addCourts', 'add_courts'],
	['GET|POST', '/myspace/UserAjax', 'Users#updateUser', 'modif_user'],



	['GET|POST', '/courts/details/[i:id]', 'Courts#courtDetails', 'court_details'],

	['GET|POST', '/changePassword/', 'resetPass#changePass', 'users_changePassword'],
	['GET|POST', '/changePassword/Ajax', 'ResetPass#resetPass', 'users_changePasswordAjax'],

	);