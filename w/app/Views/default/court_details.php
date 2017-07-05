<?=$this->layout('layout', ['title' => 'Détail du terrain']); ?>

<?php $this->start('header_content');?>
<div class="standard-header">
	<h1>Détails du terrain</h1>
</div>
<div class='container'>
	<div class='row'>
		<img src="<?=$this->assetUrl('img/'.$findCourt['picture']);?>" alt="photo <?=$findCourt['name'];?>">
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
	<form method='POST'>
		<div class='row'>
			<div class='col-sm-6'>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='date'>Date</label>
					</div>
					<div class='col-sm-8'>
						<select id="day" name="day">
							<option value="" selected disabled>Jour</option>
							<?php for($d=1;$d<=31;$d++):?>
								<option value="<?=($d < 10) ? '0'.$d : $d;?>"><?=($d < 10) ? '0'.$d : $d;?></option>
							<?php endfor; ?>
						</select>

						<select id="month" name="month">
							<option value="" selected disabled>Mois</option>
							<?php for($m=1;$m<=12;$m++):?>
								<option value="<?=($m < 10) ? '0'.$m : $m;?>"><?=($m < 10) ? '0'.$m : $m;?></option>
							<?php endfor; ?>
						</select>

						<select id="year" name="year">
							<option value="" selected disabled>Année</option>
							<?php for($y=date('Y'); $y <= 2100 ;$y++):?>
								<option value="<?=$y;?>"><?=$y;?></option>
							<?php endfor; ?>
						</select>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='starting_time'>Heure de début</label>
					</div>
					<div class='col-sm-8'>
						<input type='text' placeholder='HH:mm'>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='starting_time'>Heure de fin</label>
					</div>
					<div class='col-sm-8'>
						<input type='text' placeholder='HH:mm'>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='level'>Niveau</label>
					</div>
					<div class='col-sm-8'>
						<select name='level'>
							<option value='1'>Débutant</option>
							<option value='2'>Novice</option>
							<option value='3'>Intermédiaire</option>
							<option value='4'>Avancé</option>
							<option value='5'>Expert</option>
						</select>
					</div>
				</div>

				<div class='row'>
					<div class='col-sm-4'>
						<label for='number_players'>Nombre de joueurs</label>
					</div>
					<div class='col-sm-8'>
						<input type='text' name='number_players' placeholder="ex: 3">
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-4'>
						<label for='team_name'>Nom de votre équipe</label>
					</div>
					<div class='col-sm-8'>
						<input type='text' name='team_name' placeholder="nom de l'équipe (facultatif)">
					</div>
				</div>
			</div>
			<!-- Colonne droite -->
			<div class='col-sm-6'>
				<div class='row'>
					<div class='col-sm-2'>
						<label for='message'>Message</label>
					</div>
					<div class='col-sm-10'>
						<textarea  rows="8" name='message' placeholder="Ecrivez votre message ici (et restez courtois :D )"></textarea>
					</div>
				</div>
			</div>
		</div> <!-- Fin du row contenant tous les champs -->
		<div class='row'>
			<div class='col-sm-12'>
				<button type='submit' class='btn btn-primary'>Proposer ce match</button>
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
				<p><?php switch($findCourt['court-state']) {
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
			<?php foreach($findGamesOnCourt as $game) : 
			// Permet de comparer la date du jour à la date de la game et ne l'affiche pas si la date de la game est antérieure
			if(strtotime($now)> strtotime($game['date'])) {

				}
				// Si la date de la game est postérieure, on affiche.
				else { ?>
					<div class='row'>
						<div class='col-md-6'>
							<h5>Match Ref°<?=$game['id']; if($game['accepted'] == 1 ) { echo '<strong> - COMPLET</strong>';}?></h5>
							<?php $frenchDate = new DateTime($game['date']);?>
							<p>Date : <?=$frenchDate->format('d-m-Y');?></p>			
							<p>De <?= $game['starting_time'];?> à <?= $game['finishing_time'];?></p>
							<p>Nombre de joueurs : <?= $game['number_players'];?>.</p> 
							<p>Niveau : <?php 
								switch($game['team_level']) {
								case 0:
								echo 'Non renseigné';
								break;
								case 1:
								echo 'Débutant';
								break;
								case 2:
								echo 'Novice';
								break;
								case 3:
								echo 'Intermédiare';
								break;
								case 4:
								echo 'Avancé';
								break;
								case 5:
								echo 'Expert';
								break;
							}?>
							</p>
						</div>
						<div class='col-md-6'>
							<p>Nom de l'équipe : <?= $game['team_name'];?></p>
							<p>Message : <?= $game['message'];?></p>

						</div>
					</div>
					<div class='row'>
						<button type='submit' href='' class='btn btn-primary'>Afficher le chat</button> 
						<?php // Si la game n'est pas acceptée (complète), l'input pour écrire un nouveau message apparaît.
						if($game['accepted'] != 1) : ?>		
							<p><div id=resultAjax></div>
								<h5>Messages</h5>

									<div id="errors" style="color:red; background: lightpink; border-radius: 5px;text-align: center"></div>
									<div id='showMessages'></div>
								<!-- Formulaire d'envoi -->
								<form method='POST'>
									<br>
									<h5>Nouveau message</h5>
									<textarea id='message' name='message' placeholder='Taper votre message ici'></textarea>
									<br>
									<button type='submit' id='addMessage'>Envoyer</button>
								</form>
								</p>		
						<?php endif;?>
					</div>
					<hr>
				<?php } ;
			endforeach; ?>

		</div>
	</div>
</div>


<?=$this->stop('main_content');?>

<?=$this->start('script');?>

<script>

// On sort cette fonction pour la préparer sans l'appeler, elle servira à récupérer les données
function getMessages()
{

	$.getJSON('<?=$this->url('chat_load');?>', function(htmlMessages) { 
		$('#showMessages').html(htmlMessages);
	});
}

// On lance le jQuery
$(document).ready(function() { 

	// On appelle la fonction d'affichage
	getMessages();

	// On surveille le clic d'envoi de nouveau message
	$('#addMessage').on('click', function(e){ 
		e.preventDefault();

		var $message = $('textarea#message').val(); // Val récupère la valeur du champ. Si j'écris qqc entre les parenthèses ça m'écrira le truc dans la balise. 

		$.ajax({ 
			url:'<?= $this->url('chat_add');?>',
			type: 'POST',
			data : {
				message : $message,
			},
			dataType : 'json',
			success : function(retourJson) { 
				
				if(retourJson.result == true){
					getMessages();
					// Sert à vider le champ pour ne pas avoir à effacer le message précédent avant d'en taper un nouveau
					$('textarea#message').val(''); 
					// Pour réinitialiser les erreurs si jamais on envoie un message correct 
					$('#errors').text('');
				}
				else if(retourJson.result == false){
					$('#errors').html(retourJson.errors);
				}
			} // Fermeture du success

		}); // Fermeture du AJAX
	
	}); // Fermeture de l'event


}); // Fermeture jquery
</script>

<?=$this->stop('script');?>

