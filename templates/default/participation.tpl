<form method="post" action="inscription_event.php?id_adh={$individu->individu_id}&event_id={$event->event_id}">
<div class="bigtable">
    <p>NB : Les champs obligatoires apparaissent en <span class="required">rouge</span></p>
    <p>{$event->nom}, {$event->prixParticipation}&euro;</p>
    <p>{$adh->nom_adh} {$adh->prenom_adh}</p>
    
    {if $editI}
    <p>Vous avez déjà participé à des événements, veuillez vérifier les informations ci-dessous</p>
    {else}    
    <p>C'est votre première participation à un événement, vous devez fournir des informations complémentaires</p>
    {/if}
    <fieldset class="cssform">
	<legend class="ui-state-active ui-corner-top">Régime alimentaire</legend>
	<p>
	    <label for="alcool" class="bline">Boissons alcoolisées : </label>
	    <input name="alcool" id="alcool" type="checkbox" value="1" {if $editI}{if $individu->alcool eq 1}checked{/if}{else}checked{/if} >
	</p>
	<p>
	    <label for="viande" class="bline">Mange de la viande : </label>
	    <input name="viande" id="viande" type="checkbox" value="1" {if $editI}{if $individu->alcool eq 1}checked{/if}{else}checked{/if} >
	</p>
	<p>
	    <label for="hallal" class="bline">Hallal : </label>
	    <input name="hallal" id="hallal" type="checkbox" value="1" {if $editI}{if $individu->hallal eq 1}checked{/if}{/if} >
	</p>
    </fieldset>
    <fieldset class="cssform">
	<legend class="ui-state-active ui-corner-top">Transport</legend>
	<p>
	    <label for="voiture" class="bline">Possède une voiture : </label>
	    <input type="checkbox" name="voiture" id="voiture" value="1" {if $editI}{if $individu->voiture eq 1}checked{/if}{/if} >
	</p>
	<p>
	    <label for="velo" class="bline">Possède un vélo : </label>
	    <input type="checkbox" name="velo" id="velo" value="1" {if $editI}{if $individu->velo eq 1}checked{/if}{/if} >
	</p>
    </fieldset>
    <fieldset class="cssform">
	<legend class="ui-state-active ui-corner-top">Participation</legend>
	<p>
	    <label for="paye" class="bline">Payé : </label>
	    <input type="checkbox" name="paye" id="paye" value="1" {if $editP}{if $participe->paye eq 1}checked{/if}{/if}>
	</p>
	<p>
	    <label for="commentaire" class="bline">Commentaire : </label>
	    <input type="text" name="commentaire" id="commentaire" {if $editP}{$participe->commentaire}{/if}>
	</p>
    </fieldset>
</div>
    <div class="button-container">
	<input type="submit" id="participer" name="participer" value="participer">
    </div>
</form>
