<?= $this->layout('layout', ['title' => 'Mot de passe oublié']);

$this->start('main_content'); ?>


<article>
	<div id="errors" style="color:red"></div>
	<div id="message" style="color:green"></div>
</article>

<form method="post">
	<label>Entrez votre email</label>
	<input type="text" name="email">
	<button type="submit">Envoyer</button>
</form>

	<?= $this->stop('main_content'); ?>

	<?= $this->start('script'); ?>
	
<script>

$(document).ready(function(){

	$('button[type="submit"]').on('click', function(e){

		// Empeche l'action par défaut, dans notre cas la soumission du formulaire

		e.preventDefault(); 

		$.ajax({

			url: '<?= $this->url('users_tokensAjax');?>', 
			type: 'post',
			data: $('form').serialize(),	
			dataType: 'json',

			success: function(resPHP){

				if(resPHP.result == true) {
					
					$('#message').val('');
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