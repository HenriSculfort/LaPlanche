<?= $this->layout('layout', ['title' => 'Espace admin']);?>
<?=$this->start('header_content'); ?>

<div class='standard-header'>
	<h1>Espace administrateur</h1>
	<h2>Gestion des comptes</h2>
</div>

<?=$this->stop('header_content'); ?>

<?=$this->start('main_content'); ?>
<?php
//if($_SESSION['role'] = 'admin'){
?>
<article>
	<div id="errors" style="color:red"></div>
	<div id="message" style="color:green"></div>
</article>

<div>
	<table class="table table-striped">
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
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($listuser as $key => $value) { ?>
			<tr>

				<form type="GET" id="user-id-<?= $value['id']; ?>">
					<td><?php echo $value['username'];?></td>
					<td><?php echo $value['level'];?></td>
					<td><?php echo $value['firstname'];?></td>
					<td><?php echo $value['lastname'];?></td>
					<td><?php echo $value['email'];?></td>
					<td><?php echo $value['address'] . ' '. $value['postal_code'] . ' ' . $value['city'];?></td>
					<td><?php echo $value['phone'];?></td>
					<td>
						<select name="role" class="select-role" id="role-<?= $value['id']; ?>" >
							<option value="user" <?php if(isset($value['role']) && $value['role'] == 'user'){ echo 'selected'; }?>>User</option>
							<option value="admin" <?php if(isset($value['role']) && $value['role'] == 'admin'){ echo 'selected'; }?>>Admin</option>
						</select>
					</td>
					<td>
						<input type="checkbox" name="suppr" id="suppr-<?= $value['id']; ?>">
					</td>
					
					<td>
						<button type="submit" data-id="<?=$value['id'];?>">Appliquez</button>
					</td>
				</form>
			</tr>
			<?php }	?>
		</tbody>
	</table>

</div>
<?php
/*}else{
?>
	<script>
		window.location='<?=$this->url('accueil');?>';
	</script>
	<?php
}*/
?>
<?= $this->stop('main_content'); ?> 
<?=$this->start('script'); ?>

<script>

	$(document).ready(function(){

		$('button[type="submit"]').on('click', function(e){

			// Empeche l'action par défaut, dans notre cas la soumission du formulaire
			e.preventDefault(); 

			id_user = $(this).data('id'); // Permet de récupérer la valeur de l'id en champ caché
			currentForm = $('#user-id-'+id_user);

			role_user = $('#role-'+ id_user +' option:selected').val();
			suppr_user = 'off'; // Valeur par défaut

			if($('#suppr-'+ id_user).is(':checked')){ // si on coche la case
				suppr_user = 'on';
			}

			$.ajax({

				url: '<?= $this->url('admin_compteAjax');?>', 
				type: 'GET',
				data: {id: id_user, role: role_user, suppr: suppr_user },	
				dataType: 'json',
				success: function(resPHP){

					if(resPHP.result == true) {
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
