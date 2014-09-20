<?php 

define('GALETTE_BASE_PATH', '../../');
require_once GALETTE_BASE_PATH . 'includes/galette.inc.php';
if (!$login->isLogged()) {
    header('location: ' . GALETTE_BASE_PATH . 'index.php');
    die();
}

$admin = 0;
if ($login->isAdmin()){
    $admin = 1;
}

require_once '_config.inc.php';

$tpl->assign('page_title', 'Fiche evenement');
$orig_template_path = $tpl->template_dir;
$tpl->template_dir = 'templates/' . $preferences->pref_theme;

$event = null;

if (array_key_exists('event_id', $_GET)) {
    $event = new Event(intval($_GET['event_id']));
}
else {
    header('location: ' . 'liste_events.php');
    die();
}

$tpl->assign('event', $event);
$tpl->assign('admin', $admin);

$content = $tpl->fetch('voir_event.tpl', EVENTAIL_PREFIX);
$tpl->assign('content', $content);
$tpl->template_dir = $orig_template_path;
$tpl->display('page.tpl', EVENTAIL_PREFIX);

?>
