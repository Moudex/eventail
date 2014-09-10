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
    }

    private function _loadFromRS($r) {
	$this->_event_id = $r->_event_id;
	$this->_nom = $r->_nom;
	$this->_dateEvent = $r->_dateEvent;
	$this->_ouvertureInsc = $r->_ouvertureInsc;
	$this->_fermetureInsc = $r->_fermetureInsc;
	$this->_lieu = $r->_lieu;
	$this->_description = $r->_description;
	$this->_prixParticipation = $r->_prixParticipation;
	$this->_nbPlaces = $r->_nbPlaces;
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
}

?>
