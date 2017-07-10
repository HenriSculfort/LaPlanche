<?=$this->layout('layout', ['title' => 'Gestion des terrains validés']); ?>

<?php $this->start('header_content');?>

<div class="standard-header">
	<h1>Les terrains validés</h1>
</div>
<?php $this->stop('header_content');?>

<?=$this->start('main_content');?>

<div class="container">
	<div class="row">
			<form class="form-inline text-center moteur-recherche" action="<?= $this->url('admin_searchCourts')?>">

				<div class="form-group">
					<label for='location'>Lieu</label>
					<input class="form-control" type='text' name='location' placeholder="Ville / CP">
				</div>
				<div class="form-group">
					<label for='name'>Nom du terrain </label>
					<input class="form-control" type='text' name='name' placeholder="ex : city stade brun">
				</div>

				<button type='submit' id='searchBtn' class='btn btn-warning'>Rechercher </button>
			</form>
	</div>
</div>


<?php 
// Affichage des résultats en fonction de s'il y a eu recherche ou pas.
if(isset($searchResults) && $searchResults == true) {
	
	if (isset($search)) { 
		$courtResult = $search;
	}
}
elseif (isset($searchResults) && $searchResults == false) { ?>
<div class='col-lg-4 col-lg-offset-4 alert alert-warning text-center'>Votre recherche n'a retourné aucun résultat. Si vous avez des terrains à suggérer, n'hésitez pas à le faire via votre espace personnel ! </div> <?php
}
elseif (isset($findAll)) { 
	$courtResult = $findAll;
}

foreach ($courtResult as $court) { 
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
					</div>
					<div class='col-md-2'>
						<button class='btn btn-warning showModifications' value="<?=$court['id']?>">Modifier</button>
						<button class='btn btn-danger' onClick="if(confirm('Le terrain va être supprimé.')){return true;}else{return false;}" value="<?=$court['id']?>">Supprimer</button>
					</div>
				</div>
			</div>
			<div class='row hidden' id='modify'>
				<label for='name'>Nom</label>
				<input type='text' name='name' value='<?=$court['name'];?>'>

				<label for='address'>Adresse</label>
				<input type='text' name='address' value='<?=$court['address'];?>'>

				<label for='postal_code'>Code Postal</label>
				<input type='text' name='postal_code' value='<?=$court['postal_code'];?>'>

				<label for='city'>Ville</label>
				<input type='text' name='city' value='<?=$court['city'];?>'>

				<label for='opening_hours'>Horaires d'ouverture</label>
				<input type='text' name='opening_hours' value='<?=$court['opening_hours'];?>'>

				<label for='description'>Description</label>
				<textarea name='description' value='<?=$court['description'];?>'></textarea>

			</div>
		</div>
	<?php } 
}// Fin foreach?>

<?=$this->stop('main_content');?>

<?=$this->start('script');?>
<script>
// FONCTION POUR AJOUTER OU SUPPRIMER LA CLASSE GERANT L'AFFICHAGE DU CHAT OU NON
function showModifications() {
	if (($('#modify').css('display')) == 'none' || ($('#modify').css('display')) == 'hidden') {
		$('#modify').removeClass('hidden').addClass('show');
	} else {
		$('#modify').addClass('hidden');
	}
}

$(document).ready(function() {
		// Au clic du bouton d'affichage du chat
		$('.showModifications').on('click', function(e) {
			showModifications()
		});
});
</script>
<?=$this->stop('script');?>
