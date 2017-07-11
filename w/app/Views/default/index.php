<?=$this->layout('layout', ['title' => 'Accueil']); ?>

<?php $this->start('header_content') ?>

<style> 
    .intro-header
    { 
        background-image: url(<?= $this->assetUrl('img/sport-ground.jpg')?>) 
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
                        <input id="submit" type="button"  value="Rechercher" class="btn btn-warning btn-lg button-search-index">
                        <!--                        <button id="submit" type="submit" class="btn btn-warning btn-lg button-search-index">Rechercher</button>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->stop('header_content') ?>

<?php $this->start('main_content') ?>

<div class="container-fluid div-map">
    <div class="row">
        <div class="col-lg-12">
            <div id="map-index"></div>
            <form method="POST" id="search-terrain">
                <input type="hidden" value="" id="lat" name="lat">
                <input type="hidden" value="" id="lng" name="lng">
                <button type="submit" class="btn btn-warning button-search-terrain">Afficher les terrains pres de soi</button>
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
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.

    function initMap() 
    {

        var map = new google.maps.Map(document.getElementById('map-index'), {
            zoom: 13,
            center: {lat: 47.066322, lng: 2.761099}
        });
        var infoWindow = new google.maps.InfoWindow({map: map});


        // Try HTML5 geolocation.
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {


                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                var lat =  position.coords.latitude;
                $('#lat').attr('value', lat);

                var lng =  position.coords.longitude;
                $('#lng').attr('value', lng);


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
                                ['<?php echo $donnees['name'] ?>', <?php echo $donnees['latitude'] ?>, <?php echo $donnees['longitude'] ?>, 0, '<?=$this->url('court_details', ['id' => $donnees['id']])?>'],
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

                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(locations[i][0]);
                            infowindow.open(map, marker);
                            window.location.href = this.url;
                        }
                    })(marker, i));

                }


            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }


        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
            geocodeAddress(geocoder, map); 
        });

        function geocodeAddress(geocoder, resultsMap) 
        {
            var address = document.getElementById('address').value;
            geocoder.geocode({'address': address}, function(results, status) {
                if (status === 'OK') {
                    resultsMap.setCenter(results[0].geometry.location);
                    //                    var marker = new google.maps.Marker({
                    //                        center: resultsMap,
                    //                        map: resultsMap,
                    //                        position: results[0].geometry.location
                    //                    });


                    infoWindow.setPosition(results[0].geometry.location);
                    infoWindow.setContent('Vous êtes là');
                    resultsMap.setCenter(results[0].geometry.location);

                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });   
        }

    }






    function handleLocationError(browserHasGeolocation, infoWindow, pos) 
    {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
          'Error: The Geolocation service failed.' :
          'Error: Your browser doesn\'t support geolocation.');
    }


</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0xJoi5c9MwYIYQlwIEfLqLh95hLtcaYA&callback=initMap"></script>

<?php $this->stop('script') ?>


