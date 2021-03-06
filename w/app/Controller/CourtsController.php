<?php

namespace Controller;

use \W\Controller\Controller;
use Model\CourtsModel;
use Model\GamesModel;
use Model\ChatModel;
use Respect\Validation\Validator as v;
use Intervention\Image\ImageManagerStatic as Image;

class CourtsController extends Controller
{

    /**
	 * Page d'accueil par défaut, listant tous les terrains
	 * @return array findAll avec liste des terrains
	 */
    public function listAllCourts()
    {
        $model = new CourtsModel();
        $nbTotalArticles = $model->NumberOfCourts();
        //nbre d'articles par page
        $nbParPage = 5;
        //nbre de pages
        $nbPages = ceil($nbTotalArticles['nbArticles'] / $nbParPage);
        //on s'assure que le numéro de page envoyé est cohérent
        if(isset($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $nbPages AND ctype_digit($_GET['page'])){
            $page = htmlspecialchars($_GET['page']);
        }
        else{
            $page = 1;
        }

        //offset : là ou MySQL va commençer à récupérer les articles 
        $offset = ($page-1) * $nbParPage;

        $model = new CourtsModel();
        $findAll = $model->ListAllCourts($offset);

        $this->show('default/courts', ['findAll' => $findAll, 'page' => $page, 'nbPages' => $nbPages]);
    }

    /**
	* Moteur de recherche des terrains
	* @return 
	*
	*/
    public function searchCourts() {

        $data = [];
        $errors = [];

        // Si le formulaire est envoyé
        if(!empty($_GET)) {
            // Je me protège au niveau du GET
            $get = array_map('trim', array_map('strip_tags', $_GET));


            // On vérifie que le lieu a bien été renseigné. 
            if(!v::notEmpty()->length(2, null)->validate($get['searchWhere'])) {
                $errors[] = 'Le lieu ou le département doit être renseigné';
            } else {
                $data['city'] = $get['searchWhere'];
                $data['postal_code'] = $get['searchWhere'];
            }

            // if(!empty($get['year']) && !empty($get['month']) && !empty($get['day'])) { 
            // Si la date est renseignée 
            if(!empty($get['date'])) { 
                if(!v::date('Y-m-d')->validate($get['date'])){ 
                    $errors[] = 'Le format de la date est incorrect';
                }
            }

            // S'IL N'Y A PAS D'ERREUR 
            if(count($errors) === 0) {

                // Si l'utilisateur ne veut pas de filtre match 
                if($get['has_match'] == 'both') { 
                    $model = new CourtsModel();
                    $search = $model->search($data);
                    if(!empty($search)) {
                        $searchResult = true;
                    } else { 
                        $searchResult = false;
                    }
                } // S'il veut des matchs 
                elseif ($get['has_match'] == 'has_match') { 

                    $gamesModel = new GamesModel;
                    $getGames = $gamesModel->jointureCourtsGames($get['date']);
                    if(empty($getGames)) {
                        $searchResult = false;
                        $errors[] = 'Aucun match trouvé.';
                    } // Si il y a un résultat
                    else {
                        $searchResult = true;
                    }
                    // S'il ne veut pas de match 
                } elseif ($get['has_match'] == 'has_no_match') {
                    $has_match = false;
                    $gamesModel = new CourtsModel;                   
                    $getNoGames = $gamesModel->leftJoinCourtsGames($get['date']);
                    if(empty($getNoGames)) {
                        $searchResult = false;
                        $errors[] = 'Aucun match trouvé.';
                    } // Si il y a un résultat
                    else {
                        $searchResult = true;
                    }
                }


            } /// S'IL Y A DES ERREURS 
            else { 
                $showErrors = implode('<br>', $errors);
            }	

            $params = [ 
                'searchResults' => isset($searchResult) ? $searchResult : null,
                'showErrors' => isset($showErrors) ? $showErrors : null,
                'search' => isset($search) ? $search : null,
                'getGames' => isset($getGames) ? $getGames : null ,
                'getNoGames' =>isset($getNoGames) ? $getNoGames : null ,
            ];
            //echo '<pre>';
            //var_dump($params);
            //echo '</pre>',
            $this->show('default/courts', $params);

        } // Fin du if !empty GET
        else {
            $this->show('w_errors/403');			
        }
    } // Fin fonction searchCourts

    public function addCourts ()
    {
        $post = [];
        $errors = []; 

        if(!empty($_POST))
        {
            $post = array_map('trim', array_map('strip_tags', $_POST));

            // controle des paramètres
            if(mb_strlen($post['name'])<2)
            {
                $errors[] = 'Le nom du terrain doit être renseigné';
            }

            if(mb_strlen($post['description'])<10)
            {
                $errors[] = 'Le description doit comporter au moins 10 caractères';
            }

            if(empty($post['level']))
            {
                $errors[] = 'L\'état du terrain doit être choisi';
            }

            if(mb_strlen($post['address'])<2)
            {
                $errors[] = 'L\'adresse doit être renseigné';
            }

            if(empty($post['postal_code']) or is_int($post['postal_code']))
            {
                $errors[] = 'Le code postal doit être renseigné';
            }

            if(mb_strlen($post['city'])<2)
            {
                $errors[] = 'Le nom de la ville doit être renseigné';
            }

            if(empty($post['net']))
            {
                $errors[] = 'Le filet doit être défini';
            }

            // valeurs à entrer sans photo
            $data = [
                'name'          => $post['name'],
                'address'       => $post['address'],
                'postal_code'   => $post['postal_code'],
                'city'          => $post['city'],
                'description'   => $post['description'],
                'net'           => $post['net'],
                'court_state'   => $post['level'],
                'opening_hours' => $post['opening_hours'],
                'admin_validation'  => 0,
                'parking'       => $post['parking'],
                'latitude'      => isset($post['lat']) ? $post['lat'] : $errors[]='Vous devez vérifier l\'adresse',
                'longitude'     => isset($post['lng']) ? $post['lng'] : null,

            ];

            // Controle de la présence de photo
            if(isset($_FILES['picture']) && $_FILES['picture']['error']==0)
            {
                $maxfilesize = 5048576; //1 Mo

                if($_FILES['picture']['size'] < $maxfilesize){
                    //pas d'erreur et le fichier n'est pas trop volumineux
                    //on teste l'extension


                    $extensions_autorisees = array('jpg', 'jpeg', 'png', 'gif', 'PNG', 'JPEG', 'JPG', 'GIF');
                    $fileInfo = pathinfo($_FILES['picture']['name']);

                    $extension = strtolower($fileInfo['extension']);


                    if(in_array($extension, $extensions_autorisees)){
                        //extension valide
                        //on renomme le fichier
                        switch ($extension) {
                            case 'jpg':
                            case 'JPG':
                                $newImage = imagecreatefromjpeg($_FILES['picture']['tmp_name']);
                                break;
                            case 'jpeg':
                            case 'JPEG':
                                $newImage = imagecreatefromjpeg($_FILES['picture']['tmp_name']);
                                break;
                            case 'png':
                            case 'PNG':
                                $newImage = imagecreatefrompng($_FILES['picture']['tmp_name']);
                                break;
                            case 'gif':
                            case 'GIF':
                                $newImage = imagecreatefromgif($_FILES['picture']['tmp_name']);
                                break;
                        };


                        //largeur
                        $imageWidth = imagesx($newImage);
                        //hauteur
                        $imageHeight = imagesy($newImage);
                        // je décide de la largeur des miniatures
                        $newWidth = 200;
                        //on calcule la nouvelle hauteur
                        $newHeight = ($imageHeight * $newWidth) / $imageWidth ;
                        // on crée la nouvelle image 
                        $miniature = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($miniature, $newImage, 0, 0, 0, 0, $newWidth, $newHeight, $imageWidth, $imageHeight);


                        $picture = md5(uniqid(rand(), true));

                        if($extension == 'jpeg' OR $extension == 'jpg' OR $extension == 'JPEG' OR $extension == 'JPG'){  
                            $picture.='.'.$extension;
                            imagejpeg($miniature, '../public/assets/img/uploads/thumbnails/'.$picture);
                        } elseif($extension == 'png' OR $extension == 'PNG'){
                            $picture.='.'.$extension;
                            imagepng($miniature, '../public/assets/img/uploads/thumbnails/'.$picture);
                        } elseif($extension == 'gif' OR $extension == 'GIF'){
                            $picture.='.'.$extension;
                            imagegif($miniature, '../public/assets/img/uploads/thumbnails/'.$picture);
                        }

                        // téléchargement des photos et des miniatures
                        move_uploaded_file($_FILES['picture']['tmp_name'], '../public/assets/img/uploads/'.$picture);
                        // valeurs à rentrer avec photos
                        $data = [
                            'name'          => $post['name'],
                            'address'       => $post['address'],
                            'postal_code'   => $post['postal_code'],
                            'city'          => $post['city'],
                            'picture'       => $picture,
                            'description'   => $post['description'],
                            'net'           => $post['net'],
                            'court_state'   => $post['level'],
                            'opening_hours' => $post['opening_hours'],
                            'admin_validation'  => 0,
                            'parking'       => $post['parking'],
                            'latitude'      => isset($post['lat']) ? $post['lat'] : null,
                            'longitude'     => isset($post['lng']) ? $post['lng'] : null,

                        ];

                    }
                    else{//problème:
                        $errors[] = 'Une erreur de transfert est survenue !';

                    }
                }
                else{
                    $errors[] = 'Le fichier est trop gros !';	
                }
            }
            if(count($errors) === 0){
                $addCourt = new CourtsModel();
                $insert = $addCourt->insert($data);

                if($insert){
                    $json =[
                        'result' =>true,
                        'message' =>'Le terrain est soumis!',
                    ];

                }
            }
            else{
                $json =[
                    'result' =>false,
                    'errors'=>implode('<br>',$errors),
                ];
            }

            $this->showJson($json);
        }

    } // fin addcourts

    public function courtDetails($id) 
    { 	

        $model = new CourtsModel();
        $findCourt = $model->find($id);     

        $now = date('Y-m-d'); 


        $gamesModel = new GamesModel();
        $findGamesOnCourt = $gamesModel->showGamesOnThisCourt($id);

        foreach ($findGamesOnCourt as $date) {
            if(strtotime($now)> strtotime($date['date'])){

                $passedTime = new GamesModel();
                $DeleteGame = $passedTime -> deleteMatch($date['date']);
            }
        }

        $this->show('default/court_details', ['findCourt' => $findCourt, 'findGamesOnCourt' => $findGamesOnCourt, 'now' => $now, 'court_id' => $id] );

    }
    // FONCTIONS ADMIN

    public function validateCourts()
    {
        if(!isset($_SESSION) || empty($_SESSION) || $_SESSION['user']['role'] != 'admin'){         
            $this->show('w_errors/403');            
        }
        else {	

            if(isset($_POST['validez'])){

                $validation=[
                    'admin_validation'=> 1                
                ];
                $model = new CourtsModel();
                $update = $model->update($validation, $_POST['valeurId']);

                $this->flash('Le terrain a été validé', 'success');
            }

            if(isset($_POST['supprimez'])){
                $model =new CourtsModel();
                $delete = $model ->delete($_POST['valeurId']);

                $this->flash('Le terrain à été supprimé', 'success');
            }

            $model = new CourtsModel();
            $findAll = $model->findAll();

            $boucle = [
                'findAll' => $findAll
            ];

            $this->show('admin/courtsValidate', $boucle);
        }
    }

    /**
     * Liste de tous les terrains validés (pour l'admin)
     * Après une tentative de fonction unique avec paramètre dynamique pour différencier la page à afficher qui ne fonctionnait pas, cette fonction duplique celle ci-dessus.
     * @return array findAll avec liste des terrains
     */
    public function listCourtsAdmin()
    {
        if(!isset($_SESSION) || empty($_SESSION) || $_SESSION['user']['role'] != 'admin'){          
            $this->show('w_errors/403');            
        }
        else{
            $model = new CourtsModel();
            $findAll = $model->findAll();
            $this->show('admin/courts_list', ['findAll' => $findAll]);
        }
    }

    /**
     * Recherche des terrains pour l'admin
     * @return array findAll avec liste des terrains
     */  

    public function searchCourtsAdmin() { 

        if(!isset($_SESSION) || empty($_SESSION) || $_SESSION['user']['role'] != 'admin'){          
            $this->show('w_errors/403');            
        }
        else{
            $model = new CourtsModel();
            // Si le formulaire est envoyé
            if(!empty($_GET)) {

                // Je me protège au niveau du POST
                $get = array_map('trim', array_map('strip_tags', $_GET));

                // On vérifie que le lieu a bien été renseigné. 
                if(!empty($get['location'])) {
                    $data['city'] = $get['location'];
                    $data['postal_code'] = $get['location'];
                }

                if(!empty($get['name'])) { 
                    $data['name'] = $get['name'];
                }
                if(empty($data)) { 
                    $searchResult = false;
                }
                else {
                    $search = $model->search($data);
                    if(!empty($search)) { 
                        $searchResult = true;
                    } 
                    else { 
                        $searchResult = false;
                    }
                }

                $params = [   
                    'searchResults' => isset($searchResult) ? $searchResult : null,
                    'search' => isset($search) ? $search : null,
                ];

                $this->show('admin/courts_list', $params);





            } // Fin !empty get
        } 
    }

    public function modifyCourtAdmin() { 

        if(!isset($_SESSION) || empty($_SESSION) || $_SESSION['user']['role'] != 'admin'){          
            $this->show('w_errors/403');            
        }
        else{
            if(!empty($_POST)) {

                $post = array_map('trim', array_map('strip_tags', $_POST));
                if(isset($post['id'])) {
                    $courtId = (int) $post['id'];

                    // valeurs à updater sans photos
                    $data = [ 
                        'name' => $post['name'],
                        'address' => $post['address'],
                        'postal_code' => $post['postal_code'],
                        'city' => $post['city'],
                        'opening_hours' => $post['opening_hours'],
                        'description' => $post['description'],
                        'net' => isset($post['net']) ? $post['net'] : 0,
                        'court_state' => isset($post['court_state']) ? $post['court_state'] : 0,
                        'parking' => isset($post['parking']) ? $post['parking'] : 0,
                    ];

                    if(isset($_FILES['picture']) && $_FILES['picture']['error']==0){

                        $maxfilesize = 5048576; //1 Mo

                        if($_FILES['picture']['size'] < $maxfilesize){
                            //pas d'erreur et le fichier n'est pas trop volumineux
                            //on teste l'extension

                            $extensions_autorisees = array('jpg', 'jpeg', 'png', 'gif', 'PNG', 'JPEG', 'JPG', 'GIF');
                            $fileInfo = pathinfo($_FILES['picture']['name']);

                            $extension = strtolower($fileInfo['extension']);


                            if(in_array($extension, $extensions_autorisees)){
                                //extension valide
                                //on renomme le fichier
                                switch ($extension) {
                                    case 'jpg':
                                    case 'JPG':
                                        $newImage = imagecreatefromjpeg($_FILES['picture']['tmp_name']);
                                        break;
                                    case 'jpeg':
                                    case 'JPEG':
                                        $newImage = imagecreatefromjpeg($_FILES['picture']['tmp_name']);
                                        break;
                                    case 'png':
                                    case 'PNG':
                                        $newImage = imagecreatefrompng($_FILES['picture']['tmp_name']);
                                        break;
                                    case 'gif':
                                    case 'GIF':
                                        $newImage = imagecreatefromgif($_FILES['picture']['tmp_name']);
                                        break;
                                };
                                //largeur
                                $imageWidth = imagesx($newImage);
                                //hauteur
                                $imageHeight = imagesy($newImage);
                                // je décide de la largeur des miniatures
                                $newWidth = 200;
                                //on calcule la nouvelle hauteur
                                $newHeight = ($imageHeight * $newWidth) / $imageWidth ;
                                // on crée la nouvelle image 
                                $miniature = imagecreatetruecolor($newWidth, $newHeight);
                                imagecopyresampled($miniature, $newImage, 0, 0, 0, 0, $newWidth, $newHeight, $imageWidth, $imageHeight);

                                $picture = md5(uniqid(rand(), true));

                                if($extension == 'jpeg' OR $extension == 'jpg'){  
                                    $picture.='.'.$extension;
                                    imagejpeg($miniature, '../public/assets/img/uploads/thumbnails/'.$picture);
                                } elseif($extension == 'png'){
                                    $picture.='.'.$extension;
                                    imagepng($miniature, '../public/assets/img/uploads/thumbnails/'.$picture);
                                } elseif($extension == 'gif'){
                                    $picture.='.'.$extension;
                                    imagegif($miniature, '../public/assets/img/uploads/thumbnails/'.$picture);
                                }

                                unlink('../public/assets/img/uploads/'.$post['name_picture']);
                                unlink('../public/assets/img/uploads/thumbnails/'.$post['name_picture']);

                                move_uploaded_file($_FILES['picture']['tmp_name'], '../public/assets/img/uploads/'.$picture);
                                // valeurs à updater avec photos
                                $data = [
                                    'name'          => $post['name'],
                                    'address'       => $post['address'],
                                    'postal_code'   => $post['postal_code'],
                                    'city'          => $post['city'],
                                    'picture'       => $picture,
                                    'description'   => $post['description'],
                                    'net'           => $post['net'],
                                    'court_state'   => $post['level'],
                                    'opening_hours' => $post['opening_hours'],
                                    'parking'       => $post['parking'],

                                ];

                            }
                            else{//problème:
                                $errors[] = 'Une erreur de transfert est survenue !';

                            }

                        }
                        else{
                            $errors[] = 'Le fichier est trop gros !';

                        }
                    }   
                }
                $model = new CourtsModel();
                $gameAccepted = $model->update($data, $courtId);
            }
            $this->redirectToRoute('admin_getCourtsList', ['success' => ($this->flash('Le terrain a été modifié', 'success'))]);
        }
    }


    public function deleteCourtAdmin() { 

        if(!isset($_SESSION) || empty($_SESSION) || $_SESSION['user']['role'] != 'admin'){          
            $this->show('w_errors/403');            
        }
        else{
            if(!empty($_POST)) {

                $post = array_map('trim', array_map('strip_tags', $_POST));
                $courtId = (int) $post['id'];     
                $model = new CourtsModel();
                $gameAccepted = $model->delete($courtId);
                if($gameAccepted){
                    unlink('../public/assets/img/uploads/'.$post['picture']);
                    unlink('../public/assets/img/uploads/thumbnails/'.$post['picture']);
                }


            }
            $this->redirectToRoute('admin_getCourtsList', ['success' => ($this->flash('Le terrain a été supprimé', 'danger'))]);
        }
    }

}
