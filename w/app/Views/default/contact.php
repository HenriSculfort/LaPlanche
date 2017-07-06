<?=$this->layout('layout', ['title' => 'Contact']); ?>

<?php $this->start('header_content');?>
<div class="standard-header">
    <h1>Contact</h1>
    <p class="legend-header">Vous souhaitez nous contacter ? Remplissez le formulaire ci-dessous !</p>
</div>

<?php $this->stop('header_content');?>

<?=$this->start('main_content');?>

<div class="container col-lg-4 col-lg-offset-4">
    <div class='row'>
        <div id="success"></div> <!-- Affiche le message d'envoi du formulaire'-->
    </div>
</div>
<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
    <form method="post" name="sentMessage" id="contactForm" novalidate>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Nom</label>
                <input type="text" class="form-control" placeholder="Nom" id="name" name="name">
                <div id="errors-nom" class="errorsForms"></div><!-- Affiche l'erreur du nom-->
            </div>
        </div>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Adresse email</label>
                <input type="email" class="form-control" placeholder="Adresse email" id="email" name="email">
                <div id="errors-mail" class="errorsForms"></div><!-- Affiche l'erreur du mail-->
            </div>
        </div>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Message</label>
                <textarea rows="7" class="form-control" placeholder="Message" id="message" name="message"></textarea>
                <div id="errors-message" class="errorsForms"></div><!-- Affiche l'erreur du message-->
            </div>
        </div>
        <br>
        <div id="success"></div>
        <div class="row">
            <div class="form-group col-xs-12 text-center">
                <button id="sendForm" type="button" class="btn btn-primary">Envoyer</button>
            </div>
        </div>
    </form>
</div>

<?=$this->stop('main_content');?>

<?php $this->start('script') ?>

<script>

// Ajax formulaire d'inscription
$(document).ready(function(){

    $('#sendForm').on('click', function(e){
        console.log('toto');
        e.preventDefault();
        $.ajax({
            url: '<?=$this->url('contact_send');?>',
            type: 'post',
            dataType: 'json',
            data: $('form').serialize(),
            success: function(retourJson){
                if(retourJson.result == true){ 
                    $('#success').html('<div class="alert alert-success text-center">Votre message a bien été envoyé !</div>');
                    $('input').val('');
                    $('textarea').val('');
                }
                else if(retourJson.result == false){
                    $.each(retourJson.errors, function(key, value){
                        $('#errors-'+key).html('<p style=color:#9D0E2B;font-size:1.3rem;margin:0>'+value+'</p>');
                    });
                }
            }  
        });
    });
});

</script>

<?php $this->stop('script') ?>

