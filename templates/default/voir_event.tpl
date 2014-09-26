<nav>
</nav>
<ul id="details_menu">
    {if $admin}
    <li>
	<a class="button" href="creation.php?event_id={$event->event_id}" id="btn_edit">Modification</a>
    </li>
    <li>
	<a class="button" href="supp_event.php?event_id={$event->event_id}">
		    <img src="{$template_subdir}images/delete.png" alt="delete" width="16" height="16" />
	    Supprimer
	</a>
    </li>
    {/if}

</ul>

<div class="bigtable wrmenu">
    <table class="details">
	<caption class="ui-state-active ui-corner-top">Informations :</caption>
	<tr>
	    <th>Nom :</th>
	    <td>{$event->nom}</td>
	</tr>
	<tr>
	    <th>Date :</th>
	    <td>{$event->dateEvent}</td>
	</tr>
	<tr>
	    <th>Clôture des inscriptions :</th>
	    <td>{$event->fermetureInsc}</td>
	</tr>
	<tr>
	    <th>Lieu :</th>
	    <td>{$event->lieu}</td>
	</tr>
	<tr>
	    <th>Participation :</th>
	    <td>{if $event->prixParticipation eq 0}Gratuit{else}{$event->prixParticipation}&euro;{/if}</td>
	</tr>
	<tr>
	    <th>Description :</th>
	    <td>{$event->description}</td>
	</tr>
    </table>
    {if $admin}
    <table class="listing">
	<caption class="ui-state-active ui-corner-top">Participants :</caption>
	<tr>
	    <th>#</th>
	    <th>Nom</th>
	    <th>Prenom</th>
	    <th>Tel.</th>
	    <th>Insc.</th>
	    <th>Régime</th>
	    <th>Commentaire</th>
	    <th>Action</th>
	</tr>
	<!-- {counter start=0 skip=1} -->
	{foreach from=$participants item=participant}
	<tr>
	    <td>{counter}</td>
	    <td>{$participant->nom_adh}</td>
	    <td>{$participant->prenom_adh}</td>
	    <td>{if $participant->tel_adh eq ''}{$participant->gsm_adh}{else}{$participant->tel_adh}{/if}</td>
	    <td>{$participant->datePaye}</td>
	    <td>{if $participant->alcool}alcool,{else}sodas,{/if} {if $participant->viande}viande{elseif $participant->hallal}hallal{else}végératien{/if}</td>
	    <td>{if $participant->voiture}voiture{/if}</td>
	    <td class="action_row">
		<a href="inscription_event.php?id_adh={$participant->id_adh}&event_id={$event->event_id}"><img src="{$template_subdir}images/icon-edit.png" alt="edit" width="16" height="16"/></a>
		<a href="supp_participant.php?id_adh={$participant->id_adh}&event_id={$event->event_id}"><img src="{$template_subdir}images/icon-trash.png" alt="delete" width="16" height="16" /></a>
	    </td>
	</tr>
	{foreachelse}
	<tr>
	    <td colspan="8" style="text-align: center">Aucun inscrit</td>
	</tr>
	{/foreach}
    </table>

    {/if}
</div>
