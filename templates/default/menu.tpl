{* Titre du bloc *}
<h1 class="nojs">{_T string="Evenement"}</h1>
{* Entrées du menu *}
<ul>
{if $login->isAdmin()}
    <li>{_T string="Creer un evenement"}</li>
    <li>{_T string="Liste des evenements"}</li>
{/if}
</ul>
