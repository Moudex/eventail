{* Titre du bloc *}
<h1 class="nojs">Evenements</h1>
{* Entrées du menu *}
<ul>
{if $login->isAdmin()}
    <li{if $PAGENAME eq "creation.php"} class="selected"{/if}><a href="{$galette_base_path}{$eventail_dir}creation.php">Ajouter un événement</a></li>
    <li{if $PAGENAME eq "liste_events.php"} class="selected"{/if}><a href="{$galette_base_path}{$eventail_dir}liste_events.php">Liste des événements</a></li>
{/if}
</ul>
