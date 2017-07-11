<?= $this->layout('layout', ['title' => 'Gestion affichage']);?>

<?=$this->start('header_content'); ?>
<br>
<ul class="nav nav-tabs">
	<li role="presentation" class="active"><a href="<?=$this->url('admin_courtsValidate');?>">Valider terrain</a></li>
	<li role="presentation"><a href="<?=$this->url('admin_getCourtsList');?>">Modifier terrain</a></li>
	<li role="presentation"><a href="<?=$this->url('admin_compte');?>">Gestion des comptes utilisateurs</a></li>
	<li role="presentation" class="active"><a href="<?=$this->url('admin_changeLook');?>">Apparence du site</a></li>
</ul>

<div class='standard-header'>
	<h1>Espace administrateur</h1>
	<h2>Modifier l'annonce spéciale du site</h2>
</div>

<?=$this->stop('header_content'); ?>

<?=$this->start('main_content'); ?>


<form method='POST' action='<?=$this->url('admin_changeLook')?>'>
	<textarea class='form-control' placeholder="Informations à mettre en page d'accueil" rows='2'></textarea>
	<button class='btn btn-warning'>Ajouter</button>
</form>

<?=$this->stop('main_content'); ?>

