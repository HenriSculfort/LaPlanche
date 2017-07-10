<?=$this->layout('layout', ['title' => 'Gestion des terrains validés']); ?>

<?php $this->start('header_content');?>

<div class="standard-header">
	<h1>Les terrains validés</h1>
</div>
<?php $this->stop('header_content');?>

<?=$this->start('main_content');?>

<?php foreach ($findAll as $court) { 
	if( $court['admin_validation'] == 1) { ?>
		<div class='container'>
			<div class='row'>
				<div class='flex-description col-md-12 well'>
					<div class='col-md-3'>
						<img class="img-rounded img-responsive" src="<?php if(isset($court['picture']) && !empty($court['picture'])){ echo $this->assetUrl('img/uploads/thumbnails/'.$court['picture']);} else{echo $this->assetUrl('img/court-default.png');}?>" alt='Le terrain'>
					</div>
					<div class='col-md-7'>
						<h4><?= $court['name'];?></h4>
						<p class="description-terrain"><?= nl2br($court['description']);?></p>
						<!-- <p><?php if($court['parking'] == '1') { echo'<i class="fa fa-car" aria-hidden="true">';  }?></p>-->
						<a class="lien-info-terrain" href='<?=$this->url('court_details', ['id' => isset($getGames) ? $court['court_id'] : $court['id']])?>'>Plus d'informations et liste des matchs</a>
					</div>
					<div class='col-md-2'>
						<button class='btn btn-warning'>Modifier le terrain</button>
						<button class='btn btn-danger' onClick="if(confirm('Le terrain va être supprimé.')){return true;}else{return false;}">Supprimer le terrain</button>
					</div>
				</div>
			</div>
		</div>
	<?php } 
}// Fin foreach?>

<?=$this->stop('main_content');?>
