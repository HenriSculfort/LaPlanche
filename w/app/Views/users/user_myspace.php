<?php $this->layout('layout', ['title' => 'Mon Espace']) ?>

<?php $this->start('main_content') ?>
<h2>Espace Utilisateur</h2>

<h3>Mon profil</h3>

<form class='container'>
	<div class='col-md-2'>
		<label for='email'>Email</label>
	</div>
	<div class='col-md-10'>
		<input type='email' name='email' value="<?= $_SESSION['email']?>">
	</div>
	
	<div class='col-md-2'>
		<label for='level'>Niveau</label>
	</div>
	<div class='col-md-10'>
		<select name='level'>
			<option value='1'>Débutant, spécialiste du air ball</option>
			<option value='2'>Novice, je débute mais j'arrive à toucher le panier </option>
			<option value='3'>Intermédiaire, je me débrouille</option>
			<option value='4'>Avancé, ça fait des années que je joue</option>
			<option value='5'>Expert, j'ai raté une carrière à la NBA</option>
		</select>
	</div>
	
	<div class='col-md-2'>
		<label for='address'>Adresse</label>
	</div>
	<div class='col-md-10'>
		<textarea type='text' name='address' value="<?= $_SESSION['address']?>"></textarea>
	</div>
	
	<div class='col-md-2'>
		<label for='cp'>Code Postal</label>
	</div>
	<div class='col-md-10'>
		<input type='text' name='cp' value="<?= $_SESSION['cp']?>">
	</div>

	<div class='col-md-2'>
		<label for='city'>Ville</label>
	</div>
	<div class='col-md-10'>
		<input type='text' name='city' value="<?= $_SESSION['city']?>">
	</div>

	<div class='col-md-2'>
		<label for='phone'>Téléphone (facultatif)</label>
	</div>
	<div class='col-md-10'>
		<input type='text' name='phone' value="<?php if(isset($_SESSION['phone'])){ echo $_SESSION['phone'];}?>">
	</div>

	<button type='submit'>Envoyer les modifications</button>
	
</form>



<?php $this->stop('main_content') ?>


