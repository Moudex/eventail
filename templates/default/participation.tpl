<form method="post" action="inscription_event.php?id_adh={$individu->individu_id}&event_id={$event->event_id}">
<div class="bigtable">
    <p>NB : Les champs obligatoires apparaissent en <span class="required">rouge</span></p>
    <p>{$event->nom}, {$event->prixParticipation}&euro;</p>
    <p>{$adh->nom_adh} {$adh->prenom_adh}</p>
    <fieldset class="cssform">
	<legend class="ui-state-active ui-corner-top">Informations</legend>
	<p>
	    <label for="paye" class="bline">Payé : </label>
	    <input type="checkbox" name="paye" id="paye" value="1">
	</p>
	<p>
	    <label for="commentaire" class="bline">Commentaire : </label>
	    <input type="text" name="commentaire" id="commentaire">
	</p>
    </fieldset>
</div>
    <div class="button-container">
	<input type="submit" id="participer" name="participer" value="participer">
    </div>
</form>
