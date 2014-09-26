<p>Voulez vous vraiment supprimer la participation de {$adherent->prenom_adh} {$adherent->nom_adh} à l'évenement {$event->nom} ?</p>
<form action="supp_participant.php?id_adh={$adherent->id_adh}&event_id={$event->event_id}" method="post">
    <input type="submit" name="supprimer" id="supprimer" value="Supprimer" />
</form>
