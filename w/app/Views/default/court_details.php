<?=$this->layout('layout', ['title' => 'Détail du terrain']); ?>

<?php $this->start('header_content');?>
<div class="standard-header">
	<h1>Détails du terrain</h1>
</div>
<div class='container'>
	<div class='row'>
		<img class="img-responsive" src="<?=$this->assetUrl('img/uploads/'.$findCourt['picture']);?>" alt="photo <?=$findCourt['name'];?>">
	</div>
	

	<!--********************** SOMMAIRE ************************-->
	<div class='row' >
		<div class='col-sm-12'>
			<a href='#newMatch' class='btn btn-primary'>Proposer un match</a>
			<a href='#courtDetails' class='btn btn-primary'>Détails du terrain</a>
			<a href='#gamesList' class='btn btn-primary'>Matchs Prévus</a>
			<a href='javascript:history.back();' class='btn btn-primary'>Retour à la recherche</a>
		</div>
	</div>
	<?php $this->stop('header_content');?>



	<?php $this->start('main_content');?>
	<!--************************* PROPOSER MATCH ************************-->
	<div class='row'>
		<h3 id='newMatch'>Proposer un match sur ce terrain</h3>
	</div>
	<div id='proposedMatch'></div>
	<form method='POST' id='proposeMatch'>
		<div class='row form-group'>
			<input type="hidden" name="id" value="<?=$court_id?>">
			<div class='col-sm-6'>
				<div class='row form-group'>
					<div class='col-sm-6'>
						<label for="datepicker"> Date </label>
					</div>
					<div class='col-sm-6'>
						<input class="form-control" type="text" id="datepicker" >
						<input type="hidden" id="alternate" name="date">
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-6'>
						<label for='starting_time'>Heure de début</label>
					</div>
					<div class='col-sm-6'>
						<input type='text' class='form-control' name='starting_time' placeholder='HH:mm'>
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-6'>
						<label for='finishing_time'>Heure de fin</label>
					</div>
					<div class='col-sm-6'>
						<input type='text' class='form-control' name="finishing_time" placeholder='HH:mm'>
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-6'>
						<label for='level'>Niveau</label>
					</div>
					<div class='col-sm-6'>
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
					<div class='col-sm-6'>
						<label for='number_players'>Nombre de joueurs</label>
					</div>
					<div class='col-sm-6'>
						<input type='text' class='form-control' name='number_players' placeholder="ex: 3">
					</div>
				</div>
				<div class='row form-group'>
					<div class='col-sm-6'>
						<label for='team_name'>Nom de votre équipe</label>
					</div>
					<div class='col-sm-6'>
						<input type='text' class='form-control' name='team_name' placeholder="nom de l'équipe (facultatif)">
					</div>
				</div>
			</div>
			<!-- Colonne droite -->
			<div class='col-sm-6'>
				<div class='row form-group'>
					<div class='col-sm-2'>
						<label for='message'>Message</label>
					</div>
					<div class='col-sm-10'>
						<textarea  rows="9" class='form-control' name='message' placeholder="Ecrivez votre message ici (et restez courtois :D )"></textarea>
					</div>
				</div>
			</div>
		</div> <!-- Fin du row contenant tous les champs -->
		<div class='row'>
			<div class='col-sm-12'>
				<button type='submit' id='submitProposeMatch' class='btn btn-primary'>Proposer ce match</button>
			</div>
		</div>
	</form>
</div> <!-- Fermeture du div class container global -->


<!--************************* DETAILS TERRAIN ************************-->

<div class='container'>

	<div class='row'>
		<h3 id='courtDetails'>Détails du terrain</h3>
	</div>
	<div class='row'>
		<div class='col-md-6'>
			<div class='row'>
				<h5>Les infrastructures</h5>
				<p><?=nl2br($findCourt['description']);?></p>
			</div>
			<div class='row'>
				<h5>Horaires</h5>
				<p><?=nl2br($findCourt['opening_hours']);?></p>
			</div>
		</div>
		<div class='col-md-6'>
			
			<div class='row'>
				<h5>Adresse</h5>
				<p><?= $findCourt['address'];?><br><?= $findCourt['postal_code'];?> <?= $findCourt['city'];?></p>
			</div>
			<div class='row'>
				<h5>Parking <i class="fa fa-car" aria-hidden="true"></i></h5>
				<p><?php if($findCourt['parking'] == '1') { echo'Oui';  } else {  echo'Non';}?>
				</div>
				<div class='row'>
					<h5>Etat du terrain</h5>
					<p><?php switch($findCourt['court_state']) {
						case 0:
						echo 'Non renseigné';
						break;
						case 1:
						echo 'Très mauvais état';
						break;
						case 2:
						echo 'Mauvais état';
						break;
						case 3:
						echo 'Etat Normal';
						break;
						case 4:
						echo 'Bon état';
						break;
						case 5:
						echo 'Très bon état';
						break;
					}?>
				</p>	
			</div>
			<div class='row'>
				<h5>Filet</h5>
				<p><?php if($findCourt['net'] == '0') { echo 'Non'; } else { echo 'oui';  } ?></p>
			</div>
		</div>
	</div>
