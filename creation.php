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
    $evt->setNom($_POST['nom']);
    $evt->setDateEvent($_POST['date']);
    $evt->setOuvertureInsc($_POST['ouvertureInsc']);
    $evt->setFermetureInsc($_POST['fermetureInsc']);
    $evt->setLieu($_POST['lieu']);
    $evt->setDescription($_POST['description']);
    $evt->setPrixParticipation($_POST['prix']);
    $evt->setNbPlaces($_POST['places']);
    $evt->store();
    header('Location: liste_events.php');
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
