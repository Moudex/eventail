<?php 

define('GALETTE_BASE_PATH', '../../');
require_once GALETTE_BASE_PATH . 'includes/galette.inc.php';

//Rejette les non-admin
if (!$login->isAdmin()) {
    header('location: ' . GALETTE_BASE_PATH . 'index.php');
    die();
}

require_once '_config.inc.php';

if (isset($_POST['date'])) {
    // enregistrer en bdd
}
else {
    // afficher template formulaire
    $orig_template_path = $tpl->template_dir;
    $tpl->template_dir = 'templates/' . $preferences->pref_theme;

    // assign
    
    $content = $tpl->fetch('creation.tpl', EVENTAIL_PREFIX);
    $tpl->assign('content', $content);
    $tpl->template_dir = $orig_template_path;
    $tpl->display('page.tpl', EVENTAIL_PREFIX);
}


?>
