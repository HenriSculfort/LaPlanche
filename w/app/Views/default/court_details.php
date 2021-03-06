<?=$this->layout('layout', ['title' => 'Détail du terrain']); ?>

<?php $this->start('main_content');?>

<!--************************* DETAILS TERRAIN ************************-->
<div class="container background-blanc-section">
    <div class="row">
        <div class='col-lg-12'>
            <hr class="small">
            <h3 class="titre-match">Détails du <?=$findCourt['name']?></h3>
            <hr class="small hr-bottom">

            <!--********************** SOMMAIRE ************************-->
            <?php if(!empty($w_user)): ?>
            <div class="container">
                <div class='row text-center'>
                    <div class='col-sm-12'>
                        <a href='#newMatch' class='btn btn-primary btn-action'>Proposer un match</a>
                        <a href='#gamesList' class='btn btn-primary btn-action'>Matchs Prévus</a>
                        <a href='javascript:history.back();' class='btn btn-primary btn-action'>Retour à la recherche</a>
                    </div>
                </div>
            </div>
            <?php endif; ?> 
            <div class='container description-terrain'>
                <div class='row well well-blanc'>
                    <div class='col-md-12'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <img class="img-responsive" src="<?php if(isset($findCourt['picture']) && !empty($findCourt['picture'])){ echo $this->assetUrl('img/uploads/thumbnails/'.$findCourt['picture']);} else{echo $this->assetUrl('img/court-default.png');}?>" alt="photo <?=$findCourt['name'];?>">
                            </div>
                            <div class='col-md-2'>
                                <h5>Horaires</h5>
                                <p>
                                    <?=nl2br($findCourt['opening_hours']);?>
                                </p>
                            </div>
                            <div class='col-md-2'>
                                <h5>Adresse</h5>
                                <p>
                                    <?= $findCourt['address'];?><br><?= $findCourt['postal_code'];?><?= $findCourt['city'];?>
                                </p>
                            </div>
                            <div class='col-md-2' id="trajet">
                                <h5>Trajet <i class="fa fa-car" aria-hidden="true"></i></h5>
                                <div id="output"></div>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class='row'>
                            <div class='col-md-6'>

                                <h5>Les infrastructures</h5>
                                <p>
                                    <?=nl2br($findCourt['description']);?>
                                </p>
                            </div>
                            <div class='col-md-2'>
                                <h5>Etat du terrain</h5>
                                <p>
                                    <?=\Tools\Utils::getCourtState($findCourt['court_state']);?>
                                </p>
                            </div>
                            <div class='col-md-2'>
                                <h5>Filet</h5>
                                <p>
                                    <?php if($findCourt['net'] == '0') { echo 'Non'; } else { echo 'oui';  } ?>
                                </p>
                            </div>
                            <div class='col-md-2'>
                                <h5>Parking <i class="fa fa-car" aria-hidden="true"></i></h5>
                                <p>
                                    <?php if($findCourt['parking'] == '1') { echo'Oui';  } else {  echo'Non';}?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container padding-bottom">
                <div class='col-md-10 col-md-offset-1'>
                    <div class='row'>
                        <div id="map"></div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

