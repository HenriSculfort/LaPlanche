<?=$this->layout('layout', ['title' => 'Accueil']); ?>


<?php $this->start('searchIndex_content') ?>

<input type="text" name="whereSearch">
<button type="button" class="btn btn-warning" placeholder="<i class='fa fa-search' aria-hidden='true'></i>">Rechercher</button>


<?php $this->stop('searchIndex_content') ?>



<?php $this->start('footer_content') ?>

<?php $this->stop('footer_content') ?>
