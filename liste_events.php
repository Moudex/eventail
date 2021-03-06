<?php

define('GALETTE_BASE_PATH', '../../');
require_once GALETTE_BASE_PATH . 'includes/galette.inc.php';
if (!$login->isLogged() || !$login->isAdmin()) {
    header('location: ' . GALETTE_BASE_PATH . 'index.php');
    die();
}

require_once '_config.inc.php';

$tri = array_key_exists('tri', $_GET) ? $_GET['tri'] : 'dateEvent';
$direction = array_key_exists('direction', $_GET) ? $_GET['direction'] : 'asc';
$page = array_key_exists('page', $_GET) ? $_GET['page'] : 1;

$liste_events = Event::getNextEvents($tri, $direction, $page, $preferences->pref_numrows);
//$nb_events = Event::getNbNextEvents();
$tpl->assign('page_title', 'Liste des evenements');
$orig_template_path = $tpl->template_dir;
$tpl->template_dir = 'templates/' . $preferences->pref_theme;

$tpl->assign('liste_events', $liste_events);
if (array_key_exists('id_adh', $_GET) && $login->isAdmin()) {
    $tpl->assign('id_adh', $_GET['id_adh']);
} else {
    $tpl->assign('id_adh', $login->id);
}
if($login->isAdmin()){
    $tpl->assign('admin', true);
}else {
    $tpl->assign('admin', false);
}
$tpl->assign('tri', $tri);
$tpl->assign('direction', $direction);
$tpl->assign('page', $page);
$content = $tpl->fetch('liste_events.tpl', EVENTAIL_PREFIX);
$tpl->assign('content', $content);
$tpl->template_dir = $orig_template_path;
$tpl->display('page.tpl', EVENTAIL_PREFIX);
?>
