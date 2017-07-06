<?php $this->layout('layout', ['title' => 'Perdu ?']) ?>

<?php $this->start('main_content'); ?>
<div class="standard-header">
	<h1>404. Perdu ?</h1>
	<p>Retour à l'accueil, <a href="<?= $this->url('accueil');?>">cliquez ici</a></p>
</div>
<?php $this->stop('main_content'); ?>
