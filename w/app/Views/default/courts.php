<?=$this->layout('layout', ['title' => 'Liste des terrains']); ?>

<?php $this->start('header_content');?>

<div class="standard-header">
	<h1>Les terrains</h1>
	<p class="legend-header">Vous cherchez un terrain en particulier ou toute la liste ? C'est ici ! </p>
</div>

<?php $this->stop('header_content');?>

<?=$this->start('main_content');?>


<!-- FORMULAIRE DE RECHERCHE -->
<div class="container">
	<div class="row">
			<form class="form-inline text-center moteur-recherche" action="<?= $this->url('search_courts')?>">

				<div class="form-group">
					<label for='searchWhere'>Lieu *</label>
					<input class="form-control" type='text' name='searchWhere' placeholder="Ville / CP">
				</div>

				<div class="form-group">
					<label for="datepicker"> Date </label>
					<input class="form-control" type="text" id="datepicker" placeholder="Sélectionnez la date">
					<input type="hidden" id="alternate" name="date">
				</div>

				<div class="form-group">
					<label for='has_match'> Match </label>
					<select name='has_match' class="form-control">
						<option value='both' selected>-- Indifférent --</option>
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
	</div>
</div>

<!-- LISTE DES TERRAINS OU RETOUR DE RECHERCHE -->

<?php 

// S'il y a des erreurs il me les affiche 
if (isset($showErrors) && !empty($showErrors)) { ?>
<div class='col-lg-4 col-lg-offset-4 alert alert-danger text-center'><?= $showErrors;?></div><?php
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
				<div class='flex-description col-md-12 well'>
					<div class='col-md-3'>
						<img class="img-rounded img-responsive" src="<?php if(isset($court['picture']) && !empty($court['picture'])){ echo $this->assetUrl('img/uploads/thumbnails/'.$court['picture']);} else{echo $this->assetUrl('img/court-default.png');}?>" alt='Le terrain'>
					</div>
					<div class='col-md-9'>
						<h4><?= $court['name'];?></h4>
						<p class="description-terrain"><?= nl2br($court['description']);?></p>
						<!-- <p><?php if($court['parking'] == '1') { echo'<i class="fa fa-car" aria-hidden="true">';  }?></p>-->
						<a class="lien-info-terrain" href='<?=$this->url('court_details', ['id' => isset($getGames) ? $court['court_id'] : $court['id']])?>'>Plus d'informations et liste des matchs</a>
					</div>
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

<?= $this->stop('script') ?>




