<?=$this->layout('layout', ['title' => 'Inscription']); ?>


<?php $this->start('main_content') ?>

<form>
	<div class="form-group">
	<label for="username">Pseudo</label>
		<input type="text" class="form-control" id="username" name="username" placeholder="Pseudo">
	</div>

	<div class="form-group">
	<label for="level">Niveau</label>
		<input type="text" class="form-control" id="level" name="level" placeholder="Votre niveau">
	</div>

	<div class="form-group">
	<label for="firstname">Prénom</label>
		<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom">
	</div>

	<div class="form-group">
	<label for="lastname">Nom</label>
		<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom">
	</div>

	<div class="form-group">
	<label for="address">Adresse</label>
		<input type="text" class="form-control" id="address" name="address" placeholder="Adresse">
	</div>

	<div class="form-group">
	<label for="cp">Code postal</label>
		<input type="text" class="form-control" id="cp" name="cp" placeholder="Code postal">
	</div>

	<div class="form-group">
	<label for="city">Ville</label>
		<input type="text" class="form-control" id="city" name="city" placeholder="Ville">
	</div>

	<div class="form-group">
	<label for="email">Email</label>
		<input type="text" class="form-control" id="email" name="email" placeholder="Email">
	</div>

	<div class="form-group">
	<label for="phone">Téléphone</label>
		<input type="text" class="form-control" id="phone" name="phone" placeholder="Téléphone">
	</div>

	<div class="form-group">
		<label for="exampleInputPassword1">Password</label>
		<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>


<?php $this->stop('main_content') ?>
