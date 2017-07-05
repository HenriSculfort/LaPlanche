<?=$this->layout('layout', ['title' => 'Détail du terrain']); ?>

<?php $this->start('header_content');?>
<div class="standard-header">
    <h1>Détails du terrain</h1>
</div>
<?=
$findCourt['description'];?>




<?php $this->stop('header_content');?>

<?=$this->start('main_content');?>
<?=$this->stop('main_content');?>
