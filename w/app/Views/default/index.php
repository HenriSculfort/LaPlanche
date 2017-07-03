<?=$this->layout('layout', ['title' => 'Accueil']); ?>

<?php $this->start('header_content') ?>

<header class="intro-header" style="background-image: url(<?= $this->assetUrl('img/sport-ground.jpg') ?>)">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<div class="site-heading">
					<h1>La Planche</h1>
					<p>Trouvez des gens avec qui jouer près de chez vous...</p>
					<hr class="small">
					<div class="search">
					<input class="searchWhere" type="text" name="where" placeholder="&#9906;">
						<button type="button" class="btn btn-warning btn-lg">Rechercher</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<?php $this->stop('header_content') ?>



<?php $this->start('main_content') ?>

<?php $this->stop('main_content') ?>