<?php if(!empty($w_user)): ?>
<!--************************* MATCHS PREVUS ************************-->
<div class='container background-gris-section'>
    <hr class="small">
    <div class='row'>
        <h3 id='gamesList' class="titre-match">Matchs prévus</h3>
    </div>
    <hr class="small hr-bottom">
    <p class='reminder'>Rappel : notre site permet de s'organiser autour de city stades existants. Cependant, nous n'en sommes pas propriétaires et ne pouvons garantir leur disponibilité.</p>
    <div class='row'>
        <div>
            <?php


            foreach($findGamesOnCourt as $game) :

            $date = new DateTime($game['date']); 
            // Permet de comparer la date du jour à la date de la game et ne l'affiche pas si la date de la game est antérieure
            if(strtotime($now)> strtotime($game['date'])){
                // N'affiche donc pas la game


                //faire la route permettant la suppression du match dans la base


            } 
            // Si la date de la game est postérieure, on affiche.
            else 
            { 
                $date = new DateTime($game['date']);?>
            <div class=" container well">
                <div class='row'>
                    <div class='col-md-6'>
                        <h5>Match Ref°<i class='game_id' value='<?=$game['id'];?>'></i><?=$game['id']; if($game['accepted'] == 1 ) { echo '<strong> - COMPLET</strong>';}?></h5>
                        <p>Date : <?= $date->format('d-m-Y');?></p>
                        <p>De <?= $game['starting_time'];?> à <?= $game['finishing_time'];?></p>
                        <p>Nombre de joueurs :<?= $game['number_players'];?>.</p>
                        <p>Niveau :	<?=\Tools\Utils::getTeamLevel($game['team_level'])?></p>
                    </div>
                    <div class='col-md-6'>
                        <p>Nom de l'équipe : <?= $game['team_name'];?></p>
                        <p>Message : <?= $game['message'];?></p>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <!-- Bouton de suppression de la rencontre par l'utilisateur qui l'a créée !  -->
                        <?php if($game['user_id'] == ($w_user['id'])) :?>
                        <form method='POST' action='<?=$this->url('delete_game');?>' class=" padding-bottom">
                            <input type='hidden' value='<?=$game['id'];?>' name='game_id'>
                            <input type='hidden' value='<?=$findCourt['id'];?>' name='court_id'>
                            <button type='submit' class='btn btn-danger' onClick="if(confirm('Le match va être supprimé.')){return true;}else{return false;}">Supprimer la rencontre</button>
                        </form>
                        <?php endif;?>

                        <!-- Bouton d'acceptation de la rencontre par l'utilisateur qui l'a proposée ! -->
                        <?php if($game['user_id'] == ($w_user['id']) && $game['accepted'] != 1 ) :?>
                        <form method='POST' action='<?=$this->url('accept_game');?>' class=" padding-bottom">
                            <input type='hidden' value='<?=$game['id'];?>' name='game_id'>
                            <input type='hidden' value='<?=$findCourt['id'];?>' name='court_id'>
                            <button type='submit' class='btn btn-success'>Accepter la rencontre</button>
                        </form>
                        <?php endif;?>

                        <!-- Bouton d'annulation de la rencontre par l'utilisateur qui l'a acceptée ! (ATTENTION, ceci n'est pas une suppression) -->
                        <?php if($game['user_id'] == ($w_user['id']) && $game['accepted'] == 1 ) :?>
                        <form method='POST' action='<?=$this->url('cancel_game');?>' class=" padding-bottom">
                            <input type='hidden' value='<?=$game['id'];?>' name='game_id'>
                            <input type='hidden' value='<?=$findCourt['id'];?>' name='court_id'>
                            <button type='submit' class='btn btn-warning' onClick="if(confirm('Le statut complet va être annulé et d\'autres joueurs pourront se proposer')){return true;}else{return false;}">Annuler la rencontre</button>
                        </form>
                        <?php endif;?>

                        <!-- Bouton d'affichage du chat -->
                        <button type='button' data-id="<?=$game['id'];?>" class='btn btn-primary btn-showChat'>Afficher le chat</button>
                    </div>
                </div>
            </div>

            <?php 
            };
            endforeach; ?>
        </div>
    </div>
</div>

