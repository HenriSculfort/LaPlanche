<?=$this->layout('layout', ['title' => 'Inscription']); ?>


<?php $this->start('main_content') ?>


	<?php 
		if(!empty($formErrors)){
			echo '<p style="color:red">'.implode('<br>', $formErrors);
		}

		if($formValid == true){
			echo '<p style="color:green">Vous êtes désormais inscrit</p>';
		}

	?>

	<form method="post">
		<label for="firstname">Votre prénom</label>
		<input type="text" id="firstname" name="firstname">

		<br>
		<label for="lastname">Votre nom</label>
		<input type="text" id="lastname" name="lastname">

		<br>
		<label for="username">Votre pseudo</label>
		<input type="text" id="username" name="username">

		<br>
		<label for="email">Votre email</label>
		<input type="email" id="email" name="email">

		<br>
		<label for="password">Votre mot de passe</label>
		<input type="password" id="password" name="password">

		<br>
		<label for="role">Votre rôle</label>
		<select name="role">
			<option value="" selected></option>
			<option value="admin">Administrateur</option>
			<option value="editor">Editeur</option>
			<option value="user">Utilisateur</option>
		</select>

		<br>
		<button type="submit">Enregistrer cet utilisateur</button>
	</form>


<?php $this->stop('main_content') ?>
