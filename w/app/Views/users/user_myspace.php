<?php $this->layout('layout', ['title' => 'Mon Espace']) ?>

<?php $this->start('header_content');?>
<div class="standard-header">
	<h1>Espace Utilisateur</h1>
	<p class="legend-header">Cet espace vous permet de modifier vos données personnelles et de suggérer un nouveau terrain</p>
</div>

<?php $this->stop('header_content');?>


<?php $this->start('main_content') ?>



<!-- Données du profil utilisateur -->
<h3>Mon profil</h3>
<br>

<div id='ModifUserAjax'></div>

<form method='POST' id='UserModif' action='#'>
	<div class='container-fluid'>

		<div class='row form-group hidden'>
			<div class='col-md-offset-2 col-md-4'>
				<label for='id'>id</label>
			</div>
			<div class='col-md-4'>
				<input type='id' class='form-control' name='id' value="<?= $_SESSION['user']['id']?>">
			</div> 
		</div>
		<div class="row form-group">
			<div class='col-md-offset-1 col-md-4 align-right'>
				<label for="username" class="align-right" control-label">Pseudo *</label>
			</div>
			<div class='col-md-4'>
				<input type="text" class='form-control' name="username" id="username" value="<?= $_SESSION['user']['username']?>">
				<div id="errors-pseudo" class="errorsForms"></div><!-- Affiche l'erreur du pseudo-->
				<div id="errors-username_exist"></div><!-- Affiche l'erreur si le mail existe déjà en base-->
			</div>
		</div>
		<div class='row form-group'>
			<div class='col-md-offset-1 col-md-4 align-right'>
				<label for='email'>Email</label>
			</div>
			<div class='col-md-4'>
				<input type='email' class='form-control' name='email' value="<?= $_SESSION['user']['email']?>">
			</div> 
		</div>

		<div class='row form-group'>
			<div class='col-md-offset-1 col-md-4 align-right'>
				<label for='level'>Niveau</label>
			</div>
			<div class='col-md-4'>
				<select class='form-control' name='level'>
					<!-- Le php sert à sélectionner le bon niveau pour l'utilisateur s'il l'a déjà renseigné -->
					<option value="0" <?php if(isset($_SESSION['user']['level']) && $_SESSION['user']['level'] == 0){ echo 'selected'; }?>>-- Sélectionnez votre niveau --</option>
					<option value='1' <?php if(isset($_SESSION['user']['level']) && $_SESSION['user']['level'] == 1){ echo 'selected'; }?>>Débutant, spécialiste du air ball</option>
					<option value='2' <?php if(isset($_SESSION['user']['level']) && $_SESSION['user']['level'] == 2){ echo 'selected'; }?>>Novice, je débute mais j'arrive à toucher le panier </option>
					<option value='3' <?php if(isset($_SESSION['user']['level']) && $_SESSION['user']['level'] == 3){ echo 'selected'; }?>>Intermédiaire, je me débrouille</option>
					<option value='4' <?php if(isset($_SESSION['user']['level']) && $_SESSION['user']['level'] == 4){ echo 'selected'; }?>>Avancé, ça fait des années que je joue</option>
					<option value='5' <?php if(isset($_SESSION['user']['level']) && $_SESSION['user']['level'] == 5){ echo 'selected'; }?> >Expert, j'ai raté une carrière à la NBA </option>
				</select>
			</div>
		</div>
		<div class='row form-group'>
			<div class='col-md-offset-1 col-md-4 align-right'>
				<label for='address'>Adresse</label>
			</div>
			<div class='col-md-4'>
				<textarea type='text' class='form-control' name='address'><?= $_SESSION['user']['address']?></textarea>
			</div>
		</div>

		<div class='row form-group'>
		<div class='col-md-offset-1 col-md-4 align-right'>
				<label for='postal_code'>Code Postal</label>
			</div>
			<div class='col-md-4'>
				<input type='text' class='form-control' name='postal_code' value="<?= $_SESSION['user']['postal_code'];?>">

			</div>
		</div>

		<div class='row form-group'>
			<div class='col-md-offset-1 col-md-4 align-right'>
				<label for='city'>Ville</label>
			</div>
			<div class='col-md-4'>
				<input type='text' class='form-control' name='city' value="<?= $_SESSION['user']['city']?>">
			</div>
		</div>

		<div class='row form-group'>
			<div class='col-md-offset-1 col-md-4 align-right'>
				<label for='phone'>Téléphone (facultatif)</label>
			</div>
			<div class='col-md-4'>
				<input type='text' class='form-control' name='phone' value="<?php if(isset($_SESSION['user']['phone']) && $_SESSION['user']['phone'] != 0){ echo $_SESSION['user']['phone'];}?>">
			</div>
		</div>
		<div class="row form-group" >
			<label for="password" class="col-md-offset-1 col-md-4 align-right">Modifier votre mot de passe *</label>
			<div class="col-md-4">
				<input type="password" class='form-control' name="password" id="password">
				<div id="errors-mot_de_passe" class="errorsForms"></div><!-- Affiche l'erreur du mot de passe-->
			</div>
		</div>
		<div class="row form-group" >
			<label for="checkPassword" class="col-md-offset-1 col-md-4 align-right">Répéter le mot de passe *</label>
			<div class="col-md-4">
				<input type="password" class='form-control' name="checkPassword" id="checkPassword">
				<div id="errors-verif_mot_de_passe" class="errorsForms"></div><!-- Affiche l'erreur de verif du mot de passe-->
			</div>
		</div>
		<br>
		<div class="col-md-12 text-center">
			<button type='submit' id='modifUser' class='btn btn-primary'>Envoyer les modifications</button>
		</div>

	</div>

