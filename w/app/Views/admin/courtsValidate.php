<?= $this->layout('layout', ['title' => 'Espace admin']);?>
<?=$this->start('header_content'); ?>
<br>
<ul class="nav nav-tabs">
    <li role="presentation" class="active"><a href="<?=$this->url('admin_courtsValidate');?>">Valider terrain</a></li>
    <li role="presentation"><a href="<?=$this->url('admin_getCourtsList');?>">Modifier terrain</a></li>
    <li role="presentation"><a href="<?=$this->url('admin_compte');?>">Gestion des comptes utilisateurs</a></li>
    <li role="presentation"><a href="<?=$this->url('admin_showMessage');?>">Apparence du site</a></li>
</ul>

<div class='standard-header'>
    <h1>Espace administrateur</h1>
    <h2>Validation des terrains</h2>
</div>

<?=$this->stop('header_content'); ?>

<?=$this->start('main_content'); ?>

<?php
//boucle pour afficher les terrains
foreach($findAll as $court) {

    //permet de n'afficher que les terrains non validé
    if( $court['admin_validation'] == 0) 
    { ?>
<div class='container'>

    <!--début du formulaire avec les 2 bouton submit-->
    <form method="post" id="<?=$court['id'];?>">
        <div class='row'>
            <div class='flex-description col-lg-12 col-lg-offset-0 col-xs-10 col-xs-offset-1 well'>

                <div class='col-md-2'>
                    <img class="img-rounded img-responsive" src="<?php if(isset($court['picture']) && !empty($court['picture'])){ echo $this->assetUrl('img/uploads/'.$court['picture']);} else{echo $this->assetUrl('img/court-default.png');}?>" alt='Le terrain'>
                </div>
                <div class='col-md-7'>
                    <h4><?= $court['name'];?></h4>
                    <p><strong>Description : </strong><?= nl2br($court['description']);?></p>
                    <p><strong>Adresse : </strong><?= nl2br($court['address'] . ' ' . $court['postal_code'] . ' ' . $court['city']);?></p>
                    <p><strong>Horaires : </strong><?= nl2br($court['opening_hours']);?></p>
                </div>
                <div class='col-md-3'>
                    <!--On envoie l'id du terrain que l'on veut valider ou supprimer avec un nom à chaque boutton qui devient un paramétre dans $_POST-->
                    <input type="hidden" name="valeurId" value="<?=$court['id'];?>">
                    <button type="submit" class='btn btn-success' name="validez">Valider</button>
                    <button type="submit" class='btn btn-danger' onClick="if(confirm('Le terrain va être supprimé.')){return true;}else{return false;}" name="supprimez">Supprimer</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php 
    } 
}// Fin foreach
?>

<?=$this->stop('main_content'); ?>






