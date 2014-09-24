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
	else if(is_int($args)) {
	    try {
		$select = new Zend_Db_Select($zdb->db);
		$select->from(PREFIX_DB . PLUGIN_PREFIX . self::TABLE)
		    ->where(self::PK . ' = ' . $args);
		if ($select->query()->rowCount() == 1) {
		    $this->_loadFromRS($select->query()->fetch());
		}
	    }
	    catch (Exception $e) {
		Analog\Analog::log(
		    'Something went wrong :\'( | ' . $e->getMessage() . "\n" . $e->getTraceAsString(), Analog\Analog::ERROR
		);
	    }
	}
	else if(is_string($args)){
	    try {
		$select = new Zend_Db_Select($zdb->db);
		$select->from(PREFIX_DB . PLUGIN_PREFIX . self::TABLE)
		    ->where(self::PK . ' = ' . $args);
		if ($select->query()->rowCount() == 1) {
		    $this->_loadFromRS($select->query()->fetch());
		}
	    }
	    catch (Exception $e) {
		Analog\Analog::log(
		    'Something went wrong :\'( | ' . $e->getMessage() . "\n" . $e->getTraceAsString(), Analog\Analog::ERROR
		);
	    }
	}
    }

    private function _loadFromRS($r) {
	$this->_event_id = $r->event_id;
	$this->_nom = $r->nom;
	$this->_dateEvent = $r->dateEvent;
	$this->_ouvertureInsc = $r->ouvertureInsc;
	$this->_fermetureInsc = $r->fermetureInsc;
	$this->_lieu = $r->lieu;
	$this->_description = $r->description;
	$this->_prixParticipation = $r->prixParticipation;
	$this->_nbPlaces = $r->nbPlaces;
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
		    throw new Exception("Echec ajout event");
		}
	    } else {
		$edit = $zdb->db->update(
		    PREFIX_DB . PLUGIN_PREFIX . self::TABLE, $values, self::PK . '=' . $this->_event_id
		);
	    }
	    return true;
	}
	catch (Exception $e) {
	    Analog\Analog::log(
		'Something went wrong : \'( | ' . $e->getMessage() . "\n" . $e->getTraceAsString(), Analog\Analog::ERROR
	    );
	}
	return false;
    }

    public function erease() {
	global $zdb;

	try {
	    $del = $zdb->db->delete(PREFIX_DB . PLUGIN_PREFIX . self::TABLE, self::PK . '=' . $this->_event_id);
	    return $del;
	}
	catch (Exception $e) {
	    Analog\Analog::log(
		'Something went wrong : \'( | ' . $e->getMessage() . "\n" . $e->getTraceAsString(), Analog\Analog::ERROR
	    );
	    return false;
	}
    }

    public function getParticipants() {
	global $zdb;

	try {
	    $select = new Zend_Db_Select($zdb->db);
	   /* $select->from(array('a' => PREFIX_DB . 'adherents'), array('nom_adh', 'prenom_adh', 'tel_adh'))
		->join(array('i' => PREFIX_DB . PLUGIN_PREFIX . 'individu'), 'a.id_adh = p.individu_id')
		->join(array('p' => PREFIX_DB . PLUGIN_PREFIX . 'participe'), 
	    */
	    $select->from(array('e' => PREFIX_DB . PLUGIN_PREFIX . self::TABLE))
		->where('e.event_id = ?', $this->_event_id)
		->join(array('p' => PREFIX_DB . PLUGIN_PREFIX . 'participe'), 'e.event_id = p.event_id')
		->join(array('i' => PREFIX_DB . PLUGIN_PREFIX . 'individu'), 'p.individu_id = i.individu_id')
		->join(array('a' => PREFIX_DB . 'adherents'), 'p.individu_id = a.id_adh')
		;
	    $result = $select->query()->fetchAll();
	    return $result;
	}
	catch (Exception $e){
	    Analog\Analog::log(
		'something went wrong:\'( | ' . $e->getMessage() . "\n" .
		$e->getTraceAsString(), Analog\Analog::ERROR
	    );
	    return false;
	}
    }

    public static function getNextEvents($tri, $direction, $page, $lppage) {
	global $zdb;

	try {
	    $select = new Zend_Db_Select($zdb->db);
	    $select->from(PREFIX_DB . PLUGIN_PREFIX . self::TABLE)
		->where('dateEvent >= CURDATE()')
		->order(array($tri . ' ' . $direction, 'dateEvent asc'))
		->limitPage($page, $lppage)
		;
	    $result = $select->query()->fetchAll();
	    return $result;

	}
	catch (Exception $e){
	    Analog\Analog::log(
		'something went wrong:\'( | ' . $e->getMessage() . "\n" .
		$e->getTraceAsString(), Analog\Analog::ERROR
	    );
	    return false;
	}
    }


    /* ACCESSEURS
     *
     */

    public function __get($name) {
	$rname = '_' . $name;
	if (substr($rname, 0, 3) == '___') {
	    return null;
	}
	switch ($name) {
	case 'dateEvent':
	case 'ouvertureInsc':
	case 'fermetureInsc':
	    if ($this->$rname != null)
		return DateHeure::SQLToIHM($this->$rname);
	    break;
	default :
	    return $this->$rname;
	}
    }

    public function __set($name, $value) {
	$rname = '_' . $name;
	switch ($name) {
	    case 'dateEvent':
	    case 'ouvertureInsc':
	    case 'fermetureInsc':
		$this->$rname = DateHeure::IHMToSQL($value);
		break;
	    default:
		$this->$rname = $value;
	}
    }
}

?>
