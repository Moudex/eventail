<table class="listing">
    <thead>
	<tr>
	    <th><a href="?tri=nom&direction={if $tri eq 'nom' && $direction eq 'asc'}desc{else}asc{/if}">Nom</a>{if $tri eq 'nom' && $direction eq 'asc'} <img src="{$template_subdir}image/down.png">{elseif $tri eq 'nom' && $direction eq 'desc'} <img src="{$template_subdir}image/up.png">{/if}</th>
	    <th><a href="?tri=lieu&direction={if $tri eq 'nom' && $direction eq 'asc'}desc{else}asc{/if}">Lieu</a>{if $tri eq 'lieu' && $direction eq 'asc'} <img src="{$template_subdir}image/down.png">{elseif $tri eq 'lieu' && $direction eq 'desc'} <img src="{$template_subdir}image/up.png">{/if}</th>
	    <th><a href="?tri=prixParticipation&direction={if $tri eq 'prixParticipation' && $direction eq 'asc'}desc{else}asc{/if}">Prix</a>{if $tri eq 'prixParticipation' && $direction eq 'asc'} <img src="{$template_subdir}image/down.png">{elseif $tri eq 'prixParticipation' && $direction eq 'desc'} <img src="{$template_subdir}image/up.png">{/if}</th>
	    <th><a href="?tri=dateEvent&direction={if $tri eq 'dateEvent' && $direction eq 'asc'}desc{else}asc{/if}">Date</a>{if $tri eq 'dateEvent' && $direction eq 'asc'} <img src="{$template_subdir}image/down.png">{elseif $tri eq 'dateEvent' && $direction eq 'desc'} <img src)"{$template_subdir}image/up.png">{/if}</th>
	</tr>
    </thead>
    <tbody>
    {foreach from=$liste_events item=event}
	<tr>
	    <td>{$event->nom}</td>
	    <td>{$event->lieu}</td>
	    <td>{$event->prixParticipation}&euro;</td>
	    <td>{$event->dateEvent}</td>
	</tr>
    {/foreach}
    </tbody>
</table>
