<?= $this->layout('layout_contact', ['title' => 'Mot de passe oublié']);?>
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

<form method="GET" class="form-horizontal">
	<div class="form-group">

		<div class="col-sm-4 col-sm-offset-4">
			<label control-label">Entrez votre email</label>
			<input class="form-control" type="text" name="email">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-3 col-sm-offset-4">
			<button type="submit" class="btn btn-default">Envoyer</button>
		</div>
	</div>
</form>

<div class="row text-center">
	<div class="col-md-12">               
		<img src="<?= $this->assetUrl('img/faq.png')?>" class="interrogation" alt="point d'interrogation">
	</div>
</div>

<?= $this->stop('main_content'); ?>

<?= $this->start('script'); ?>

<script>

	$(document).ready(function(){

		$('button[type="submit"]').on('click', function(e){

		// Empeche l'action par défaut, dans notre cas la soumission du formulaire

		e.preventDefault(); 

		$.ajax({

			url: '<?= $this->url('users_tokensAjax');?>', 
			type: 'get',
			data: $('form').serialize(),	
			dataType: 'json',

			success: function(resPHP){

				if(resPHP.result == true) {
					
					$('#message').html('Un email vous a été envoyé');
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