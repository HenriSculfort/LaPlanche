<?=$this->layout('layout', ['title' => 'Accueil']); ?>

<?php $this->start('header_content') ?>

<style> 
  .intro-header
  { 
  	background-image: url(<?= $this->assetUrl('img/sport-ground.jpg')?>) 
  }  
</style>

<div class="index-header">
  <h1>La Planche</h1>
  <p class="legend-header">Trouvez des gens avec qui jouer près de chez vous...</p>
  <hr class="small">
  <div class="search">
    <input class="searchWhere" type="text" name="where" placeholder="Où souhaitez-vous jouer...?">
    <button type="button" class="btn btn-warning btn-lg">Rechercher</button>
</div>
</div>

<?php $this->stop('header_content') ?>



<?php $this->start('main_content') ?>

<?php $this->stop('main_content') ?>


