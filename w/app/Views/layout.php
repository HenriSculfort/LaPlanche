<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $this->e($title) ?></title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/bootstrap.min.css') ?>">

    <!-- Slider Bootstrap modif via plugin -->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/bootstrap-slider.css') ?>">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/clean-blog.min.css') ?>">

    <!-- Styles CSS personnalisés -->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">

    <!-- Custom Fonts -->
    <link href="<?= $this->assetUrl('font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $this->assetUrl('img/favicon/favicon-16x316.png')?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $this->assetUrl('img/favicon/favicon-32x32.png')?>">
    <link rel="apple-touch-icon" sizes="57x57" href="<?= $this->assetUrl('img/favicon/apple-icon-57x57.png')?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= $this->assetUrl('img/favicon/apple-icon-60x60.png')?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= $this->assetUrl('img/favicon/apple-icon-72x72.png')?>">
</head>

<body id='pageTop'>

    <!-- Navigation -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class='navbar-brand' href='<?= $this->url('accueil')?>'>La Planche</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php if(!empty($w_user) && $w_user['role'] == 'admin'): ?>
                        <li>
                            <a href="<?= $this->url('admin_compte') ?>">Admin</a>
                        </li>
                    <?php endif; ?> 
                    <li>
                        <a href="<?= $this->url('accueil') ?>">Accueil</a>
                    </li>
                    <li>
                        <a href="<?= $this->url('courts') ?>">Terrains</a>
                    </li>
                    <?php if(!empty($w_user)): ?>
                        <li>
                            <a href="<?= $this->url('users_myspace') ?>">Mon espace</a>
                        </li>
                        <li>
                            <a href="<?= $this->url('contact') ?>">Contact</a>
                        </li>
                        <li>
                            <a href="<?=$this->url('users_logout');?>">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?= $this->url('contact') ?>">Contact</a>
                        </li>
                        <li>
                            <a href=""<?= $this->url('users_login') ?>"" data-toggle="modal" data-target="#connexion">Connexion</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Header content -->
    <header class="intro-header">     
        <div class="container">
            <div class="row">
                <!-- Affichage des message flash de connexion et deconnexion -->
                <?php if(!empty($w_flash_message->message)): ?>
                    <div class="message-connexion text-center col-lg-4 col-lg-offset-4 alert alert-<?=$w_flash_message->level;?>">
                        <?=$w_flash_message->message;?>
                    </div>
                <?php endif; ?>
                <div class="col-lg-8 col-lg-offset-2">
                    <?= $this->section('header_content') ?>
                </div>
                <!-- Connexion -->
                <div class="modal fade" id="connexion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="loginmodal-container">
                            <h3>Connectez-vous !</h3><br>
                            <div id="errorsAjaxConnexion"></div>
                            <form method="post">
                                <input type="text" name="emailConnexion" placeholder="Email">
                                <input type="password" name="passwordConnexion" placeholder="Mot de passe">
                                <input type="submit" id="connexion_popup" name="login" class="login loginmodal-submit" value="Connexion">
                            </form>
                            <div class="login-help">
                                <a href="<?= $this->url('users_add') ?>">Inscription</a><a href="<?= $this->url('users_tokensForm') ?>">Mot de passe oublié ?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <?= $this->section('main_content') ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <?php if(!empty($w_user) && $w_user['role'] == 'admin'): ?>
                            <li>
                                <a href="<?= $this->url('admin_compte') ?>">Admin</a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?= $this->url('accueil') ?>">Accueil</a>
                        </li>
                        <li>
                            <a href="<?= $this->url('courts') ?>">Terrains</a>
                        </li>
                        <?php if(!empty($w_user)): ?>
                            <li>
                                <a href="<?= $this->url('users_myspace') ?>">Mon espace</a>
                            </li>
                            <li>
                                <a href="<?= $this->url('contact') ?>">Contact</a>
                            </li>
                            <li>
                                <a href="<?=$this->url('users_logout');?>">Déconnexion</a>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?= $this->url('contact') ?>">Contact</a>
                            </li>
                            <li>
                                <a href=""<?= $this->url('users_login') ?>"" data-toggle="modal" data-target="#connexion">Connexion</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; La Planche | 2017</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>-->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>

    <!-- Contact Form JavaScript -->
    <script src="<?= $this->assetUrl('js/jqBootstrapValidation.js') ?>"></script>

    <!-- Theme JavaScript -->
    <script src="<?= $this->assetUrl('js/clean-blog.min.js') ?>"></script>

    <!-- JS pour slider Bootstrap -->
    <script src="<?= $this->assetUrl('js/bootstrap-slider.js') ?>"></script>
    <!-- Theme JavaScript personnalisé -->
    <script src="<?= $this->assetUrl('js/script.js') ?>"></script>

    <!-- Ajax connexion -->
    <script>
        $(document).ready(function(){

            $('#connexion_popup').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url: '<?=$this->url('users_login');?>',
                    type: 'post',
                    dataType: 'json',
                    data: $('form').serialize(),
                    success: function(retourJson){
                        if(retourJson.result == true){
                            $('#connexion').modal('hide');
                            location.reload();   
                        }
                        else if(retourJson.result == false){
                            $('#errorsAjaxConnexion').html('<div class="alert alert-danger">'+retourJson.errors+'</div>');
                        }
                    }   
                });
            });
        });
    </script>

    <?= $this->section('script');?>

    <div>
        <button id='btnPageTop' class="btn page-scroll" onclick="goToTop()">
            <i class="fa fa-arrow-up"></i>
        </button>
    </div>
</body>

</html>
