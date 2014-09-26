<?php 

define('GALETTE_BASE_PATH', '../../');
require_once GALETTE_BASE_PATH . 'includes/galette.inc.php';

//Rejette les non-admin
if (!$login->isAdmin()) {
    header('location: ' . GALETTE_BASE_PATH . 'index.php');
    die();
}

require_once '_config.inc.php';

if (array_key_exists('supprimer', $_POST) && array_key_exists('event_id', $_GET) && array_key_exists('id_adh', $_GET)) {
    $participation = new Participe($_GET['id_adh'], $_GET['event_id']);
    $participation->erease();
    header('location: voir_event.php?event_id=' . $_GET['event_id']);
}
else if (array_key_exists('event_id', $_GET) && array_key_exists('id_adh', $_GET)) {
    $orig_template_path = $tpl->template_dir;
    $tpl->template_dir = 'templates/' . $preferences->pref_theme;
    $tpl->assign('page_title', 'Supression participation');
    $tpl->assign('event', new Event($_GET['event_id']));
    $tpl->assign('adherent', Individu::get_adh($_GET['id_adh']));
    $content = $tpl->fetch('supp_participant.tpl', EVENTAIL_PREFIX);
    $tpl->assign('content', $content);
    $tpl->template_dir = $orig_template_path;
    $tpl->display('page.tpl', EVENTAIL_PREFIX);
}
else {
    header('location: ' . GALETTE_BASE_PATH . 'index.php');
    die();
}

?>
