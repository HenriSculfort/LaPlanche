<?=$this->layout('layout', ['title' => 'Inscription | La planche']); ?>


<?php $this->start('main_content') ?>


		<div id="success"></div> <!-- Affiche le message de réussite d'inscription-->
	</div>
</div>
<h1 class="text-center">Inscription utilisateur</h1>
<div class='container'>
	<div class='row'>
		<form class="form-horizontal" role="form" method="post">
			<div class='row'>
				<div class="col-lg-12">
					<div class="form-group">
						<label for="firstname" class="col-sm-4 control-label">Prénom *</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="firstname" id="firstname">
							<div id="errors-prenom" class="errorsForms"></div><!-- Affiche l'erreur du prénom-->
						</div>
					</div>
					<div class="form-group">
						<label for="lastname" class="col-sm-4 control-label">Nom *</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="lastname" id="lastname">
							<div id="errors-nom" class="errorsForms"></div><!-- Affiche l'erreur du nom-->
						</div>
					</div>
					<div class="form-group" >
						<label for="address" class="col-sm-4 control-label">Adresse *</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="address" id="address">
							<div id="errors-adresse" class="errorsForms"></div><!-- Affiche l'erreur de l'adresse-->
						</div>
					</div>
					<div class="form-group" >
						<label for="cp" class="col-sm-4 control-label">Code postal *</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="cp" id="cp">
							<div id="errors-code_postal" class="errorsForms"></div><!-- Affiche l'erreur du code postal-->
						</div>
					</div>
					<div class="form-group" >
						<label for="city" class="col-sm-4 control-label">Ville *</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="city" id="city">
							<div id="errors-ville" class="errorsForms"></div><!-- Affiche l'erreur de la ville-->
						</div>
					</div>
					<div class="form-group" >
						<label for="email" class="col-sm-4 control-label">Email *</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="email" id="email">
							<div id="errors-mail" class="errorsForms"></div><!-- Affiche l'erreur du format d'email-->
							<div id="errors-mail_exist"></div><!-- Affiche l'erreur si le mail existe déjà en base-->
						</div>
					</div>
					<div class="form-group" >
						<label for="phone" class="col-sm-4 control-label">Téléphone</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="phone" id="phone">
						</div>
					</div>                             
					<div class="form-group">
						<label for="username" class="col-sm-4 control-label">Pseudo *</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="username" id="username">
							<div id="errors-pseudo" class="errorsForms"></div><!-- Affiche l'erreur du pseudo-->
							<div id="errors-username_exist"></div><!-- Affiche l'erreur si le mail existe déjà en base-->
						</div>
					</div>
					<div class="form-group">
						<label for="level" class="col-sm-4 control-label">Niveau</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="level" id="level">
						</div>
					</div>
					<div class="form-group" >
						<label for="password" class="col-sm-4 control-label">Mot de passe *</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" name="password" id="password">
							<div id="errors-mot_de_passe" class="errorsForms"></div><!-- Affiche l'erreur du mot de passe-->
						</div>
					</div>
					<div class="form-group" >
						<label for="checkPassword" class="col-sm-4 control-label">Répéter le mot de passe *</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" name="checkPassword" id="checkPassword">
							<div id="errors-verif_mot_de_passe" class="errorsForms"></div><!-- Affiche l'erreur de verif du mot de passe-->
						</div>
					</div>
					<div class="form-group text-center" >
						<button type="submit" id="inscription" class="btn btn-primary control-label">S'inscrire</button>
					</div>
				</div>
				<div class="text-center"><small>* : champs obligatoires</small><div>
			</div>
		</form>
	</div>
</div>


<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>

<script>

// Ajax formulaire d'inscription
$(document).ready(function(){

	// permet d'effacer l'erreur à la saisie du champ
	$('input[type="text"]').keyup(function(){
		$(this).parent().find('.errorsForms').html('');
	});

	// permet d'effacer l'erreur à la saisie du champ
	$('input[type="password"]').keyup(function(){
		$(this).parent().find('.errorsForms').html('');
	});

	$('#inscription').on('click', function(e){
		e.preventDefault();
		$.ajax({
			url: '<?=$this->url('users_insert');?>',
			type: 'post',
			dataType: 'json',
			data: $('form').serialize(),
			success: function(retourJson){
				if(retourJson.result == true){ 
					$('#success').html('<div class="alert alert-success text-center">Vous êtes inscrit !</div>');
					$('input').val('');
				}
				else if(retourJson.result == false){
					$.each(retourJson.errors, function(key, value){
						$('#errors-'+key).html('<p style=color:#9D0E2B;font-size:1.3rem;margin:0>'+value+'</p>');
					});
				}
			}  
		});
	});
});


</script>

<?php $this->stop('script') ?>
