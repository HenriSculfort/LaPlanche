<?= $this->layout('layout', ['title' => 'Espace admin']);?>
<?=$this->start('header_content'); ?>
<br>
<ul class="nav nav-tabs">
	<li role="presentation"><a href="<?=$this->url('admin_courtsValidate');?>">Valider terrain</a></li>
	<li role="presentation"><a href="<?=$this->url('admin_getCourtsList');?>">Modifier terrain</a></li>
	<li role="presentation" class="active"><a href="<?=$this->url('admin_compte');?>">Gestion des comptes utilisateurs</a></li>
	<li role="presentation"><a href="<?=$this->url('admin_showMessage');?>">Apparence du site</a></li>
</ul>

<div class='standard-header'>
	<h1>Espace administrateur</h1>
	<h2>Gestion des comptes</h2>
</div>

<?=$this->stop('header_content'); ?>

<?=$this->start('main_content'); ?>

<article>
	<div id="errors" style="color:red"></div>
	<div id="message" style="color:green"></div>
</article>

<div class='table-responsive'>
	<table class="table">
		<thead>
			<tr>
				<th>Pseudo utilisateur</th>
				<th>Niveau</th>
				<th>Prénom</th>
				<th>Nom</th>
				<th>email</th>
				<th>adresse</th>
				<th>Téléphone</th>
				<th>Statut</th>
				<th>Supprimer</th>
				<th>Blacklist</th>
			</tr>
		</thead>
		<tbody  id="viewBoucle">
			<?php
			?>
		</tbody>
	</table>

</div>

<?= $this->stop('main_content'); ?> 
<?=$this->start('script'); ?>

<script>

	function getList() {

		$.getJSON('<?=$this->url('admin_getListAjax');?>', function(boucle){	
			$('#viewBoucle').html(boucle.html);		
		});
	}
	$(document).ready(function(){
		getList();
		$(document).ajaxComplete (function (){//permet de signaler des evenements sur du contenu généré en ajax
			$('.zob').on('click', function(e){

				// Empeche l'action par défaut, dans notre cas la soumission du formulaire
				e.preventDefault(); 
				
				id_user = $(this).data('id'); // Permet de récupérer la valeur de l'id en champ caché
				currentForm = $('#user-id-'+id_user);
				blacklist_user = $('#blacklist-'+ id_user +' option:selected').val();
				role_user = $('#role-'+ id_user +' option:selected').val();
				suppr_user = 'off'; // Valeur par défaut

				if($('#suppr-'+ id_user).is(':checked')){ // si on coche la case
					suppr_user = 'on';
				}

				$.ajax({

					url: '<?= $this->url('admin_compteAjax');?>', 
					type: 'GET',
					data: {id: id_user, role: role_user, suppr: suppr_user, blacklist: blacklist_user},	
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
	});
</script>
<?=$this->stop('script'); ?>
