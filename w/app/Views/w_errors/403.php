<?php $this->layout('layout', ['title' => 'Rien à voir ici']) ?>

<?php $this->start('main_content'); ?>
<h1>Erreur 403. Vous n'avez pas les autorisations requises pour accéder à ce contenu.</h1>
<p>Retour à l'accueil <a href="<?= $this->url('accueil');?>">Cliquer ici</a></p>
<?php $this->stop('main_content'); ?>