<!-- Fin du div row des matchs -->
<!--************************* PROPOSER MATCH ************************-->
<div class="container background-blanc-section">
    <hr class="small">
    <div class='row'>
        <h3 id='newMatch' class="titre-match">Proposer un match sur ce terrain</h3>
    </div>
    <hr class="small hr-bottom">
    <p class='reminder'>Rappel : notre site permet de s'organiser autour de city stades existants. Cependant, nous n'en sommes pas propriétaires et ne pouvons garantir leur disponibilité.</p>
    <div id='proposedMatch'></div>
    <form method='POST' id='proposeMatch'>
        <div class="container-fluid">
            <div class='row form-group'>
                <input type="hidden" name="id" value="<?=$court_id?>">
                <div class='col-sm-6'>
                    <div class='row form-group'>
                        <div class='col-sm-6 align-right'>
                            <label for="datepicker"> Date</label>
                        </div>
                        <div class='col-sm-6'>
                            <input class="form-control" type="text" id="datepicker" placeholder='Sélectionnez la date'>
                            <input type="hidden" id="alternate" name="date">
                        </div>
                    </div>
                    <div class='row form-group'>
                        <div class='col-sm-6 align-right'>
                            <label for='starting_time'>Heure de début</label>
                        </div>
                        <div class='col-sm-6 align-right'>
                            <input type='text' class='form-control' name='starting_time' placeholder='HH:mm'>
                        </div>
                    </div>
                    <div class='row form-group'>
                        <div class='col-sm-6 align-right'>
                            <label for='finishing_time'>Heure de fin</label>
                        </div>
                        <div class='col-sm-6 align-right'>
                            <input type='text' class='form-control' name="finishing_time" placeholder='HH:mm'>
                        </div>
                    </div>
                    <div class='row form-group'>
                        <div class='col-sm-6 align-right'>
                            <label for='level'>Niveau</label>
                        </div>
                        <div class='col-sm-6 align-right'>
                            <select name='level' class='form-control'>
                                <option value='1'>Débutant</option>
                                <option value='2'>Novice</option>
                                <option value='3'>Intermédiaire</option>
                                <option value='4'>Avancé</option>
                                <option value='5'>Expert</option>
                            </select>
                        </div>
                    </div>
                    <div class='row form-group'>
                        <div class='col-sm-6 align-right'>
                            <label for='number_players'>Nombre de joueurs</label>
                        </div>
                        <div class='col-sm-6 align-right'>
                            <input type='text' class='form-control' name='number_players' placeholder="Ex : 3">
                        </div>
                    </div>
                    <div class='row form-group'>
                        <div class='col-sm-6 align-right'>
                            <label for='team_name'>Nom de votre équipe</label>
                        </div>
                        <div class='col-sm-6'>
                            <input type='text' class='form-control' name='team_name' placeholder="Nom de l'équipe (facultatif)">
                        </div>
                    </div>
                </div> 
                <!-- Colonne droite -->
                <div class='col-sm-6'>
                    <div class='row form-group'>
                        <div class='col-sm-2 align-right'>
                            <label for='message'>Message</label>
                        </div>
                        <div class='col-sm-6'>
                            <textarea rows="9" class='form-control' name='message' placeholder="Ecrivez votre message ici (et restez courtois :D )"></textarea>
                        </div>
                    </div>
                </div>
            </div><!-- Fin du row contenant tous les champs -->
            <div class='row'>
                <div class='col-sm-6 col-sm-offset-3'>
                    <button type='submit' id='submitProposeMatch' class='btn btn-primary margin-bottom-btn'>Proposer ce match</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- ********************** CHAT ***********************-->
<div>
    <div id='chat'>
        <div id='chatTitle'></div>
        <h5>Messages</h5>
        <div id='showMessages'></div> <!-- Fin de la div contenant les messages du chat ajax -->
        <div id='errors'></div>

        <form method='POST' id='sendMessages'>
            <br>
            <div class='row'>
                <div class='col-md-12'>
                    <h5>Nouveau message</h5>
                    <input type="hidden" id="idChatRoom" name="idChat" value="">
                    <textarea id='message' class='form-control' name='message' placeholder='Taper votre message ici'></textarea>
                    <br>
                    <button type='button' id='addMessage' class='btn btn-primary'>Envoyer</button>
                </div>
            </div>
        </form>
    </div>
</div>	<!-- Fin du div container matchs prévus -->
<?php endif; ?> 
<?=$this->stop('main_content');?>

<?=$this->start('script');?>

