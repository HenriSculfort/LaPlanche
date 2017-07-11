<?= $this->layout('layout', ['title' => 'Gestion affichage']);?>

<?=$this->start('header_content'); ?>
<br>
<ul class="nav nav-tabs">
	<li role="presentation" class="active"><a href="<?=$this->url('admin_courtsValidate');?>">Valider terrain</a></li>
	<li role="presentation"><a href="<?=$this->url('admin_getCourtsList');?>">Modifier terrain</a></li>
	<li role="presentation"><a href="<?=$this->url('admin_compte');?>">Gestion des comptes utilisateurs</a></li>
	<li role="presentation" class="active"><a href="<?=$this->url('admin_showMessage');?>">Apparence du site</a></li>
</ul>

<div class='standard-header'>
	<h1>Espace administrateur</h1>
	<h2>Modifier l'annonce spéciale du site</h2>
</div>

<?=$this->stop('header_content'); ?>

<?=$this->start('main_content'); ?>

<div id='error'></div>
<div id='success'></div>
<form method='POST'>
	<textarea class='form-control' placeholder="Informations à mettre en page d'accueil" rows='2' name='message' id='message'></textarea>
	<button id='modifyMessage' class='btn btn-warning'>Modifier</button>
</form>

<h2>Modifier la photo de couverture</h2>

<form method="POST" id="changeBackground" action='<?=$this->url('admin_changeBackground')?>' enctype="multipart/form-data">
	<input type="file" name="name">
	<br>

	<button type="submit">Envoyer</button>
</form>

<?=$this->stop('main_content'); ?>

<?=$this->start('script');?>

<script>
// Affichage du message
function getMessage() {

	$.getJSON('<?=$this->url('admin_loadMessage');?>',function(result) {
		$('#message').html(result.message);		
	});
}

// On lance le jQuery
$(document).ready(function() {

	$(function() {
		getMessage();
		// On surveille le clic d'envoi de nouveau message
		$('#modifyMessage').on('click', function(modif) {
			modif.preventDefault();

			var $message = $('textarea#message').val();

			$.ajax({
				url: '<?= $this->url('admin_updateMessage');?>',
				type: 'POST',
				data: {
					message: $message,
				},
				dataType: 'json',
				success: function(retourJson) {
					getMessage();
					// Si le message a bien été posté 
					if (retourJson.result == true) {
						// Sert à vider le champ pour ne pas avoir à effacer le message précédent avant d'en taper un nouveau
						$('textarea#message').val(retourJson.message);
						$('#success').addClass('alert alert-success').val(retourJson.success);
						// Pour réinitialiser les erreurs si jamais on envoie un message correct 
						$('#error').removeClass('alert alert-danger');
						$('#error').text('');
					}
					// En cas d'erreur 
					else if (retourJson.result == false) {
						$('#error').fadeIn().delay(1000).html(retourJson.errors).addClass('alert alert-danger').fadeOut().delay(3000);
						$('textarea#message').val('');
					}

				} // Fermeture du success

			}); // Fermeture du AJAX

		}); // Fermeture de l'event on clic envoi
	});
}); // Fin de l'appel jQuery
</script>



<?=$this->stop('script');?>
