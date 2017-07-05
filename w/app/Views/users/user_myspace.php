<?php $this->layout('layout', ['title' => 'Mon Espace']) ?>

<?php $this->start('header_content');?>
<div class="site-heading">
	<h1>Espace Utilisateur</h1>
	<p>Cet espace vous permet de modifier vos données personnelles et de suggérer un nouveau terrain</p>
</div>

<?php $this->stop('header_content');?>


<?php $this->start('main_content') ?>



<!-- Données du profil utilisateur -->
<h3>Mon profil</h3>
<br>
<form method='POST' action='#'>
	<div class='container-fluid'>

	<?php

	print_r( $_SESSION);
	?>


		<!--<div class='row form-group'>
			<div class='col-md-3'>
				<label for='email'>Email</label>
			</div>
			<div class='col-md-9'>
				<input type='email' name='email' value="<?= $_SESSION['email']?>">
			</div> -->
		</div>

		<div class='row form-group'>
			<div class='col-md-3'>
				<label for='level'>Niveau</label>
			</div>
			<div class='col-md-9'>
				<select name='level'>
					<!-- Le php sert à sélectionner le bon niveau pour l'utilisateur s'il l'a déjà renseigné -->
					<option value='1' <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 1){ echo 'selected'; }?>>Débutant, spécialiste du air ball</option>
					<option value='2' <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 2){ echo 'selected'; }?>>Novice, je débute mais j'arrive à toucher le panier </option>
					<option value='3' <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 3){ echo 'selected'; }?>>Intermédiaire, je me débrouille</option>
					<option value='4' <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 4){ echo 'selected'; }?>>Avancé, ça fait des années que je joue</option>
					<option value='5' <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 5){ echo 'selected'; }?> >Expert, j'ai raté une carrière à la NBA </option>
				</select>
			</div>
		</div>
		<div class='row form-group'>
			<div class='col-md-3'>
				<label for='address'>Adresse</label>
			</div>
			<div class='col-md-9'>
				<textarea type='text' name='address' value="<?= $_SESSION['address'];?>"></textarea>
			</div>
		</div>

		<div class='row form-group'>
			<div class='col-md-3'>
				<label for='postal_code'>Code Postal</label>
			</div>
			<div class='col-md-9'>
				<input type='text' name='postal_code' value="<?php if(isset($_SESSION['postal_code'])){ echo $_SESSION['postal_code']; }?>">
				<?php if(isset($_SESSION['postal_code'])){ echo $_SESSION['postal_code']; }?>
			</div>
		</div>

		<div class='row form-group'>
			<div class='col-md-3'>
				<label for='city'>Ville</label>
			</div>
			<div class='col-md-9'>
				<input type='text' name='city' value="<?= $_SESSION['city']?>">
			</div>
		</div>

		<div class='row form-group'>
			<div class='col-md-3'>
				<label for='phone'>Téléphone (facultatif)</label>
			</div>
			<div class='col-md-9'>
				<input type='text' name='phone' value="<?php if(isset($_SESSION['phone'])){ echo $_SESSION['phone'];}?>">
			</div>
		</div>
		<br>
		<button type='submit' class='btn btn-primary'>Envoyer les modifications</button>
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
	<div class='col-md-8'>

		<form method='post' class='container-fluid' enctype="multipart/form-data" action='#'>

			<div class='row form-group'>
				<div class='col-md-4'>
					<label for='name'>Nom</label>
				</div>
				<div class='col-md-8'>
					<input type='text' name='name' placeholder="Un nom pour ce terrain">
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4'>
					<label for='description'>Description</label>
				</div>
				<div class='col-md-8'>
					<textarea type='text' name='description' placeholder='Une description du terrain et  des infrastructures disponibles' rows='10'></textarea>
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4'>
					<label for='court_state'>Etat du terrain</label>
				</div>
				<div class='col-md-8'>
					<select name='level'>
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
				<div class='col-md-4'>
					<label for='address'>Adresse</label>
				</div>
				<div class='col-md-8'>
					<textarea type='text' name='address' placeholder="Adresse du terrain"></textarea>
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4'>
					<label for='postal_code'>Code Postal</label>
				</div>
				<div class='col-md-8'>
					<input type='text' name='postal_code' placeholder="CP">
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4'>
					<label for='city'>Ville</label>
				</div>
				<div class='col-md-8'>
					<input type='text' name='city' placeholder="Ville">
				</div>
			</div>

			<div class='row form-group'  >
				<div class='col-md-4'>
					<label for='picture'>Photo</label>
				</div>
				<input type='file' name='picture' class='col-md-8'>
			</div>

			<div class='row form-group'>
				<div class='col-md-4'>
					<label for='net'>Filet sur le(s) panier(s) ?</label>
				</div>
				<div class='col-md-8'>
					<input type='radio' name='net' value='yes'> Oui-  
					<input type='radio' name='net' value='no'> Non
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4'>
					<label for='opening_hours'>Horaires d'ouverture (facultatif)</label>
				</div>
				<div class='col-md-8'>
					<input type='text' name='opening_hours' placeholder="Horaires d'ouverture">
				</div>
			</div>

			<div class='row form-group'>
				<div class='col-md-4'>
					<label for='parking'>Parking (facultatif)</label>
				</div>
				<div class='col-md-8'>
					<input type='radio' name='parking' value='yes'> Oui -  
					<input type='radio' name='parking' value='no'> Non
				</div>
			</div>

			<br>
			<button type='submit' id='addCourts' class='btn btn-primary'>Suggérer le terrain</button>

		</form>
	</div> <!-- Fin du div de colonne formulaire -->

	<!-- Colonne dédiée à l'affichage de la carte quand l'utilisateur à validé -->
	<div class='col-md-4'>
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

		$('#addCourts').on('click', function(e){
	// Empeche l'action par défaut, dans notre cas la soumission du formulaire

			e.preventDefault(); 

	
			$.ajax({
				url: '<?=$this->url('add_courts');?>', 
				type: 'post',
				data: $('form').serialize(),		
				dataType: 'json', // Les données de retour seront envoyées en JSON
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




