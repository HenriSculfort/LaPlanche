<?=$this->layout('layout', ['title' => 'Contact']); ?>

<?php $this->start('header_content');?>
<div class="standard-header"">
    <h1>Contact</h1>
    <p class="legend-header">Vous souhaitez nous contacter ? Remplissez le formulaire ci-dessous !</p>
</div>

<?php $this->stop('header_content');?>

<?=$this->start('main_content');?>


<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
    <form name="sentMessage" id="contactForm" novalidate>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Nom</label>
                <input type="text" class="form-control" placeholder="Nom" id="name">
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Adresse email</label>
                <input type="email" class="form-control" placeholder="Adresse email" id="email">
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Téléphone</label>
                <input type="tel" class="form-control" placeholder="Téléphone" id="phone">
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Message</label>
                <textarea rows="5" class="form-control" placeholder="Message" id="message"></textarea>
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <br>
        <div id="success"></div>
        <div class="row">
            <div class="form-group col-xs-12">
                <button type="button" class="btn btn-primary">Envoyer</button>
            </div>
        </div>
    </form>
</div>


<hr>

<?=$this->stop('main_content');?>

