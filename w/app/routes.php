<?php
$w_routes = array(
    
    // Connexion / déco / mdp oublié 
    ['GET|POST', '/login', 'Users#login', 'users_login'],
    ['GET', '/logout', 'Users#logout', 'users_logout'],
    ['GET|POST', '/connexion', 'Users#login', 'connexion'],
    ['GET|POST', '/users/add', 'Users#add', 'users_add'],
    ['GET|POST', '/users/insert', 'Users#insert', 'users_insert'],
    ['GET|POST', '/changePassword/', 'resetPass#changePass', 'users_changePassword'],
    ['GET|POST', '/changePassword/Ajax', 'ResetPass#resetPass', 'users_changePasswordAjax'],
    ['GET|POST', '/forgotten', 'Tokens#formTokens', 'users_tokensForm'],
    ['GET|POST', '/forgotten/Ajax', 'Tokens#creatTokens', 'users_tokensAjax'],

    // Espace utilisateur + ajout terrains
    ['GET|POST', '/myspace', 'Users#mySpace', 'users_myspace'],
    ['GET|POST', '/myspace/Ajax', 'Courts#addCourts', 'add_courts'],
    ['GET|POST', '/myspace/UserAjax', 'Users#updateUser', 'modif_user'],

    // Map
    ['GET|POST', '/', 'Map#map', 'map'], 

    // Terrains
    ['GET|POST', '/', 'Default#home', 'accueil'],
    ['GET|POST', '/courts', 'Courts#listAllCourts', 'courts'],
    ['GET|POST', '/courts/search', 'Courts#searchCourts', 'search_courts'],
    ['GET|POST', '/courts/details/[i:id]', 'Courts#courtDetails', 'court_details'],

    // Chat
    ['GET|POST', '/courts/details/chat', 'Chat#chat', 'chat_view'],
    ['GET|POST', '/courts/details/chat/ajax/add', 'Chat#addMessageAjax', 'chat_add'],
    ['GET|POST', '/courts/details/chat/ajax/list', 'Chat#listMessagesAjax', 'chat_load'],

    // Matchs 
    ['GET|POST', '/courts/details/match', 'Games#proposeGame', 'propose_match'],
    ['GET|POST', '/courts/details/acceptGame', 'Games#acceptGame', 'accept_game'],
    ['GET|POST', '/courts/details/cancelGame', 'Games#cancelGame', 'cancel_game'],
    ['GET|POST', '/courts/details/deleteGame', 'Games#deleteGame', 'delete_game'],

    // Formulaire de contact
    ['GET|POST', '/contact/', 'Contact#showForm', 'contact'],
    ['GET|POST', '/contact/send', 'Contact#sendForm', 'contact_send'],
    
    //  Admin
    ['GET|POST', '/admin/gestioncompte/', 'AdminGestionCompte#gestionCompte', 'admin_compte'],
    ['GET|POST', '/admin/gestioncompte/Ajax', 'AdminGestionCompte#gestionCompteAjax', 'admin_compteAjax'],

    ['GET|POST', '/admin/courtsValidate/', 'Courts#validateCourts', 'admin_courtsValidate'],

    ['GET|POST', '/admin/courtsList', 'Courts#listCourtsAdmin', 'admin_getCourtsList'],
    ['GET|POST', '/admin/courtsSearch', 'Courts#searchCourtsAdmin', 'admin_searchCourts'],

    ['GET|POST', '/admin/courtsModify', 'Courts#modifyCourtAdmin', 'admin_modifyCourt'],
    ['GET|POST', '/admin/courtsDelete', 'Courts#deleteCourtAdmin', 'admin_deleteCourt'],


);