</div>

<!--************************* MATCHS PREVUS ************************-->

<div class='container'>

	<div class='row'>
		<h3 id='gamesList'>Matchs prévus</h3>
	</div>
	<div class='row'>
		<div>
			<?php 

			
			foreach($findGamesOnCourt as $game) : 
				// Permet de comparer la date du jour à la date de la game et ne l'affiche pas si la date de la game est antérieure
				if(strtotime($now)> strtotime($game['date'])) {

				} 
			// Si la date de la game est postérieure, on affiche.
				else { ?>
				<div class='row'>
					<div class='col-md-6'>
						<h5>Match Ref°<i class='game_id' value='<?=$game['id'];?>'></i><?=$game['id']; if($game['accepted'] == 1 ) { echo '<strong> - COMPLET</strong>';}?></h5>
						<?php $frenchDate = new DateTime($game['date']);?>
						<p>Date : <?=$frenchDate->format('d-m-Y');?></p>			
						<p>De <?= $game['starting_time'];?> à <?= $game['finishing_time'];?></p>
						<p>Nombre de joueurs : <?= $game['number_players'];?>.</p> 
						<p>Niveau : <?=\Tools\Utils::getTeamLevel($game['team_level'])?>
						</p>
					</div>
					<div class='col-md-6'>
						<p>Nom de l'équipe : <?= $game['team_name'];?></p>
						<p>Message : <?= $game['message'];?></p>
						
						<!-- Bouton de suppression de la rencontre par l'utilisateur qui l'a créée !  -->
						<?php
						if($game['user_id'] == ($w_user['id'])) :?>
							<form method='POST' action='<?=$this->url('delete_game');?>'>
								<input type='hidden' value='<?=$game['id'];?>' name='game_id'>
								<input type='hidden' value='<?=$findCourt['id'];?>' name='court_id'>
								<button type='submit' class='btn btn-danger'>Supprimer la rencontre</button>
							</form>
						<?php endif;?>							

						<!-- Bouton d'acceptation de la rencontre par l'utilisateur qui l'a proposée ! -->
						<?php
						if($game['user_id'] == ($w_user['id']) && $game['accepted'] != 1 ) :?>
							<form method='POST' action='<?=$this->url('accept_game');?>'>
								<input type='hidden' value='<?=$game['id'];?>' name='game_id'>
								<input type='hidden' value='<?=$findCourt['id'];?>' name='court_id'>
								<button type='submit' class='btn btn-success'>Accepter la rencontre</button>
							</form>
						<?php endif;?>					
					
						<!-- Bouton d'annulation de la rencontre par l'utilisateur qui l'a acceptée ! (ATTENTION, ceci n'est pas une suppression) -->
						<?php
						if($game['user_id'] == ($w_user['id']) && $game['accepted'] == 1 ) :?>
							<form method='POST' action='<?=$this->url('cancel_game');?>'>
								<input type='hidden' value='<?=$game['id'];?>' name='game_id'>
								<input type='hidden' value='<?=$findCourt['id'];?>' name='court_id'>
								<button type='submit' class='btn btn-warning'>Annuler la rencontre</button>
							</form>
						<?php endif;?>	
						


					</div>
			</div>
			<div class='row'>
				<div class='col-md-6'>
					<button type='button' data-id="<?=$game['id'];?>"  class='btn btn-primary btn-showChat'>Afficher le chat</button> 
				</div>
			</div>
			<hr>
			<?php } ;
			endforeach; ?>
		</div>
	</div> <!-- Fin du div row des matchs -->


	<!-- ********************** CHAT ***********************-->
	<div id='chat'>
		<div id='chatTitle'></div>
		<div id='showMeChat'>	
			<div id=resultAjax></div>
			<h5>Messages</h5>
			<div id='showMessages'></div>
			<div id='errors'></div>
		</div> <!-- Fin de la div contenant les messages du chat ajax -->
		<form method='POST'>
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
</div> <!-- Fin du div container matchs prévus -->


<?=$this->stop('main_content');?>

