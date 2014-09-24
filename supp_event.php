<?php 

define('GALETTE_BASE_PATH', '../../');
require_once GALETTE_BASE_PATH . 'includes/galette.inc.php';

//Rejette les non-admin
if (!$login->isAdmin()) {
    header('location: ' . GALETTE_BASE_PATH . 'index.php');
    die();
}

require_once '_config.inc.php';

if (array_key_exists('supprimer', $_POST) && array_key_exists('event_id', $_GET)) {
    $evt = new Event($_GET['event_id']);
    $evt->erease();
    header('location: liste_events.php');
}
else if (array_key_exists('event_id', $_GET)) {
    $orig_template_path = $tpl->template_dir;
    $tpl->template_dir = 'templates/' . $preferences->pref_theme;
    $tpl->assign('page_title', 'Supression evenement');
    $evt = new Event($_GET['event_id']);
    $tpl->assign('event', $evt);
    $content = $tpl->fetch('supp_event.tpl', EVENTAIL_PREFIX);
    $tpl->assign('content', $content);
    $tpl->template_dir = $orig_template_path;
    $tpl->display('page.tpl', EVENTAIL_PREFIX);
}
else {
    header('location: ' . GALETTE_BASE_PATH . 'index.php');
    die();
}

?>
