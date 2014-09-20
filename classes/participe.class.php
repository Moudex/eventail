<?php 

class Participe{

    const TABLE = 'participe';
    const PK = 'participe_id';

    private $_fields = array(
	'_participe_id' => 'integer',
	'_paye' => 'boolean',
	'_datePaye' => 'datetime',
	'_event_id' => 'integer',
	'_individu_id' => 'integer',
	'_commentaire' => 'string',
    );

    private $_participe_id;
    private $_paye;
    private $_datePaye;
    private $_event_id;
    private $_individu_id;
    private $_commentaire;

    public function __construct($args = null) {
	global $zdb;

	if (is_object($args)) {
	    $this->_loadFromRS($args);
	}
	else if (is_int($args) || is_string($args)) {
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
	$this->_participe_id = $r->participe_id;
	$this->_paye = $r->paye;
	$this->_datePaye = $r->datePaye;
	$this->_event_id = $r->event_id;
	$this->_individu_id = $r->individu_id;
	$this->_commentaire = $r->commentaire;
    }

    public function store() {
	global $zdb;

	try {
	    $values = array();

	    foreach ($this->_fields as $k => $v) {
		$values[substr($k, 1)] = $this->$k;
	    }

	    if (!isset($this->_participe_id) || $this->_participe_id == '') {
		$add = $zdb->db->insert(PREFIX_DB . PLUGIN_PREFIX . self::TABLE, $values);
		if ($add > 0) {
		    $this->_participe_id = $zdb->db->lastInsertId();
		} else {
		    throw new Exception("Echec ajout participant");
		}
	    } else {
		$edit = $zdb->db->update(
		    PREFIX_DB . PLUGIN_PREFIX . self::TABLE, $value, self::PK . ' = ' . $this->_event_id
		);
	    }
	    return true;
	}
	catch (Exception $e) {
	    Analog\Analog::log(
		    'Something went wrong:\'( | ' . $e->getMessage() . "\n" . $e->getTraceAsString(), Analog\Analog::ERROR
	    );
	    return false;
	}
    }

    public function __get($name) {
	$rname = '-' . $name;
	if (substr($rname, 0, 3) == '___') {
	    return null;
	}
	switch ($name) {
	    case 'datePaye':
		return DateHeure::SQLToIHM($this->$rname);
		break;
	    default:
		return $this->$rname;
	}
    }

    public function __set($name, $value) {
	$rname = '_' . $name;
	switch ($name) {
	    case 'datePaye':
		$this->$rname = DateHeure::IHMToSQL($value);
		break;
	    default:
		$this->$rname = $value;
	}
    }
}

?>
