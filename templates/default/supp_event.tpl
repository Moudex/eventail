<p>Voulez vous vraiment supprimer l'evenement {$event->nom} ?</p>
<form action="supp_event.php?event_id={$event->event_id}" method="post">
    <input type="submit" name="supprimer" id="supprimer" value="Supprimer" />
</form>
