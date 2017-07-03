<?php $this->layout('layout', ['title' => 'Perdu ?']) ?>

<?php $this->start('main_content'); ?>
<h1>404. Perdu ?</h1>
<p>Retour à l'accueil <a href="<?= $this->url('accueil');?>">Cliquer ici</a></p>
<?php $this->stop('main_content'); ?>
