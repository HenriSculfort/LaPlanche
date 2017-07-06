<?php $this->layout('layout_contact', ['title' => 'Perdu ?']) ?>

<?php $this->start('main_content'); ?>
<div class="row text-center">
	<div class="col-md-12">               
		<img src="<?= $this->assetUrl('img/basketball_404.png')?>" class="image-erreur" alt="ballon de basket">
	</div>
</div>
<div class="standard-header">
	<h1>404. Perdu ?</h1>
	<p>Retour à l'accueil, <a href="<?= $this->url('accueil');?>">cliquez ici</a></p>
</div>
<?php $this->stop('main_content'); ?>
