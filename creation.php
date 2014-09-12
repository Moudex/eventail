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
$annuler = false;
$modifier = false;
$evt = null;

$orig_template_path = $tpl->template_dir;
$tpl->template_dir = 'templates/' . $preferences->pref_theme;

// Sauvegarde un event cree ou modifie
if (array_key_exists('sauver', $_POST)) {
    $evt = new Event();
    if (isset($_POST['event_id']) and intval($_POST['event_id']) > 0) {
	$evt->setEvent_id($_POST['envent_id']);
    }
    $evt->setNom($_POST['nom']);
    $evt->setDateEvent($_POST['date']);
    $evt->setOuvertureInsc($_POST['ouvertureInsc']);
    $evt->setFermetureInsc($_POST['fermetureInsc']);
    $evt->setLieu($_POST['lieu']);
    $evt->setDescription($_POST['description']);
    $evt->setPrixParticipation($_POST['prix']);
    $evt->setNbPlaces($_POST['places']);
    $evt->store();
    $enregistrer = true;
}

// Annule
else if (array_key_exists('annuler', $_POST)) {
    // retourner home

    $annuler = true;
}

// modifier un event
else if (array_key_exists('modifier', $_POST)) {
    if(!(isset($_POST['event_id'] and intval($_POST['event_id']) > 0) {
	throw new Exception(_T("Id invalide"));
    }
    $evt = new Event(intval($_POST['event_id']));
    $modifier = true;
}
// Nouvel event
else {
    $evt = new Event();
    //$evt->setPrixParticipation(5);
    //$evt->setNbPlaces(100);
}

$tpl->assign('page_title', 'Fiche evenement');
$tpl->assign('event', $evt);

$tpl->assign('enregistre', $enregistrer);
$tpl->assign('annule', $annuler);
$tpl->assign('modifie', $modifier);

$content = $tpl->fetch('creation.tpl', EVENTAIL_PREFIX);
$tpl->assign('content', $content);
$tpl->template_dir = $orig_template_path;
$tpl->display('page.tpl', EVENTAIL_PREFIX);

?>
