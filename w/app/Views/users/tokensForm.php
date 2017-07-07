<?= $this->layout('layout_contact', ['title' => 'Mot de passe oublié']);?>
<?=$this->start('header_content'); ?>

<div class='standard-header'>
	<h1>Mot de passe oublié?</h1>
</div>

<?=$this->stop('header_content'); ?>
<?=$this->start('main_content'); ?>

<div class="container col-lg-4 col-lg-offset-4">
	<div class='row'>
		<div id="danger"></div>
		<div id="success"></div>
	</div>
</div>

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
	<div class="col-sm-4 col-sm-offset-4">               
		<img src="<?= $this->assetUrl('img/faq.png')?>" class="interrogation" alt="point d'interrogation">
	</div>
</div>

<?= $this->stop('main_content'); ?>

<?= $this->start('script'); ?>

<script>

	$(document).ready(function(){

		$('button[type="submit"]').on('click', function(e){
			e.preventDefault(); 
			$.ajax({

				url: '<?= $this->url('users_tokensAjax');?>', 
				type: 'get',
				data: $('form').serialize(),	
				dataType: 'json',

				success: function(resPHP){
					if(resPHP.result == true){
						$('#success').html('Un email vous a été envoyé').addClass('alert alert-success');
						$('#danger').removeClass('alert alert-danger');
						$('#danger').html('');
					}
					else if(resPHP.result == false){ 
						$('#danger').html(resPHP.errors).addClass('alert alert-danger');
					}		
				}
			});
		});
	});
	
</script>
<?= $this->stop('script'); ?>