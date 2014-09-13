<form method="post" action="creation.php">
    <div class="bigtable">
	<p>NB : Les champs obligatoires apparaissent en <span class="required">rouge</span></p>
	<fieldset class="cssform">
	    <legend class="ui-state-active ui-corner-top">Informations</legend>
	    <p>
		<label for="nom" class="bline">Nom : </label>
		<input type="text" name="nom" id="nom" required>
	    </p>
	    <p>
		<label for="date" class="bline">Date : </label>
		<input type="text" name="date" id="date" value="" maxlength="10" required /> <span class="exemple">(format jj/mm/aaaa)</span>
	    </p>
	    <p>
		<label for="ouvertureInsc" class="bline">Ouverture des inscriptions : </label>
		<input type="text" name="ouvertureInsc" id="ouvertureInsc" value="" maxlength="10" /> <span class="exemple">(format jj/mm/aaaa)</span>
	    </p>
	    <p>
		<label for="fermetureInsc" class="bline">Fermeture des inscriptions : </label>
		<input type="date" name="fermetureInsc" id="fermetureInsc" maxlength="10" /> <span class="exemple">(format jj/mm/aaaa)</span>
	    </p>
	    <p>
		<label for="lieu" class="bline">Lieu : </label>
		<input type="text" name="lieu" id="lieu" />
	    </p>
	    <p>
		<label for="description" class="bline">Description : </label>
		<textarea rows="4" cols="50" name="description" id="description">
		</textarea>
	    </p>
	    <p>
		<label for="prix" class="bline">Prix de participation : </label>
		<input type="text" value="5" name="prix" id="prix" size="3" min="0" /> <span class="exemple">&euro;</span>
	    </p>
	    <p>
		<label for="places" class="bline">Nombre de places disponibles : </label>
		<input type="text" value="100" size="4" name="places" id="places" min="1" />
	    </p>
	</fieldset>
    </div>
    <div class="button-container">
	<input type="submit" id="sauver" name="sauver" value="sauver">
    </div>
</form>

<script type="text/javascript">
$(function() {ldelim}
    $('#date').datepicker({ldelim}
	changeMonth: true,
	changeYear: true,
	showOn: 'button',
	buttonImage: '{$template_subdir}images/calendar.png',
	buttonImageOnly: true,
	maxDate: '-0d',
	yearRange: 'c-5'
    {rdelim});
{rdelim});
</script>
