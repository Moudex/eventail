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

    public function __construct($id_adh = null, $event_id = null) {
	global $zdb;

	if ((is_int($id_adh) || is_string($id_adh)) && (is_int($event_id) || is_string($event_id))) {
	    try {
		$select = new Zend_Db_Select($zdb->db);
		$select->from(PREFIX_DB . PLUGIN_PREFIX . self::TABLE)
		    ->where('individu_id = ?', $id_adh)
		    ->where('event_id = ?', $event_id)
		    ;
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

	    $select = new Zend_Db_Select($zdb->db);
	    $select->from(PREFIX_DB . PLUGIN_PREFIX . self::TABLE)
		->where('individu_id = ?', $this->_individu_id)
		->where('event_id = ?', $this->_event_id)
		;
	    if ($select->query()->rowCount() == 1) {
		$where['individu_id = ?'] = $this->_individu_id;
		$where['event_id = ?'] = $this->_event_id;
		$edit = $zdb->db->update( PREFIX_DB . PLUGIN_PREFIX . self::TABLE, $values, $where);
	    } else {
		$add = $zdb->db->insert(PREFIX_DB . PLUGIN_PREFIX . self::TABLE, $values);
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

    public static function exists($id_adh, $event_id) {
	global $zdb;

	try {
	    $select = new Zend_Db_Select($zdb->db);
	    $select->from(PREFIX_DB . PLUGIN_PREFIX . self::TABLE)
		->where('individu_id = ?', $id_adh)
		->where('event_id = ?', $event_id)
		;
	    if ($select->query()->rowCount() == 1) {
		return true;
	    } else {
		return false;
	    }
	} catch (Exception $e) {
	    Analog\Analog::log(
		'Something went wrong : \'( | ' . $e->getMessage() . "\n" . $e->getTraceAsString(), Analog\Analog::ERROR
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
