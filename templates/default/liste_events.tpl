<table class="listing">
    <thead>
	<tr>
	    <th><a href="?tri=nom&direction={if $tri eq 'nom' && $direction eq 'asc'}desc{else}asc{/if}">Nom</a>{if $tri eq 'nom' && $direction eq 'asc'} <img src="{$template_subdir}image/down.png">{elseif $tri eq 'nom' && $direction eq 'desc'} <img src="{$template_subdir}image/up.png">{/if}</th>
	    <th><a href="?tri=lieu&direction={if $tri eq 'nom' && $direction eq 'asc'}desc{else}asc{/if}">Lieu</a>{if $tri eq 'lieu' && $direction eq 'asc'} <img src="{$template_subdir}image/down.png">{elseif $tri eq 'lieu' && $direction eq 'desc'} <img src="{$template_subdir}image/up.png">{/if}</th>
	    <th><a href="?tri=prixParticipation&direction={if $tri eq 'prixParticipation' && $direction eq 'asc'}desc{else}asc{/if}">Prix</a>{if $tri eq 'prixParticipation' && $direction eq 'asc'} <img src="{$template_subdir}image/down.png">{elseif $tri eq 'prixParticipation' && $direction eq 'desc'} <img src="{$template_subdir}image/up.png">{/if}</th>
	    <th><a href="?tri=dateEvent&direction={if $tri eq 'dateEvent' && $direction eq 'asc'}desc{else}asc{/if}">Date</a>{if $tri eq 'dateEvent' && $direction eq 'asc'} <img src="{$template_subdir}image/down.png">{elseif $tri eq 'dateEvent' && $direction eq 'desc'} <img src)"{$template_subdir}image/up.png">{/if}</th>
	    <th class="actions_row">Actions</th>
	</tr>
    </thead>
    <tbody>
    {foreach from=$liste_events item=event}
	<tr>
	    <td><a href="./voir_event.php?event_id={$event->event_id}">{$event->nom}</a></td>
	    <td>{$event->lieu}</td>
	    <td>{if $event->prixParticipation eq 0}Gratuit{else}{$event->prixParticipation}&euro;{/if}</td>
	    <td>{$event->dateEvent}</td>
	    <td class="actions_row">
		<a href="inscription_event.php?id_adh={$id_adh}&event_id={$event->event_id}">
		    <img src="templates/default/images/icon-event.png" alt="InscriptionEvent" width="16" height="16" />
		</a>
		{if $admin}
		<a href="creation.php?event_id={$event->event_id}">
		    <img src="{$template_subdir}images/icon-edit.png" alt="edit" width="16" height="16" />
		</a>
		{/if}
	    </td>
	</tr>
    {/foreach}
    </tbody>
</table>
