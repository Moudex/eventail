<h1>Nouvel evenement</h1>

<form method="post" action="creation.php">
    <p>
	<label for="nom">Nom : </label>
	<input type="text" name="nom" id="nom" />
    </p>
    <p>
	<label for="date">Date : </label>
	<input type="datetime" name="date" id="date" />
    </p>
    <p>
	<label for="ouvertureInsc">Ouverture des inscriptions : </label>
	<input type="date" name="ouvertureInsc" id="ouvertureInsc" />
    </p>
    <p>
	<label for="fermetureInsc">Fermeture des inscriptions : </label>
	<input type="date" name="fermetureInsc" id="fermetureInsc" />
    </p>
    <p>
	<label for="lieu">Lieu : </label>
	<input type="text" name="lieu" id="lieu" />
    </p>
    <p>
	<label for="description">Description : </label>
	<textarea rows="4" cols="50" name="description" id="description">
	</textarea>
    </p>
    <p>
	<label for="prix">Prix de participation : </label>
	<input type="number" value="5"  min="0" />
    </p>
    <p>
	<label for="places">Nombre de places disponibles : </label>
	<input type="number" value="100" min="1" />
    </p>

    <input type="submit" value="Envoyer" />

</form>