<?=$this->start('script');?>
<!-- script du datepicker -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$(function(){
		$("#datepicker").datepicker({
			dateFormat: 'dd-mm-yy',
			altField: "#alternate",
			altFormat: "yy-mm-dd"});
	});
</script>

<script>


	// FONCTION POUR AJOUTER OU SUPPRIMER LA CLASSE GERANT L'AFFICHAGE DU CHAT OU NON

	function showChat() {
		
		if( ($('#chat').css('display')) == 'none') { 
			$('#chat').removeClass('hidden').addClass('show');	}
			else { 
				$('#chat').addClass('hidden');
			}
		}

	// FONCTION POUR RELOAD LE CHAT UNE FOIS UN MESSAGE POSTE
	function getMessages(chatId)
	{

		$.getJSON('<?=$this->url('chat_load');?>', {idChat: chatId}, function(resultHtml){	
			$('#showMeChat').addClass('inView').html(resultHtml.html);		
			$('#chatTitle').html('<strong>Chat du match </strong>'+ resultHtml.gameId);
		}); 
	}



	// On lance le jQuery
	$(document).ready(function() { 

		$(function(){

			// AFFICHAGE DU CHAT DE BASE AU CLIC DU BOUTON POUR AFFICHER LE CHAT DU MATCH

			// Au clic du bouton d'affichage du chat
			$('.btn-showChat').on('click', function(e){
				
				// Pour cacher le chat lorsque l'on clique en dehors.
				$(document).mouseup(function(e) 
				{
					var chat = $('#chat');

				    // if the target of the click isn't the container nor a descendant of the container
				    if (!chat.is(e.target) && chat.has(e.target).length === 0) 
				    {
				    	chat.removeClass('show').addClass('hidden');   
				    }
				});

				// Pour que l'affichage fonctionne toujours une fois que l'on a cliqué en dehors.
				showChat();
				
				e.preventDefault();
				
				var chatId = $(this).data('id'); // Récupere l'id de l'attribut data-id (correspond à l'id de la game)

				// Retour du JSON contenant les données du chat et affichage 
				$.getJSON('<?=$this->url('chat_load');?>', {idChat: chatId}, function(resultHtml){	
					$('#chat').addClass('show');
					$('div#showMeChat').html(resultHtml.html);
					$('div#chatTitle').html('<h4>Chat du match' + resultHtml.gameId + '</h4>');
					$('#idChatRoom').val(resultHtml.gameId);
				});

			}); // Fin du clic sur le bouton d'affichage du chat


			// ENVOI MESSAGE 

			// On surveille le clic d'envoi de nouveau message
			$('#addMessage').on('click', function(envoi){ 
				envoi.preventDefault();

				var $message = $('textarea#message').val();  
				var $game_id = $('#idChatRoom').val(); 
				console.log($game_id);

				$.ajax({ 
					url:'<?= $this->url('chat_add');?>',
					type: 'GET',
					data : {
						message : $message,
						idChat : $game_id,
					},
					dataType : 'json',
					success : function(retourJson) { 

								// Si le message a bien été posté 
								if(retourJson.result == true){
									getMessages(retourJson.idChat);
									// Sert à vider le champ pour ne pas avoir à effacer le message précédent avant d'en taper un nouveau
									$('textarea#message').val(''); 
									// Pour réinitialiser les erreurs si jamais on envoie un message correct 
									$('#errors').removeClass('alert alert-danger');
									$('#errors').text('');
								}
								// En cas d'erreur 
								else if(retourJson.result == false){
									$('#errors').html(retourJson.errors).addClass('alert alert-danger');
								}

							} // Fermeture du success
							
						}); // Fermeture du AJAX

					}); // Fermeture de l'event on clic envoi
		});
	}); // Fin de l'appel jQuery
</script>
<script>
	
	$(document).ready(function(){

		$('#submitProposeMatch').on('click', function(e){
	// Empeche l'action par défaut, dans notre cas la soumission du formulaire

	e.preventDefault(); 

	
	$.ajax({
		url: '<?=$this->url('propose_match');?>', 
		type: 'post',
		data: $('#proposeMatch').serialize(),		
				dataType: 'json', // Les données de retour seront envoyées en JSON
				success: function(retourJson){
					if(retourJson.result == true){ 
						$('#proposedMatch').html('<div class="alert alert-success">' + retourJson.message + '</div>');
						location.reload();
					}
					else if(retourJson.result == false){
						$('#proposedMatch').html('<div class="alert alert-danger">' + retourJson.errors + '</div>');
					}

				},

			});
});
	});
</script>

<?=$this->stop('script');?>
