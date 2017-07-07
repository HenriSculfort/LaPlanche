<?php $this->layout('layout', ['title' => 'Rien à voir ici']) ?>

<?php $this->start('main_content'); ?>

<div class="standard-header">
	<div class="col-md-12">               
		<img src="<?= $this->assetUrl('img/basketball_403.png')?>" class="image-erreur" alt="ballon de basket">
	</div>
		<h1>Erreur 403. Vous n'avez pas les autorisations requises pour accéder à ce contenu.</h1>
		<p>Retour à l'accueil, <a href="<?= $this->url('accueil');?>">cliquez ici</a></p>
	</div>
</div>

<?php $this->stop('main_content'); ?>
