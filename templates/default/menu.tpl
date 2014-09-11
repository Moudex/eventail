{* Titre du bloc *}
<h1 class="nojs">{_T string="MENU.TITRE SECTION"}</h1>
{* Entrées du menu *}
<ul>
{if $login->isAdmin()}
    <li{if $PAGENAME eq "creation.php"} class="selected"{/if}><a href="{$galette_base_path}{$eventail_dir}creation.php">{_T string="MENU.CREATION"}</a></li>
    <li>{_T string="Liste des evenements"}</li>
{/if}
</ul>
