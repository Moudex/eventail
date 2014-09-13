<table class="listing">
    <thead>
	<tr>
	    <th><a href="?tri=nom&direction={if $tri eq 'nom' && $direction eq 'asc'}desc{else}asc{/if}">Nom</a>{if $tri eq 'nom' && $direction eq 'asc'} <img src="{$template_subdir}image/down.png">{elseif $tri eq 'nom' && $direction eq 'desc'} <img src="{$template_subdir}image/up.png">{/if}</th>
	    <th><a href="?tri=lieu&direction={if $tri eq 'nom' && $direction eq 'asc'}desc{else}asc{/if}">Lieu</a>{if $tri eq 'lieu' && $direction eq 'asc'} <img src="{$template_subdir}image/down.png">{elseif $tri eq 'lieu' && $direction eq 'desc'} <img src="{$template_subdir}image/up.png">{/if}</th>
	    <th><a href="?tri=prix&direction={if $tri eq 'prix' && $direction eq 'asc'}desc{else}asc{/if}">Prix</a>{if $tri eq 'prix' && $direction eq 'asc'} <img src="{$template_subdir}image/down.png">{elseif $tri eq 'prix' && $direction eq 'desc'} <img src="{$template_subdir}image/up.png">{/if}</th>
	    <th><a href="?tri=date&direction={if $tri eq 'date' && $direction eq 'asc'}desc{else}asc{/if}">Date</a>{if $tri eq 'date' && $direction eq 'asc'} <img src="{$template_subdir}image/down.png">{elseif $tri eq 'date' && $direction eq 'desc'} <img src)"{$template_subdir}image/up.png">{/if}</th>
	</tr>
    </thead>
    <tbody>
    {foreach from=$liste_events item=event}
	<tr>
	    <td>{$event->nom}</td>
	    <td>{$event->lieu}</td>
	    <td>{$event->prix}</td>
	    <td>{$event->date}</td>
	</tr>
    {/foreach}
    </tbody>
</table>
