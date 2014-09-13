<?php 

define('GALETTE_BASE_PATH', '../../');
require_once GALETTE_BASE_PATH . 'includes/galette.inc.php';

//Rejette les non-admin
if (!$login->isAdmin()) {
    header('location: ' . GALETTE_BASE_PATH . 'index.php');
    die();
}

require_once '_config.inc.php';

$enregistrer = false;

if (array_key_exists('sauver', $_POST)) {
    // enregistrer en bdd
    $evt = new Event();
    $evt->nom = $_POST['nom'];
    $evt->dateEvent = $_POST['date'];
    $evt->ouvertureInsc = $_POST['ouvertureInsc'];
    $evt->fermetureInsc = $_POST['fermetureInsc'];
    $evt->lieu = $_POST['lieu'];
    $evt->description = $_POST['description'];
    $evt->prixParticipation = $_POST['prix'];
    $evt->nbPlaces = $_POST['places'];
    if($evt->store()){
	header('Location: liste_events.php');
    }
}
else {
    $orig_template_path = $tpl->template_dir;
    $tpl->template_dir = 'templates/' . $preferences->pref_theme;

    // assign
    $tpl->assign('page_title', 'Fiche evenement (creation)');
    
    $content = $tpl->fetch('creation.tpl', EVENTAIL_PREFIX);
    $tpl->assign('content', $content);
    $tpl->template_dir = $orig_template_path;
    $tpl->display('page.tpl', EVENTAIL_PREFIX);
}


?>
