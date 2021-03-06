<?php

define('GALETTE_BASE_PATH', '../../');
require_once GALETTE_BASE_PATH . 'includes/galette.inc.php';
require_once '_config.inc.php';

if (!$login->isLogged()) {
    header('location: ' . GALETTE_BASE_PATH . 'index.php');
    die();
}

// demande de participation d'un membre connecté ou d'un membre ajouté par un admin
else if (array_key_exists('id_adh', $_GET) && array_key_exists('event_id', $_GET)) {
    
    // si un non-admin inscrit un autre membre
    if ($login->id != $_GET['id_adh'] && !$login->isAdmin()){
	// permission non accordée
	header('location: ' . GALETTE_BASE_PATH . 'index.php');
	die();
    }

    if (array_key_exists('participer', $_POST)) {
	// Individu
	$individu = new Individu();
	$individu->individu_id = $_GET['id_adh'];
	$individu->alcool = $_POST['alcool'] == 1 ? 1 : 0;
	$individu->viande = $_POST['viande'] == 1 ? 1 : 0;
	$individu->hallal = $_POST['hallal'] == 1 ? 1 : 0;
	$individu->voiture = $_POST['voiture'] == 1 ? 1 : 0;
	$individu->velo = $_POST['velo'] == 1 ? 1 : 0;
	//$individu->commentaire = $_POST['commentaire'];
	if (!$individu->store()) {
	    header('location: ' . GALETTE_BASE_PATH . 'index.php');
	    die();
	}

	// Participation
	$participation = new Participe();
	$participation->paye = $_POST['paye'] == 1 ? 1 : 0;
	if ($_POST['paye'] == 1) {
	    $participation->datePaye = DateHeure::nowIHM();
	}
	$participation->event_id = $_GET['event_id'];
	$participation->individu_id = $_GET['id_adh'];
	//$participation->commentaire = $_POST['commentaire'];
	if ($participation->store()) {
	    header('location: voir_event.php?event_id=' . $_GET['event_id']);
	}
    }
    else {
	// formulaire participation
	$orig_template_path = $tpl->template_dir;
	$tpl->template_dir = 'templates/' . $preferences->pref_theme;
	$tpl->assign('page_title', 'Participation événement');
	$tpl->assign('event', new Event($_GET['event_id']));
	
	if (Individu::exists($_GET['id_adh'])) {
	    $tpl->assign('individu', new Individu($_GET['id_adh']));
	    $tpl->assign('editI', true);
	} else {
	    $individu = new Individu();
	    $individu->individu_id = $_GET['id_adh'];
	    $tpl->assign('individu', $individu);
	    $tpl->assign('editI', false);
	}

	if (Participe::exists($_GET['id_adh'], $_GET['event_id'])) {
	    $tpl->assign('participe', new Participe($_GET['id_adh'], $_GET['event_id']));
	    $tpl->assign('editP', true);
	} else {
	    $tpl->assign('editP', false);
	}

	//$tpl->assign('adh', new Adherent(intval($_GET['id_adh'])));
	$content = $tpl->fetch('participation.tpl', EVENTAIL_PREFIX);
	$tpl->assign('content', $content);
	$tpl->template_dir = $orig_template_path;
	$tpl->display('page.tpl', EVENTAIL_PREFIX);	
    }

}

// lister les evenements
else if (array_key_exists('id_adh', $_GET)) {
    // si un non-admin inscrit un autre membre
    if ($login->id != $_GET['id_adh'] && !$login->isAdmin()){
	// permission non accordée
	header('location: ' . GALETTE_BASE_PATH . 'index.php');
	die();
    }
    header('location: liste_events.php?id_adh=' . $_GET['id_adh']); 

}


/*
// uniquement pour admin, template pour selectionner le membre
else if (array_key_exists('event_id', $_GET) && $login->isAdmin()) {
    $tpl->assign('page_title', 'Inscription à un événement');
    $orig_template_path = $tpl->template_dir;
    $tpl->template_dir = 'templates/' . $preferences->pref_theme;
    $content = $tpl->fetch('inscription_event.tpl', EVENTAIL_PREFIX);
    $tpl->assign('content', $content);
    $tpl->template_dir = $orig_template_path;
    $tpl->display('page.tpl', EVENTAIL_PREFIX);
}
//*/

else {
    header('location: ' . GALETTE_BASE_PATH . 'gestion_adherents.php');
    die();
}
?>
