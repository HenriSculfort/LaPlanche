<?=$this->layout('layout', ['title' => 'Gestion des terrains validés']); ?>

<?php $this->start('header_content');?>

<div class="standard-header">
	<h1>Les terrains validés</h1>
</div>
<?php $this->stop('header_content');?>

<?=$this->start('main_content');?>

<div class="container">
	<div class="row">
		<form class="form-inline text-center moteur-recherche" action="<?= $this->url('admin_searchCourt')?>">
			<input type='text' placeholder="Où?" name='location'>
			<input type='text' placeholder="Nom" name='name'>
			<button type='submit'>Rechercher</button>
		</form>
	</div>
</div>

<?php if(isset($searchResults) && $searchResults == true) {

	if (isset($search)) { 
		$courtResult = $search;
	}
} else { 

	if (isset($findAll)) { 
		$courtResult = $findAll;
	}
}?>

<?=$this->stop('main_content');?>
