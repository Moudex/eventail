{if $enregistre}
<div id="infobox">
    <h1>Evenement enregistre</h1>
</div>
{/if}
{if $annule}
<div id="warningbox">
    <h1>Modifications annule</h1>
</div>
{/if}

<form method="post" action="creation.php">
    <div class="bigtable">
	<p>NB : Les champs obligatoires apparaissent en <span class="required">rouge</span></p>
	<fieldset class="cssform">
	    <legend class="ui-state-active ui-corner-top">Informations</legend>
	    <p>
		<label for="nom" class="bline">Nom : </label>
		<input type="text" name="nom" id="nom" value="{$event->getNom()}" required>
	    </p>
	    <p>
		<label for="text" class="bline">Date : </label>
		<input type="datetime" name="date" id="date" maxlength="10" value="{$event->getDateEvent()}" required> <span class="exemple">(format jj/mm/aaaa)</span>
	    </p>
	    <p>
		<label for="ouvertureInsc" class="bline">Ouverture des inscriptions : </label>
		<input type="text" name="ouvertureInsc" id="ouvertureInsc" value="{$event->getOuvertureInsc()}" maxlength="10" /> <span class="exemple">(format jj/mm/aaaa)</span>
	    </p>
	    <p>
		<label for="fermetureInsc" class="bline">Fermeture des inscriptions : </label>
		<input type="date" name="fermetureInsc" id="fermetureInsc" value="{$event->getFermetureInsc()}" maxlength="10" /> <span class="exemple">(format jj/mm/aaaa)</span>
	    </p>
	    <p>
		<label for="lieu" class="bline">Lieu : </label>
		<input type="text" name="lieu" id="lieu" value="{$event->getLieu()}" />
	    </p>
	    <p>
		<label for="description" class="bline">Description : </label>
		<textarea rows="4" cols="50" name="description" id="description">{$event->getDescription()}</textarea>
	    </p>
	    <p>
		<label for="prix" class="bline">Prix de participation : </label>
		<input type="number" value="{$event->getPrixParticipation()}"  min="0" size="3" /> <span class="exemple">&euro;</span>
	    </p>
	    <p>
		<label for="places" class="bline">Nombre de places disponibles : </label>
		<input type="number" value="{$event->getNbPlaces()}" min="1" size="4" />
	    </p>
	</fieldset>
    </div>
    <div class="button-container">
	<input type="submit" id="sauver" name="sauver" value="sauver">
	<input type="submit" id="annuler" name="annuler" value="annuler">
    </div>
</form>

<script type="text/javascript">
$(function() {ldelim}
    $('#ouvertureInsc').datepicker({ldelim}
	changeMonth: true,
	changeYear: true,
	showOn: 'both',
	buttonImage: '{$template_subdir}images/calendar.png',
	buttonImageOnly: true,
	maxDate: '-0d',
	yearRange: 'c-5'
    {rdelim});
{rdelim});
</script>
