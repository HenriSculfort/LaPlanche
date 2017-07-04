<?=$this->layout('layout', ['title' => 'Inscription']); ?>


<?php $this->start('main_content') ?>

<div class='container'>
	<div class='row'>
		<form class="form-horizontal" role="form" method="">
			<div class='row'>
				<div class="col-lg-6">
					<!--<form class="form-horizontal" role="form">-->
					<div class="form-group">
						<label for="firstname" class="col-sm-3 control-label">Prénom</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="firstname" id="firstname">
						</div>
					</div>
					<div class="form-group">
						<label for="lastname" class="col-sm-3 control-label">Nom</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="lastname" id="lastname">
						</div>
					</div>
					<div class="form-group" >
						<label for="address" class="col-sm-3 control-label">Adresse</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="address" id="address">
						</div>
					</div>
					<div class="form-group" >
						<label for="cp" class="col-sm-3 control-label">Code postal</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="cp" id="cp">
						</div>
					</div>
					<div class="form-group" >
						<label for="city" class="col-sm-3 control-label">Ville</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="city" id="city">
						</div>
					</div>
					<div class="form-group" >
						<label for="phone" class="col-sm-3 control-label">Téléphone</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="phone" id="phone">
						</div>
					</div>
					<!--                                    </form>-->
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="username" class="col-sm-3 control-label">Pseudo</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="username" id="username">
						</div>
					</div>
					<div class="form-group">
						<label for="level" class="col-sm-3 control-label">Niveau</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="level" id="level">
						</div>
					</div>
					<div class="form-group" >
						<label for="address" class="col-sm-3 control-label">Adresse</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="address" id="address">
						</div>
					</div>
					<div class="form-group" >
						<label for="password" class="col-sm-3 control-label">Mot de passe</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="password" id="password">
						</div>
					</div>
					<div class="form-group" >
						<label for="checkPassword" class="col-sm-3 control-label">Répéter le mot de passe</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="checkPassword" id="checkPassword">
						</div>
					</div>
				</div>
			</div>
			<button type="submit" id="inscription" class="btn btn-default col-sm-1 col-md-offset-5 control-label">S'inscrire</button>
		</form>
	</div>
</div>

<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>

<script>
// Ajax inscription
    $(document).ready(function(){

        $('#inscription').on('click', function(e){
            e.preventDefault();
            $.ajax({
                url: '<?=$this->url('users_add');?>',
                type: 'post',
                dataType: 'json',
                data: $('form').serialize(),
                success: function(retourJson){
                    if(retourJson.result == true){ 
                        $('#errorsAjaxInscription').text(''); 
                        window.location.href("<?=$this->url('users_add');?>");
                    }
                    else if(retourJson.result == false){
                        $('#errorsAjaxInscription').html(retourJson.errors);
                    }
                }   
            });
        });
    });
</script>

<?php $this->stop('script') ?>