</form>
<hr>
<!-- Ajout de terrain -->
<h3>Ajouter un terrain</h3>
<br>
<div id='resultAjax'></div>
<!-- Row pour prendre en compte la colonne d'affichage de la map à droite-->
<div class='row'>

	<!-- Colonne du formulaire -->
	<div class='col-md-6'>

		<form method="post" id="addTerrain" class="container-fluid" enctype="multipart/form-data" action="#">

			<div class='row form-group'>
				<div class='col-md-4 align-right'>
					<label for='name'>Nom</label>
				</div>
				<div class='col-md-8'>
					<input type='text' class='form-control' name='name' placeholder="Un nom pour ce terrain">
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4 align-right'>
					<label for='description'>Description</label>
				</div>
				<div class='col-md-8'>
					<textarea type='text' class='form-control' name='description' placeholder='Une description du terrain et  des infrastructures disponibles' rows='10'></textarea>
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4 align-right'>
					<label for='court_state'>Etat du terrain</label>
				</div>
				<div class='col-md-8'>
					<select class='form-control' name='level'>
						<option value='' selected >Choisissez l'état</option>
						<option value='very_bad'>Très mauvais état !</option>
						<option value='bad'>Mauvais état </option>
						<option value='medium' >Etat moyen, acceptable </option>
						<option value='good'>Bon état </option>
						<option value='very_good'>Très bon état !</option>
					</select>
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4 align-right'>
					<label for='address'>Adresse</label>
				</div>
				<div class='col-md-8'>
					<textarea type='text' class='form-control' name='address' placeholder="Adresse du terrain"></textarea>
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4 align-right'>
					<label for='postal_code'>Code Postal</label>
				</div>
				<div class='col-md-8'>
					<input type='text' class='form-control' name='postal_code' placeholder="CP">
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4 align-right'>
					<label for='city'>Ville</label>
				</div>
				<div class='col-md-8'>
					<input type='text' class='form-control' name='city' placeholder="Ville">
				</div>
			</div>

			<div class='row form-group'  >
				<div class='col-md-4 align-right'>
					<label for='picture'>Photo</label>
				</div>
				<div class="col-md-8">
					<input type="file" class='form-control' name="picture" accept="image/*">
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4 align-right'>
					<label for='net'>Filet sur le(s) panier(s) ?</label>
				</div>
				<div class='col-md-8'>
					<input type='radio' name='net' value='yes'> Oui-  
					<input type='radio' name='net' value='no'> Non
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4 align-right'>
					<label for='opening_hours'>Horaires d'ouverture (facultatif)</label>
				</div>
				<div class='col-md-8'>
					<input type='text' class='form-control' name='opening_hours' placeholder="Horaires d'ouverture">
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4 align-right'>
					<label for='parking'>Parking (facultatif)</label>
				</div>
				<div class='col-md-6'>
					<input type='radio' name='parking' value='yes'> Oui   
					<input type='radio' name='parking' value='no'> Non
				</div>
			</div>

			<br>
			<div class="col-md-12 text-center">
				<button type='submit' id='addCourts' class='btn btn-primary'>Suggérer le terrain</button>
			</div>

		</form>
	</div> <!-- Fin du div de colonne formulaire -->

	<!-- Colonne dédiée à l'affichage de la carte quand l'utilisateur à validé -->
	<div class='col-md-6'>
		<div class='row'>
			<div id='confirmCourtAddress'>
				
			</div>
			<div class='col-md-12'>
				<!-- Insérer la carte ici -->
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d45246.87781291566!2d-0.621160310316816!3d44.863722599089755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5527e8f751ca81%3A0x796386037b397a89!2sBordeaux!5e0!3m2!1sen!2sfr!4v1499080951336" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>
<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>

<script>

	$(document).ready(function(){

		$('#modifUser').on('click', function(e){
	// Empeche l'action par défaut, dans notre cas la soumission du formulaire

			e.preventDefault(); 

	
			$.ajax({
				url: '<?=$this->url('modif_user');?>', 
				type: 'post',
				data: $('#UserModif').serialize(),		
				dataType: 'json', // Les données de retour seront envoyées en JSON
				success: function(retourJson){
					if(retourJson.result == true){ 
						$('#ModifUserAjax').html('<div class="alert alert-success">' + retourJson.message + '</div>');
					}
					else if(retourJson.result == false){
						$('#ModifUserAjax').html('<div class="alert alert-danger">' + retourJson.errors + '</div>');
					}

				},

			});
		});
	});
</script>

<script>

	$(document).ready(function(){

		$('#addCourts').on('click', function(e){
	// Empeche l'action par défaut, dans notre cas la soumission du formulaire

	e.preventDefault(); 

	var $form = $('#addTerrain');
	var formdata = (window.FormData) ? new FormData($form[0]) : null;
	var data = (formdata !== null) ? formdata : $form.serialize();


	
	$.ajax({
		url: '<?=$this->url('add_courts');?>', 
		type: 'post',
				contentType: false, // obligatoire pour de l'upload
            	processData: false, // obligatoire pour de l'upload	
				dataType: 'json', // Les données de retour seront envoyées en JSON
				data: data,	
				success: function(retourJson){
					if(retourJson.result == true){ 
						$('#resultAjax').html('<div class="alert alert-success">' + retourJson.message + '</div>');
					}
					else if(retourJson.result == false){
						$('#resultAjax').html('<div class="alert alert-danger">' + retourJson.errors + '</div>');
					}

				},

			});
});
	});
</script>



<?php $this->stop('script') ?>




