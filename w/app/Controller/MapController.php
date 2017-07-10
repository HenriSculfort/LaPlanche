<?php

namespace Controller;

use \W\Controller\Controller;
use Model\CourtsModel;
// Introduce the class into your scope
use KamranAhmed\Geocode\Geocode;

class MapController extends Controller
{


    public function map()
    {
        $post = [];
        $postal_code = [];
        $location = [] ;
        $donnee = [] ;

        if(!empty($_POST))
        {
            // $_POST est une superglobale => par default elle est FORCEMENT définit dans PHP
            // Si la superglobale n'est pas vide, quelqu'un à envoyé le formulaire POST 
            foreach($_POST as $key => $value)
            {
                $post[$key] = trim(strip_tags($value));
            }

            if(isset($post['lat']) and isset($post['lat']))
            {
                $geocode = new Geocode();

                // Get the details for the passed address
                $location = $geocode->get($post['lat'].' '.$post['lng']);
                // Note: All the functions below accept a parameter as a default value that will be return if the reuqired value isn't found
                $location->getAddress( 'default value' ); 
                $location->getLatitude(); // returns the latitude of the address
                $location->getLongitude(); // returns the longitude of the address
                $location->getCountry(); // returns the country of the address
                $location->getLocality(); // returns the locality/city of the address
                $location->getDistrict(); // returns the district of the address
                $postal_code = $location->getPostcode(); // returns the postal code of the address in $postal_code
                $location->getTown(); // returns the town of the address
                $location->getStreetNumber(); // returns the street number of the address

                $CourtsModel = new CourtsModel;
                $donnee = $CourtsModel->findLatLng($postal_code);
            }
        }
        $this->show('default/index', ['postal_code' => $postal_code , 'location' => $location , 'donnee' => $donnee]);
    }
}