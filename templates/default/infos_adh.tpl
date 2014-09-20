<form method="post" action="inscription_event.php?id_adh={$id_adh}&event_id={$event_id}">
<div class="bigtable">
    <p>NB : Les champs obligatoires apparaissent en <span class="required">rouge</span></p>
    <p>C'est votre première inscription à un événement, vous devez entrer des informations supplémentaires</p>
    <fieldset class="cssform">
	<legend class="ui-state-active ui-corner-top">Régime alimentaire</legend>
	<p>
	    <label for="alcool" class="bline">Alcool : </label>
	    <input name="alcool" id="alcool" type="checkbox" value="1" checked>
	</p>
	<p>
	    <label for="viande" class="bline">Viande : </label>
	    <input name="viande" id="viande" type="checkbox" value="1" checked>
	</p>
	<p>
	    <label for="hallal" class="bline">Hallal : </label>
	    <input type="checkbox" name="hallal" id="hallal" value="1">
	</p>
    </fieldset>
    <fieldset class="cssform">
	<legend class="ui-state-active ui-corner-top">Transport</legend>
	<p>
	    <label for="voiture" class="bline">Voiture : </label>
	    <input type="checkbox" name="voiture" id="voiture" value="1">
	</p>
	<p>
	    <label for="velo" class="bline">Vélo : </label>
	    <input type="checkbox" name="velo" id="velo" value="1">
	</p>
    </fieldset>
    <fieldset class="cssform">
	<legend class="ui-state-active ui-corner-top">Autre</legend>
	<p>
	    <label for="commentaire" class="bline">Commentaire : </label>
	    <textarea rows="4" cols="50" name="commentaire" id="commentaire"></textarea>
	</p>
    </fieldset>
</div>
<div class="button-container">
    <input type="submit" id="sauver" name="sauver" value="sauver">
</div>
</form>
