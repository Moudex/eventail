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

</div>
