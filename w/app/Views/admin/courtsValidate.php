<?= $this->layout('layout', ['title' => 'Espace admin']);?>
<?=$this->start('header_content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div>
			<a href="<?=$this->url('admin_getCourtsList');?>"><button type='button' class='btn btn-primary'>Modifier terrain</button></a>
				<a href="<?=$this->url('admin_compte');?>"><button type='button' class='btn btn-primary'>Gestion des comptes utilisateurs</button></a>
			</div>
		</div>
	</div>
</div>
<div class='standard-header'>
	<h1>Espace administrateur</h1>
	<h2>Validation des terrains</h2>
</div>

<?=$this->stop('header_content'); ?>

<?=$this->start('main_content'); ?>

<?php
//boucle pour afficher les terrains
foreach($findAll as $court) {

		//permet de n'afficher que les terrains non validé
		if( $court['admin_validation'] == 0) { ?>
		<div class='container'>

			<!--début du formulaire avec les 2 bouton submit-->
			<form method="post" id="<?=$court['id'];?>">
				<div class='row'>
					<div class='flex-description col-md-12 well'>
					
						<div class='col-md-3'>
							<img class="img-rounded img-responsive" src="<?php if(isset($court['picture']) && !empty($court['picture'])){ echo $this->assetUrl('img/uploads/'.$court['picture']);} else{echo $this->assetUrl('img/court-default.png');}?>" alt='Le terrain'>
						</div>
						<div class='col-md-9'>
							<h4><?= $court['name'];?></h4>
							<p class="description-terrain"><?= nl2br($court['description']);?></p>
							<br>
							<p class="description-terrain"><?= nl2br($court['address'] . ' ' . $court['postal_code'] . ' ' . $court['city']);?></p>
							<br>
							<p class="description-terrain"><?= nl2br($court['opening_hours']);?></p>
						</div>

						<!--On envoie l'id du terrain que l'on veut valider ou supprimer avec un nom à chaque boutton qui devient un paramétre dans $_POST-->
						<input type="hidden" name="valeurId" value="<?=$court['id'];?>">
						<button type="submit" name="validez">Validez</button>
						<button type="submit" name="supprimez">Supprimez</button>
					
					</div>
				</form>
			</div>
		</div>
		<?php } 
	}// Fin foreach
?>


<?=$this->stop('main_content'); ?>

<?=$this->start('script'); ?>




