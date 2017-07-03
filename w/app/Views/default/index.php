<?=$this->layout('layout', ['title' => 'Accueil']); ?>

<?php $this->start('header_content') ?>

 <style> 
.intro-header
  { 
  	background-image: url(<?= $this->assetUrl('img/sport-ground.jpg')?>) 
  }  
 </style>
  
   
<?php $this->stop('header_content') ?>



<?php $this->start('main_content') ?>

<?php $this->stop('main_content') ?>


