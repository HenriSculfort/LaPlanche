<?=$this->layout('layout', ['title' => 'Gestion des terrains validés']); ?>

<?php $this->start('header_content');?>
<!-- <div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div>
			<a href="<?=$this->url('admin_courtsValidate');?>"><button type='button' class='btn btn-primary'>Valider terrain</button></a>
				<a href="<?=$this->url('admin_compte');?>"><button type='button' class='btn btn-primary'>Gestion des comptes utilisateurs</button></a>
			</div>
		</div>
	</div>
</div> -->

<br>
<ul class="nav nav-tabs">
	<li role="presentation"><a href="<?=$this->url('admin_courtsValidate');?>">Valider terrain</a></li>
	<li role="presentation" class="active"><a href="<?=$this->url('admin_getCourtsList');?>">Modifier terrain</a></li>
	<li role="presentation"><a href="<?=$this->url('admin_compte');?>">Gestion des comptes utilisateurs</a></li> 
</ul>



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
<div class='col-lg-4 col-lg-offset-4 alert alert-warning text-center'>Votre recherche n'a retourné aucun résultat. <br><a href='<?=$this->url('admin_getCourtsList')?>'>Retour à la liste des terrains</a></div> <?php
}
elseif (isset($findAll)) { 
	$courtResult = $findAll;
}

if(isset($courtResult)) {
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
						<button class='btn btn-warning showModifications' data-id='<?=$court['id']?>' value="<?=$court['id']?>">Modifier</button>
						<form method='POST' action='<?=$this->url('admin_deleteCourt')?>'>
							<input type='hidden' value='<?=$court['id']?>' name='id'>
							<button class='btn btn-danger' onClick="if(confirm('Le terrain va être supprimé.')){return true;}else{return false;}"  value="<?=$court['id']?>">Supprimer</button>
						</form>
					</div>
				</div>

				<form method='POST' id="modifyCourt" action='<?=$this->url('admin_modifyCourt');?>' enctype="multipart/form-data">
					<div class='row hidden' id='court<?=$court['id'];?>'>
						<input type='hidden' value='<?=$court['id'];?>' name='id'>

						<label for='name'>Photo</label>
						<input type='file' class='form-control' name='picture' value='<?=$court['picture'];?>' accept="image/*">

						<label for='name'>Nom</label>
						<input type='text' class='form-control' name='name' value='<?=$court['name'];?>'>

						<label for='address'>Adresse</label>
						<input type='text' class='form-control' name='address' value='<?=$court['address'];?>'>

						<label for='postal_code'>Code Postal</label>
						<input type='text' class='form-control' name='postal_code' value='<?=$court['postal_code'];?>'>

						<label for='city'>Ville</label>
						<input type='text' class='form-control' name='city' value='<?=$court['city'];?>'>

						<label for='opening_hours'>Horaires d'ouverture</label>
						<input type='text' class='form-control' name='opening_hours' value='<?=$court['opening_hours'];?>'>

						<label for='description'>Description</label>
						<textarea name='description' class='form-control' rows='10' value='<?=$court['description'];?>'><?=$court['description'];?></textarea>

						<label for='net'>Filet</label>
						<input type='radio' name='net' value='yes' <?php if ($court['net'] == 'yes') { echo 'selected';}?>> Oui-  
		                 <input type='radio' name='net' value='no' <?php if ($court['net'] == 'no') { echo 'selected';}?>> Non<br>


					  	<label for='court_state'>Etat du terrain</label>
					  	<select class='form-control' name='court_state'>
					   		<option value='' <?php if($court['court_state'] == 0 ){ echo 'selected'; }?> >Choisissez l'état</option>
	                        <option value='very_bad' <?php if($court['court_state'] == 'very_bad'){ echo 'selected'; }?>>Très mauvais état !</option>
	                        <option value='bad' <?php if($court['court_state'] == 'bad'){ echo 'selected'; }?>>Mauvais état </option>
	                        <option value='medium' <?php if($court['court_state'] == 'medium'){ echo 'selected'; }?>>Etat moyen, acceptable </option>
	                        <option value='good'<?php if($court['court_state'] == 'good'){ echo 'selected'; }?>>Bon état </option>
	                        <option value='very_good' <?php if($court['court_state'] == 'very_good'){ echo 'selected'; }?>>Très bon état !</option>
	                    </select>

						<label for='parking'>Parking (facultatif)</label>
						<input type='radio' name='parking' value='yes' <?php if($court['parking'] == '1'){ echo 'selected'; }?>> Oui   
			            <input type='radio' <?php if($court['parking'] == '0'){ echo 'selected'; }?> name='parking' value='no'> Non
						<br>
						<button class='btn btn-success' type='submit'>Valider les modifications</button>
			  		</div>
			  	</form>
			</div>	
		</div>
		<?php } 
	}// Fin foreach
} // Fin du if isset courtResult dans le cas où la recherche ne donne rien?>
<?=$this->stop('main_content');?>

<?=$this->start('script');?>
<script>
// FONCTION POUR AJOUTER OU SUPPRIMER LA CLASSE GERANT L'AFFICHAGE DU CHAT OU NON
function showModifications($courtId) {
	if (($('#court'+$courtId).css('display')) == 'none' || ($('#court'+$courtId).css('display')) == 'hidden') {
		$('#court'+$courtId).removeClass('hidden').addClass('show');
	} else {
		$('#court'+$courtId).addClass('hidden');
	}
}

$(document).ready(function() {
	
	
		// Au clic du bouton d'affichage du chat
		$('.showModifications').on('click', function() {
			var $courtId = $(this).data('id');
			showModifications($courtId)
		});
	});
</script>
<?=$this->stop('script');?>