<!-- script du datepicker -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

    $(function() {
        $( "#datepicker" ).datepicker({
            firstDay: 1 ,
            closeText: 'Fermer',
            prevText: 'Précédent',
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
            dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
            dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
            weekHeader: 'Sem.',
            dateFormat: 'dd-mm-yy',
            altField: "#alternate",
            altFormat: "yy-mm-dd"
        });
    });

</script>

<script>

    // FONCTION POUR AJOUTER OU SUPPRIMER LA CLASSE GERANT L'AFFICHAGE DU CHAT OU NON
    function showChat() {
        if (($('#chat').css('display')) == 'none') {
            $('#chat').removeClass('hidden').addClass('show');
        } else {
            $('#chat').addClass('hidden');
        }
    }

    // FONCTION POUR RELOAD LE CHAT UNE FOIS UN MESSAGE POSTE
    function getMessages(chatId) {

        $.getJSON('<?=$this->url('chat_load');?>', {idChat: chatId},function(resultHtml) {
            $('#showMessages').html(resultHtml.html);
            $('#chatTitle').html('<strong>Chat du match </strong>' + resultHtml.gameId);
        });
    }

    // On lance le jQuery
    $(document).ready(function() {

        $(function() {

            // AFFICHAGE DU CHAT DE BASE AU CLIC DU BOUTON POUR AFFICHER LE CHAT DU MATCH

            // Au clic du bouton d'affichage du chat
            $('.btn-showChat').on('click', function(e) {

                // Pour cacher le chat lorsque l'on clique en dehors.
                $(document).mouseup(function(e) {
                    var chat = $('#chat');

                    // if the target of the click isn't the container nor a descendant of the container
                    if (!chat.is(e.target) && chat.has(e.target).length === 0) {
                        chat.removeClass('show').addClass('hidden');
                    }
                });

                // Pour que l'affichage fonctionne toujours une fois que l'on a cliqué en dehors.
                showChat();

                e.preventDefault();

                var chatId = $(this).data('id'); // Récupere l'id de l'attribut data-id (correspond à l'id de la game)

                // Retour du JSON contenant les données du chat et affichage 
                $.getJSON('<?=$this->url('chat_load');?>', {idChat: chatId}, function(resultHtml) {
                    $('#chat').addClass('show');
                    $('div#showMessages').html(resultHtml.html);
                    $('div#chatTitle').html('<h4>Chat du match' + resultHtml.gameId + '</h4>');
                    $('#idChatRoom').val(resultHtml.gameId);
                });

            }); // Fin du clic sur le bouton d'affichage du chat

            // ENVOI MESSAGE 

            // On surveille le clic d'envoi de nouveau message
            $('#addMessage').on('click', function(envoi) {
                envoi.preventDefault();

                var $message = $('textarea#message').val();
                var $game_id = $('#idChatRoom').val();


                $.ajax({
                    url: '<?= $this->url('chat_add');?>',
                    type: 'GET',
                    data: {
                        message: $message,
                        idChat: $game_id,
                    },
                    dataType: 'json',
                    success: function(retourJson) {

                        // Si le message a bien été posté 
                        if (retourJson.result == true) {
                            getMessages(retourJson.idChat);
                            // Sert à vider le champ pour ne pas avoir à effacer le message précédent avant d'en taper un nouveau
                            $('textarea#message').val('');
                            // Pour réinitialiser les erreurs si jamais on envoie un message correct 
                            $('#errors').removeClass('alert alert-danger');
                            $('#errors').text('');
                        }
                        // En cas d'erreur 
                        else if (retourJson.result == false) {
                            $('#errors').fadeIn().delay(1000).html(retourJson.errors).addClass('alert alert-danger').fadeOut().delay(3000);
                            $('textarea#message').val('');
                        }

                    } // Fermeture du success

                }); // Fermeture du AJAX

            }); // Fermeture de l'event on clic envoi
        });
    }); // Fin de l'appel jQuery

</script>

