<?php 

class Event {

    const TABLE = 'event';
    const PK = 'event_id';

    private $_fields = array(
	'_event_id' => 'integer',
	'_nom' => 'string',
	'_dateEvent' => 'datetime',
	'_ouvertureInsc' => 'datetime',
	'_fermetureInsc' => 'datetime',
	'_lieu' => 'string',
	'_description' => 'string',
	'_prixParticipation' => 'integer',
	'_nbPlaces' => 'integer',
    );

    private $_event_id;
    private $_nom;
    private $_dateEvent;
    private $_ouvertureInsc;
    private $_fermetureInsc;
    private $_lieu;
    private $_description;
    private $_prixParticipation;
    private $_nbPlaces;

    public function __construct($args = null){
	global $zdb;
	
	if(is_object($args)) {
	    $this->_loadFromRS($args);
	}
	else if(is_string($args)){
	    try {
		$select = new Zend_Db_Select($zdb->db);
		$select->from(PREFIX_DB . PLUGIN_PREFIX . self::TABLE)
		    ->where('dateEvent = ?', $args);
		if ($select->query()->rowCount() == 1) {
		    $this->_loadFromRS($select->query()->fetch());
		}
	    }
	    catch (Exception $e) {
		
	    }
	}
	else if(is_int($args)) {
	    try {
		$select = new Zend_Db_Select($zdb->db);
		$select->from(PREFIX_DB . PLUGIN_PREFIX . self::TABLE)
		    ->where('event_id = ?', $args);
		if ($select->query()->rowCount() == 1) {
		    $this->_loadFromRS($select->query()->fetch());
		}
	    }
	    catch (Exception $e) {}
	}
	else {
	    $this->_event_id = '';
	    $this->_nom = '';
	    $this->_dateEvent = '';
	    $this->_ouvertureInsc = '';
	    $this->_fermetureInsc = '';
	    $this->_lieu = '';
	    $this->_description = '';
	    $this->_prixParticipation='';
	    $this->_nbPlaces = '';
	}
    }

    private function _loadFromRS($r) {
	$this->setEvent_id($r->_event_id);
	$this->setNom($r->_nom);
	$this->setDateEvent($r->_dateEvent);
	$this->setOuvertureInsc($r->_ouvertureInsc);
	$this->setFermetureInsc($r->_fermetureInsc);
	$this->setLieu($r->_lieu);
	$this->setDescription($r->_description);
	$this->setPrixParticipation($r->_prixParticipation);
	$this->setNbPlaces($r->_nbPlaces);
    }

    public function store() {
	global $zdb;

	try {
	    $values  = array();

	    foreach ($this->_fields as $k => $v) {
		$values[substr($k, 1)] = $this->$k;
	    }

	    if(!isset($this->_event_id) || $this->_event_id == '') {
		$add = $zdb->db->insert(PREFIX_DB . PLUGIN_PREFIX . self::TABLE, $values);
		if ($add > 0) {
		    $this->_event_id = $zdb->db->lastInsertId();
		} else {
		    throw new Exception(_T("Ajout event ECHEC"));
		}
	    } else {
		$edit = $zdb->db->update(
		    PREFIX_DB . PLUGIN_PREFIX . self::TABLE, $values, self::PK . '=' . $this->_event_id
		);
	    }
	    return true;
	}
	catch (Exception $e) {
	}
    }

    /* ACCESSEURS
     *
     */

    public function setEvent_id($id = null) {
	if($id == null or intval($id) <= 0) {
	    throw new Exception(_T("Id invalide"));
	}
	$this->_event_id = intval($id);
    }

    public function getEvent_id() {
	return $this->_event_id;
    }

    public function setNom($nom = null) {
	if($nom == null or strlen($nom) == 0) {
	    throw new Exception(_T("Nom invalide"));
	}
	$this->_nom = $nom;
    }

    public function getNom() {
	return $this->_nom;
    }

    public function setDateEvent($date) {
	$this->_dateEvenement = new DateTime($date);
    }

    public function getDateEvenement() {
	return $this->_dateEvenement;
    }

    public function setOuvertureInsc($date) {
	$this->_ouvertureInsc = new DateTime($date);
    }

    public function getOuvertureInsc() {
	return $this->_ouvertureInsc;
    }

    public function setFermetureInsc($date) {
	$this->_fermetureInsc = new DateTime($date);
    }

    public function getFermetureInsc() {
	return $this->_fermetureInsc;
    }

    public function setLieu($lieu) {
	$this->_lieu;
    }

    public function getLieu() {
	return $this->_lieu;
    }

    public function setDescription($desc) {
	$this->_description = $desc;
    }

    public function getDescription() {
	return $this->_description;
    }

    public function setPrixParticipation($prix = null) {
	if($prix == null or intval($prix) < 0) {
	    throw new Exception(_T("Prix invalide"));
	}
	$this->_prixParticipation = intval($prix);
    }

    public function getPrixParticipation() {
	return $this->_prixParticipation;
    }

    public function setNbPlaces($nb = null) {
	if($nb == null or intval($nb) <= 0){
	    throw new Exception(_T("Nombre invalide"));
	}
	$thi->_nbPlaces = intval($nb);
    }

    public function getNbPlaces() {
	return $this->_nbPlaces;
    }
}

?>
