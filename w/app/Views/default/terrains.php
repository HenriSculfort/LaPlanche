<?=$this->layout('layout', ['title' => 'Liste des terrains']); ?>

<?php $this->start('header_content');?>
	<div class="site-heading">
		<h1>Les terrains</h1>
		<p>Vous cherchez un terrain en particulier ou toute la liste ? C'est ici ! </p>
	</div>

<?php $this->stop('header_content');?>

<?=$this->start('main_content');?>

<label for='searchWhere'>Lieu </label>
<input type='text' name='searchWhere' placeholder="Ville / CP">

<label for='date'>Date </label>
<input type='date' name='date'>

<label for='has_match'>Match </label>
<input type='checkbox' name='has_match'>

<label for='distanceSlider'>Distance </label>
<input id="distance" data-slider-id='distanceSlider' type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="50"/>

<button type='submit' id='searchBtn' class='btn btn-warning'>Rechercher </button>


<?=$this->stop('main_content');?>