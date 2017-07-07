<?=$this->layout('layout', ['title' => 'Liste des terrains']); ?>

<?php $this->start('header_content');?>

<div class="standard-header">
	<h1>Les terrains</h1>
	<p class="legend-header">Vous cherchez un terrain en particulier ou toute la liste ? C'est ici ! </p>
</div>

<?php $this->stop('header_content');?>

<?=$this->start('main_content');?>


<!-- FORMULAIRE DE RECHERCHE -->
<form class="form-inline text-center moteur-recherche" action="<?= $this->url('search_courts')?>">

	<div class="form-group">
		<label for='searchWhere'>Lieu *</label>
		<input class="form-control" type='text' name='searchWhere' placeholder="Ville / CP">
	</div>
	
	<!--<div class="form-group">
		<label for='date'>Date </label>
		<select id="day" class="form-control" name="day">
			<option value="" selected disabled>Jour</option>
			<?php for($d=1;$d<=31;$d++):?>
				<option value="<?=($d < 10) ? '0'.$d : $d;?>"><?=($d < 10) ? '0'.$d : $d;?></option>
			<?php endfor; ?>
		</select>

		<select id="month" class="form-control" name="month">
			<option value="" selected disabled>Mois</option>
			<?php for($m=1;$m<=12;$m++):?>
				<option value="<?=($m < 10) ? '0'.$m : $m;?>"><?=($m < 10) ? '0'.$m : $m;?></option>
			<?php endfor; ?>
		</select>

		<select id="year" class="form-control" name="year">
			<option value="" selected disabled>Année</option>
			<?php for($y=date('Y'); $y <= 2100 ;$y++):?>
				<option value="<?=$y;?>"><?=$y;?></option>
			<?php endfor; ?>
		</select>
	</div>-->
	
	<div class="form-group">
		<label for="datepicker"> Date </label>
		<input class="form-control" type="text" id="datepicker" >
		<input type="hidden" id="alternate" name="date">
	</div>

	<div class="form-group">
		<label for='has_match'> Match </label>
		<select name='has_match' class="form-control">
			<option value='both' selected>Indifférent</option>
			<option value='has_match'>Avec Match</option>
			<option value='has_no_match'>Sans Match</option>
		</select>
	</div>

	<div class="form-group">
		<label for='distanceSlider'> Distance </label>
		<input id="distance" data-slider-id='distanceSlider' type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="50"/>
	</div>
	<button type='submit' id='searchBtn' class='btn btn-warning'>Rechercher </button>
	<div>
		<small>* champ requis</small>
	</div>
</form>

<!-- LISTE DES TERRAINS OU RETOUR DE RECHERCHE -->

<?php 

// S'il y a des erreurs il me les affiche 
if (isset($showErrors) && !empty($showErrors)) { ?>
<div class='alert alert-danger'><?= $showErrors;?></div><?php
}
// Si une recherche a été effectuée 
elseif(isset($searchResults) && $searchResults == true) {

	if(isset($getGames)) { 
		$courtResult = $getGames;
	} 
	elseif (isset($getNoGames)) { 
		$courtResult = $getNoGames;
	}
	elseif (isset($search)) { 
		$courtResult = $search;
	}
}
elseif (isset($searchResults) && $searchResults == false) { ?>
<div class='alert alert-warning'>Votre recherche n'a retourné aucun résultat. Si vous avez des terrains à suggérer, n'hésitez pas à le faire via votre espace personnel ! </div> <?php
}
elseif (isset($findAll)) { 
	$courtResult = $findAll;
}

// Le isset est nécessaire pour le cas où searchResults est false.
if(isset($courtResult)) {
	// Affichage des résultats (en cas de recherche)
	foreach($courtResult as $court) {
		if( $court['admin_validation'] == 1) { ?>
			<div class='container'>
				<div class='row'>
					<div class='col-md-2'>
						<img class="img-responsive" src="<?=$this->assetUrl('img/uploads/'.$court['picture']);?>" alt='Le terrain'>
					</div>
					<div class='col-md-10 well'>
						<h4><?= $court['name'];?></h4>
						<p class="description-terrain"><?= nl2br($court['description']);?></p>
						<!-- <p><?php if($court['parking'] == '1') { echo'<i class="fa fa-car" aria-hidden="true">';  }?></p>-->
						<a class="lien-info-terrain" href='<?=$this->url('court_details', ['id' => isset($getGames) ? $court['court_id'] : $court['id']])?>'>Plus d'informations et liste des matchs</a>
					</div>
				</div>
			</div>	
			<?php } 
	}// Fin foreach
} // Fin du isset courtResult ?>

<?=$this->stop('main_content');?>

<!-- AJAX D'AFFICHAGE DE LA RECHERCHE -->
<?= $this->start('script') ?>

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

<?= $this->stop('script') ?>




