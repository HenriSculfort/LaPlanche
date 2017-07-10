<?= $this->layout('layout', ['title' => 'Espace admin']);?>
<?=$this->start('header_content'); ?>

<div class='standard-header'>
	<h1>Espace administrateur</h1>
	<h2>Validation des terrains</h2>
</div>

<?=$this->stop('header_content'); ?>

<?=$this->start('main_content'); ?>
<div id='refresh'>
</div>

<?=$this->stop('main_content'); ?>

<?=$this->start('script'); ?>

<script>

function getList() {

	$.getJSON('<?=$this->url('admin_courtsValidateAjax');?>', function(boucle){	
		$('#refresh').html(boucle.html);		
	});
}

	$(document).ready(function(){

		$('button[type="submit"]').on('click', function(e){

			// Empeche l'action par défaut, dans notre cas la soumission du formulaire
			e.preventDefault(); 

			getList();

			$.ajax({

				url: '<?= $this->url('admin_courtsValidateAjax');?>', 
				type: 'POST',
				data:  $('form').serialize(),	
				dataType: 'json',
				success: function(resPHP){

					if(resPHP.result == true) {
						getList();
						//affiche le message de validation dans la div avec l'id message
						$('#message').html(resPHP.message);
						//vide les erreurs
						$('#errors').html('');//on vide les messages d'erreures
						//vide les champs du nouveau pass
					}
					else if(resPHP.result == false) { 
						$('#errors').html(resPHP.errors);
					}		
				}
			});
		});
	});
</script>
<?=$this->stop('script'); ?>

			

