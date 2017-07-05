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
		<a href='#newMatch' class='btn btn-primary'>Proposer un match</a>
		<a href='#courtDetails' class='btn btn-primary'>Détails du terrain</a>
		<a href='#gamesList' class='btn btn-primary'>Matchs Prévus</a>
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
						<textarea  rows="8" name='message' placeholder="nom de l'équipe (facultatif)"></textarea>
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
</div>


<!--************************* DETAILS TERRAIN ************************-->

<div class='container'>

	<div class='row'>
		<h3 id='courtDetails'>Détails du terrain</h3>
	</div>
	<div class='row'>
		<div class='col-md-6'>
			<h5>Les infrastructures</h5>
			<p><?=nl2br($findCourt['description']);?></p>
		</div>
		<div class='col-md-6'>
			<h5>Horaires</h5>
			<p><?=nl2br($findCourt['opening_hours']);?></p>


		</div>
	</div>
</div>

<div class='container'>

	<div class='row'>
		<h3 id='gamesList'>Matchs prévus</h3>
	</div>
	<div class='row'>
		<div></div>
	</div>
</div>

<?=$this->stop('main_content');?>
