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

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/clean-blog.min.css') ?>">

    <!-- Styles CSS personnalisés -->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">

    <!-- Custom Fonts -->
    <link href="<?= $this->assetUrl('font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">La Planche</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?= $this->url('accueil') ?>">Accueil</a>
                    </li>
                    <li>
                        <a href="<?= $this->url('terrains') ?>">Terrains</a>
                    </li>
                    <li>
                        <a href="<?= $this->url('connexion') ?>">Connexion</a>
                    </li>
                    <li>
                        <a href="<?= $this->url('contact') ?>">Contact</a>
                    </li>
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
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <?= $this->section('header_content') ?>
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

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="<?= $this->url('accueil') ?>">Accueil</a>
                        </li>
                        <li>
                            <a href="<?= $this->url('terrains') ?>">Terrains</a>
                        </li>
                        <li>
                            <a href="<?= $this->url('connexion') ?>">Connexion</a>
                        </li>
                        <li>
                            <a href="<?= $this->url('contact') ?>">Contact</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; La Planche | 2017</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>

    <!-- Contact Form JavaScript -->
    <script src="<?= $this->assetUrl('js/jqBootstrapValidation.js') ?>"></script>
    <script src="<?= $this->assetUrl('js/contact_me.js') ?>"></script>

    <!-- Theme JavaScript -->
    <script src="<?= $this->assetUrl('js/clean-blog.min.js') ?>"></script>

</body>

</html>
