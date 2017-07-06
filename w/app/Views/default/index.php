<?=$this->layout('layout', ['title' => 'Accueil']); ?>

<?php $this->start('header_content') ?>

<style> 
  .intro-header
  { 
  	background-image: url(<?= $this->assetUrl('img/sport-ground.jpg')?>) 
  }  
</style>

<div class="index-header">
    <p class="legend-header-index">Cherche le city le plus proche de chez toi !</p>
    <div class="search">
        <input class="searchWhere" type="text" name="where" placeholder="Où souhaitez-vous jouer...?">
        <button type="button" class="btn btn-warning btn-lg button-search-index">Rechercher</button>
    </div>
</div>


<?php $this->stop('header_content') ?>

<?php $this->start('main_content') ?>

<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-services">La planche vous permet de :</h2>
            </div>
        </div>
        <div class="detail-services row text-center">
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                 <img src="<?= $this->assetUrl('img/basketball.png')?>" alt="ballon de basket">
             </span>
             <h4 class="service-heading">Proposer un match</h4>
             <p class="text-muted">En consultant le détail des terrains, il sera très simple pour vous de prévoir une rencontre. Il suffira de planifier la date à partir du terrain sélectionné.</p>
         </div>
         <div class="col-md-4">
            <span class="fa-stack fa-4x">
                <img src="<?= $this->assetUrl('img/trophy.png')?>" alt="coupe">
            </span>
            <h4 class="service-heading">Participer à un match</h4>
            <p class="text-muted"></p>
        </div>
        <div class="col-md-4">
            <span class="fa-stack fa-4x">
            <img class="rotate" src="<?= $this->assetUrl('img/basketball-court.png')?>" alt="terrain de basket">
            </span>
            <h4 class="service-heading">Ajouter un terrain</h4>
            <p class="text-muted">Nous </p>
        </div>
    </div>
</div>
</section>

<?php $this->stop('main_content') ?>


