<?php

define('GALETTE_BASE_PATH', '../../');
require_once GALETTE_BASE_PATH . 'includes/galette.inc.php';
if (!$login->isLogged() || !$login->isAdmin()) {
    header('location: ' . GALETTE_BASE_PATH . 'index.php');
    die();
}

require_once '_config.inc.php';

$tri = array_key_exists('tri', $_GET) ? $_GET['tri'] : 'date';
$direction = array_key_exists('direction', $_GET) ? $_GET['direction'] : 'asc';
$page = array_key_exists('page', $_GET['page'] : 1;

$liste_events = Event::getNextEvents($tri, $direction, $page);

$tpl->assign('page_title', 'Liste des evenements');
$orig_template_path = $tpl->template_dir;
$tpl->template_dir = 'templates/' . $preferences->pref_theme;


$content = $tpl->fetch('liste_events.tpl', EVENTAIL_PREFIX);
$tpl->assign('content', $content);
$tpl->template_dir = $orig_template_path;
$tpl->display('page.tpl', EVENTAIL_PREFIX);
?>