<script>

    $(document).ready(function(){

        $('#submitProposeMatch').on('click', function(e) {
            // Empeche l'action par défaut, dans notre cas la soumission du formulaire
            e.preventDefault();

            $.ajax({
                url: '<?=$this->url('propose_match');?>',
                type: 'post',
                data: $('#proposeMatch').serialize(),
                dataType: 'json', // Les données de retour seront envoyées en JSON
                success: function(retourJson) {
                    if (retourJson.result == true) {
                        $('#proposedMatch').html('<div class="col-lg-4 col-lg-offset-4 alert alert-success text-center">' + retourJson.message + '</div>');
                        location.reload();
                    } else if (retourJson.result == false) {
                        $('#proposedMatch').html('<div class="col-lg-4 col-lg-offset-4 alert alert-danger text-center">' + retourJson.errors + '</div>');
                    }

                },

            });
        });
    });

</script>

<script>
    // Permet de calculer la distance entre un point A et un point B en l'occurence (A = Votre emplacement et B= l'emplacement du terrain)
    //Retourne une carte avec les 2 points
    // Retourne la distance en km et la durée du trajet(trajet en voiture)
    function initMap() {
        var bounds = new google.maps.LatLngBounds;
        var markersArray = [];

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {

                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                var origin1 = {lat: lat, lng: lng};
                var origin2 = {lat : <?= $findCourt['latitude'];?> , lng: <?= $findCourt['longitude'];?>};

                var destinationIcon = 'https://chart.googleapis.com/chart?' +
                    'chst=d_map_pin_letter&chld=B|ea931e|000000';
                var originIcon = 'https://chart.googleapis.com/chart?' +
                    'chst=d_map_pin_letter&chld=A|ea931e|000000';
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 55.53, lng: 9.4},
                    zoom: 10
                });
                var geocoder = new google.maps.Geocoder;

                var service = new google.maps.DistanceMatrixService;
                service.getDistanceMatrix({
                    origins: [origin1],
                    destinations: [origin2],
                    travelMode: 'DRIVING',
                    unitSystem: google.maps.UnitSystem.METRIC,
                    avoidHighways: false,
                    avoidTolls: false
                }, function(response, status) {
                    if (status !== 'OK') {
                        alert('Error was: ' + status);
                    } else {
                        var originList = response.originAddresses;
                        var destinationList = response.destinationAddresses;
                        var outputDiv = document.getElementById('output');
                        outputDiv.innerHTML = '';
                        deleteMarkers(markersArray);

                        var showGeocodedAddressOnMap = function(asDestination) {
                            var icon = asDestination ? destinationIcon : originIcon;
                            return function(results, status) {
                                if (status === 'OK') {
                                    map.fitBounds(bounds.extend(results[0].geometry.location));
                                    markersArray.push(new google.maps.Marker({
                                        map: map,
                                        position: results[0].geometry.location,
                                        icon: icon
                                    }));
                                } else {
                                    alert('Geocode was not successful due to: ' + status);
                                }
                            };
                        };

                        for (var i = 0; i < originList.length; i++) {
                            var results = response.rows[i].elements;
                            geocoder.geocode({'address': originList[i]},
                                             showGeocodedAddressOnMap(false));
                            for (var j = 0; j < results.length; j++) {
                                geocoder.geocode({'address': destinationList[j]},
                                                 showGeocodedAddressOnMap(true));
                                outputDiv.innerHTML += 'Distance : '+results[j].distance.text + '<br> Durée : ' +
                                    results[j].duration.text + '<br>';
                            }
                        }
                    }
                });
            }, 
                                                    
            function(err) 
            {
              $('#map').removeClass('show').addClass('hidden'); // Si la géolcation n'est pas activé la map ainsi que la div trajet n'est pas affiché
              $('#trajet').removeClass('show').addClass('hidden');
              console.warn('ERROR(' + err.code + '): ' + err.message);
            },
      )};
    }

    function deleteMarkers(markersArray) {
        for (var i = 0; i < markersArray.length; i++) {
            markersArray[i].setMap(null);
        }
        markersArray = [];
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0xJoi5c9MwYIYQlwIEfLqLh95hLtcaYA&callback=initMap"></script>
<?=$this->stop('script');?>