<?php 

define('GALETTE_BASE_PATH', '../../');
require_once GALETTE_BASE_PATH . 'includes/galette.inc.php';

//Rejette les non-admin
if (!$login->isAdmin()) {
    header('location: ' . GALETTE_BASE_PATH . 'index.php');
    die();
}

require_once 'classes/event.class.php';

if (isset($_POST['date'])) {
    // enregistrer en bdd
}
else {
    // afficher template formulaire

    $tpl->display('creation.tpl');
}


?>
