<?php $this->layout('layout', ['title' => 'Mon Espace']) ?>

<?php $this->start('main_content') ?>

<h2>Espace Utilisateur</h2>

<p>Cet espace vous permet de modifier vos données personnelles et de suggérer un nouveau terrain</p>

<!-- Données du profil utilisateur -->
<h3>Mon profil</h3>

<form method='POST' action='#'>
	<div class='container-fluid'>
		<div class='row'>
			<div class='col-md-4'>
				<label for='email'>Email</label>
			</div>
			<div class='col-md-8'>
				<input type='email' name='email' value="<?= $_SESSION['email']?>">
			</div>
		</div>

		<div class='row'>
			<div class='col-md-4'>
				<label for='level'>Niveau</label>
			</div>
			<div class='col-md-8'>
				<select name='level'>
					<!-- Le php sert à sélectionner le bon niveau pour l'utilisateur s'il l'a déjà renseigné -->
					<option value='1' <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 1){ echo 'selected'; }?>>Débutant, spécialiste du air ball</option>
					<option value='2' <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 2){ echo 'selected'; }?>>Novice, je débute mais j'arrive à toucher le panier </option>
					<option value='3' <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 3){ echo 'selected'; }?>>Intermédiaire, je me débrouille</option>
					<option value='4'<?php if(isset($_SESSION['level']) && $_SESSION['level'] == 4){ echo 'selected'; }?>>Avancé, ça fait des années que je joue</option>
					<option value='5'<?php if(isset($_SESSION['level']) && $_SESSION['level'] == 5){ echo 'selected'; }?>>Expert, j'ai raté une carrière à la NBA</option>
				</select>
			</div>
		</div>
		<div class='row'>
			<div class='col-md-4'>
				<label for='address'>Adresse</label>
			</div>
			<div class='col-md-8'>
				<textarea type='text' name='address' value="<?= $_SESSION['address']?>"></textarea>
			</div>
		</div>

		<div class='row'>
			<div class='col-md-4'>
				<label for='cp'>Code Postal</label>
			</div>
			<div class='col-md-8'>
				<input type='text' name='cp' value="<?= $_SESSION['cp']?>">
			</div>
		</div>

		<div class='row'>
			<div class='col-md-4'>
				<label for='city'>Ville</label>
			</div>
			<div class='col-md-8'>
				<input type='text' name='city' value="<?= $_SESSION['city']?>">
			</div>
		</div>

		<div class='row'>
			<div class='col-md-4'>
				<label for='phone'>Téléphone (facultatif)</label>
			</div>
			<div class='col-md-8'>
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

<!-- Row pour prendre en compte la colonne d'affichage de la map à droite-->
<div class='row'>

	<!-- Colonne du formulaire -->
	<div class='col-md-8'>

		<form method='POST' class='container-fluid' enctype="multipart/form-data" action='#'>

			<div class='row'>
				<div class='col-md-4'>
					<label for='name'>Nom</label>
				</div>
				<div class='col-md-8'>
					<input type='text' name='name' placeholder="Un nom pour ce terrain">
				</div>
			</div>

			<div class='row'>
				<div class='col-md-4'>
					<label for='description'>Description</label>
				</div>
				<div class='col-md-8'>
					<textarea type='text' name='description' placeholder='Une description du terrain et  des infrastructures disponibles' rows='10'></textarea>
				</div>
			</div>

			<div class='row'>
				<div class='col-md-4'>
					<label for='court_state'>Etat du terrain</label>
				</div>
				<div class='col-md-8'>
					<select name='level'>
						<option value='very_bad'>Très mauvais état !</option>
						<option value='bad'>Mauvais état </option>
						<option value='medium' selected>Etat moyen, acceptable </option>
						<option value='good'>Bon état </option>
						<option value='very_good'>Très bon état !</option>
					</select>
				</div>
			</div>

			<div class='row'>
				<div class='col-md-4'>
					<label for='address'>Adresse</label>
				</div>
				<div class='col-md-8'>
					<textarea type='text' name='address' placeholder="Adresse du terrain"></textarea>
				</div>
			</div>

			<div class='row'>
				<div class='col-md-4'>
					<label for='postal_code'>Code Postal</label>
				</div>
				<div class='col-md-8'>
					<input type='text' name='postal_code' placeholder="CP" ">
				</div>
			</div>

			<div class='row'>
				<div class='col-md-4'>
					<label for='city'>Ville</label>
				</div>
				<div class='col-md-8'>
					<input type='text' name='city' placeholder="Ville">
				</div>
			</div>

			<div class='row'>
				<div class='col-md-4'>
					<label for='city'>Photo</label>
				</div>
				<input type='file' name='picture' class='col-md-8'>
			</div>

			<div class='row'>
				<div class='col-md-4'>
					<label for='net'>Filet sur le(s) panier(s) ?</label>
				</div>
				<div class='col-md-8'>
					<input type='radio' name='net' value='yes'> Oui -  
					<input type='radio' name='net' value='no'> Non
				</div>
			</div>

			<div class='row'>
				<div class='col-md-4'>
					<label for='opening_hours'>Horaires d'ouverture (facultatif)</label>
				</div>
				<div class='col-md-8'>
					<input type='text' name='opening_hours' placeholder="Horaires d'ouverture">
				</div>
			</div>

			<div class='row'>
				<div class='col-md-4'>
					<label for='parking'>Parking (facultatif)</label>
				</div>
				<div class='col-md-8'>
					<input type='radio' name='parking' value='yes'> Oui -  
					<input type='radio' name='parking' value='no'> Non
				</div>
			</div>

			<br>
			<button type='submit' class='btn btn-primary'>Suggérer le terrain</button>

		</form>
	</div> <!-- Fin du div de colonne formulaire -->

	<!-- Colonne dédiée à l'affichage de la carte quand l'utilisateur à validé -->
	<div class='col-md-4'>
		<div class='row'>
			<div class='col-md-12'>
				<!-- Insérer la carte ici -->
			</div>
		</div>
	</div>
	

	<?php $this->stop('main_content') ?>


