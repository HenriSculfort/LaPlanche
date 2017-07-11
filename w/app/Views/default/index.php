<?=$this->layout('layout', ['title' => 'Accueil']); ?>

<?php $this->start('header_content') ?>

<style> 
    .intro-header
    { 
        background-image: url(
            <?php 
    if(isset($picture)){echo $this->assetUrl('img/uploads/'.$picture);}
else {echo $this->assetUrl('img/sport-ground.jpg');}
            ?>) 
    }  
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="index-header">
                <p class="legend-header-index">Une partie de basket ? Cherche un City Stade !</p>
                <div class="search">
                    <form method="POST" class="col-lg-8 search">
                        <input id='address' class="searchWhere" type="textbox" name="address" placeholder="Où souhaitez-vous jouer...?" value="<?php if(isset($_POST['address'])){echo $_POST['address']; } ?>" >
                        <input id="submit" type="submit"  value="Rechercher" class="btn btn-warning btn-lg button-search-index">
                    </form>
                </div>
                <p id='announcement'></p>
            </div>
        </div>
    </div>
</div>

<?php $this->stop('header_content') ?>

<?php $this->start('main_content') ?>

<div class="container-fluid div-map">
    <div class="row">
        <div class="col-lg-12 padding-map">
            <div id="map-index"></div>
            <form method="POST" id="search-terrain">
                <input type="hidden" value="" id="lat" name="lat">
                <input type="hidden" value="" id="lng" name="lng">
                <button id="submitGeoloc" type="submit" class="btn btn-warning button-search-terrain">Afficher les terrains pres de soi</button>
            </form>
            <div id="result"></div>
        </div>
    </div>
</div>

<section id="services" class="background-gris-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-services">La planche vous permet de :</h2>
            </div>
        </div>
        <div class="services row text-center">
            <div class="detail-services col-md-4">
                <span class="fa-stack fa-4x">
                    <img src="<?= $this->assetUrl('img/trophy.png')?>" alt="coupe">
                </span>
                <h4 class="service-heading">Participer à un match</h4>
                <p class="text-muted">Envie d'un match de basket ? Consultez la liste des matches à proximité de chez vous. Vous pourrez échanger depuis le tchat avec la communauté pour organiser la rencontre !</p>
            </div>
            <div class="detail-services col-md-4">
                <span class="fa-stack fa-4x">
                    <img src="<?= $this->assetUrl('img/basketball.png')?>" alt="ballon de basket">
                </span>
                <h4 class="service-heading">Proposer un match</h4>
                <p class="text-muted">En consultant le détail des terrains, il sera très simple pour vous de prévoir une rencontre. Il suffira de planifier la date à partir du terrain sélectionné.</p>
            </div>
            <div class="detail-services col-md-4">
                <span class="fa-stack fa-4x">
                    <img class="rotate" src="<?= $this->assetUrl('img/basketball-court.png')?>" alt="terrain de basket">
                </span>
                <h4 class="service-heading">Ajouter un terrain</h4>
                <p class="text-muted">Vous connaissez un city qui n'est pas répertorié sur La Planche ? Rendez-vous sur votre espace personnel pour ajouter le terrain et ainsi programmer des rencontres avec les personnes de la communauté.</p>
            </div>
        </div>
    </div>
</section>



<?php $this->stop('main_content') ?>
<?php $this->start('script') ?>

<script>
    // Pour modifier la visibilité ou non de la div dédiée à l'admin pour les annonces
    function showMessage() {
        if (result.status == 'show') {
            $('#announcement').removeClass('hidden').addClass('show');
        } else {
            $('#chat').removeClass('show').addClass('hidden');
        }
    }
    // Va chercher le message et le statut de celui-ci (si pas de message, statut = caché, sinon visible)
    function getMessage() {

        $.getJSON('<?=$this->url('admin_loadMessage');?>',function(result) {
            $('#announcement').html(result.message);    
            showMessage();   
        });
    };

    // On appelle la fonction
    $(document).ready(function() {

        $(function() {
            getMessage();
        });
    });

</script>

<script>

    <?php 
    // cas moteur de recherche
    if(isset($location) && !empty($location) && ($location->getLatitude() !== null)  && ($location->getLongitude() !== null)){
        $latitude = $location->getLatitude(); 
        $longitude = $location->getLongitude(); 
        echo 'var enableGeolocation = false;'; // Je crée une variable JS dans le PHP (raison du echo)
    }
    else {
        $latitude = '47.066322';
        $longitude = '2.761099';
        echo 'var enableGeolocation = true;';  // Je crée une variable JS dans le PHP (raison du echo)
    }
    ?>


    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.
    function initMap(latitudeParam, longitudeParam) 
    {
        $('#lat').val(latitudeParam);
        $('#lng').val(longitudeParam);

        var map = new google.maps.Map(document.getElementById('map-index'), {
            zoom: 13,
            center: {lat: latitudeParam, lng: longitudeParam}
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        var pos = {
            lat: latitudeParam,
            lng: longitudeParam,
        };

        infoWindow.setPosition(pos);
        infoWindow.setContent('Vous êtes ici');
        map.setCenter(pos);

        var locations = 
            [
                <?php
                if(isset($donnee) and !empty($donnee))
                {
                    foreach($donnee as $donnees)
                    {
                        if($donnees['admin_validation'] == 1)
                        {
                            if(!empty($donnees['latitude']) || !empty($donnees['longitude']))
                            {
                ?>
                ['<?php echo $donnees['name'] ?><br> <a href="<?=$this->url('court_details', ['id' => $donnees['id']])?>">Voir détails terrain</a> ', <?php echo $donnees['latitude'] ?>, <?php echo $donnees['longitude'] ?>],
                <?php
                            }
                        }
                    }
                }
                ?>
            ];

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) 
        {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                url: locations[i][4]
            });

            google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }

    } // initMap();

    // Try HTML5 geolocation.
    if(navigator.geolocation && enableGeolocation) {
        console.log('pos');
        // On récupère la position via géoloc
        navigator.geolocation.getCurrentPosition(
            function(position) {
                $('#map-index').removeClass('hidden').addClass('show');
                $('#submitGeoloc').removeClass('hidden').addClass('show');
                initMap(position.coords.latitude, position.coords.longitude); // On init la map avec les coordonnées GPS trouvées
            }, 
            function(err) {
                $('#map-index').removeClass('show').addClass('hidden');
                $('#submitGeoloc').removeClass('show').addClass('hidden');
                console.warn('ERROR(' + err.code + '): ' + err.message); // Message d'erreur
                initMap(<?=$latitude;?>, <?=$longitude;?>); // On init la map.. quelquepart dans le monde :-)

            },
        );
    }
    else {
        $(document).ready(function(){
            initMap(<?=$latitude;?>, <?=$longitude;?>);
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0xJoi5c9MwYIYQlwIEfLqLh95hLtcaYA"></script>
<?php $this->stop('script') ?>


