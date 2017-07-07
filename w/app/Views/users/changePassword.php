<?= $this->layout('layout', ['title' => 'Mot de passe oublié']);?>
<?=$this->start('header_content'); ?>

<div class='standard-header'>
	<h1>Mot de passe oublié?</h1>
</div>

<?=$this->stop('header_content'); ?>

<?=$this->start('main_content'); ?>

	<article>
		<div id="errors" style="color:red"></div>
		<div id="message" style="color:green"></div>
	</article>

	<form method="POST">
		<label>Choisissez un nouveau mot de passe : </label>
		<input type="password" name="mdp" id="mdp">
		<br>
		<label>Répétez le mot de passe choisi : </label>
		<input type="password" name="mdp2" id="mdp2">
		<br>
		<input type="hidden" name="user_id" value="<?php if(isset($_GET['user_id'])){ echo $_GET['user_id'];}?>">
		<button type="submit">Réinitialiser</button>
	</form>

<?=$this->stop('main_content'); ?>

<?= $this->start('script'); ?>

<script>

	$(document).ready(function(){

		$('button[type="submit"]').on('click', function(e){

		// Empeche l'action par défaut, dans notre cas la soumission du formulaire

		e.preventDefault(); 

		$.ajax({

			url: '<?= $this->url('users_changePasswordAjax');?>', 
			type: 'post',
			data: $('form').serialize(),	
			dataType: 'json',
			success: function(resPHP){

				if(resPHP.result == true) {
						//affiche le message de validation dans la div avec l'id message
						$('#message').html(resPHP.message);
						//vide les erreurs
						$('#errors').html('');//on vide les messages d'erreures
						//vide les champs du nouveau pass
						$('#mdp').val('');
						$('#mdp2').val('');

					}
					else if(resPHP.result == false) { 
						$('#errors').html(resPHP.errors);
					}		
				}
			});
	});
	});
</script>
<?= $this->stop('script'); ?>