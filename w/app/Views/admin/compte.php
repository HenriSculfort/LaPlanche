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
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($listuser as $key => $value) { ?>
			<tr>

				<td><?php echo $value['username'];?></td>
				<td><?php echo $value['level'];?></td>
				<td><?php echo $value['firstname'];?></td>
				<td><?php echo $value['lastname'];?></td>
				<td><?php echo $value['email'];?></td>
				<td><?php echo $value['address'] . ' '. $value['postal_code'] . ' ' . $value['city'];?></td>
				<td><?php echo $value['phone'];?></td>
				<td><?php echo $value['role'];?></td>
			</tr>
			<?php }	?>
		</tbody>
	</table>
</div>
<?php
//}
?>

<?= $this->stop('main_content'); ?>