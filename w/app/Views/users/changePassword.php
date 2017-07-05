<?= $this->layout('layout', ['title' => 'Mot de passe oublié']);?>
<?=$this->start('header_content'); ?>

<div class='standard-header'>
	<h1>Mot de passe oublié?</h1>
</div>

<?=$this->stop('header_content'); ?>

<?=$this->start('main_content'); ?>

<?php 
if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
?>

	<article>
		<div id="errors" style="color:red"></div>
		<div id="message" style="color:green"></div>
	</article>

	<form method="POST">
		<label>Choisissez un nouveau mot de passe : </label>
		<input type="text" name="mdp">
		<br>
		<label>Répétez le mot de passe choisi : </label>
		<input type="text" name="mdp2">
		<br>
		<input type="hidden" name="user_id" value="<?php if(isset($_GET['user_id'])){ echo $_GET['user_id'];}?>">
		<button type="submit">Réinitialiser</button>
	</form>

<?php 
}else{
	echo 'user_id introuvable';
} 
?>

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
					
						$('#message').html(resPHP.message);
						//renvoie dans la div 'message' la valeur contenu dans .val; ici renvoie une valeur vide
						$('#errors').html('');//on vide les messages d'erreures
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