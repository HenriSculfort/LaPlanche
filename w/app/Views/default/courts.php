<?=$this->layout('layout', ['title' => 'Liste des terrains']); ?>

<?php $this->start('header_content');?>
<div class="site-heading">
	<h1>Les terrains</h1>
	<p>Vous cherchez un terrain en particulier ou toute la liste ? C'est ici ! </p>
</div>

<?php $this->stop('header_content');?>

<?=$this->start('main_content');?>


<!-- FORMULAIRE DE RECHERCHE -->
<form action="<?= $this->url('search_courts')?>">
	<div class='container'>
		<div class='row'>
			<label for='searchWhere'>Lieu *</label>
			<input type='text' name='searchWhere' placeholder="Ville / CP">

			<label for='date'>Date </label>

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

			<label for='has_match'> Match </label>
			<input type='checkbox' name='has_match'>

			<label for='distanceSlider'> Distance </label>
			<input id="distance" data-slider-id='distanceSlider' type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="50"/>

			<button type='submit' id='searchBtn' class='btn btn-warning'>Rechercher </button>
		</div>
		<small>* champ requis</small>
	</div>
</form>

<!-- LISTE DES TERRAINS OU RETOUR DE RECHERCHE -->

<?php 
if(isset($findAll)) { 
	foreach($findAll as $court) {?>
	<div class='container'>
		<div class='row'>
			<div class='col-md-2'>
				<img src="<?=$this->assetUrl('img/basketball.png');?>" alt='Le terrain'>
			</div>
			<div class='col-md-10'>
				<h4><?= $court['name'];?></h4>
				<p><?= $court['description'];?></p>
			</div>
		</div>
		<div class='row'>
			<a href=''>Plus d'informations et liste des matchs</a>
		</div>
	</div>	
	<?php }	
}

?>

<?=$this->stop('main_content');?>





