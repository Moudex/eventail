<?php 

class Individu {

    const TABLE = 'individu';
    const PK = 'individu_id';

    private $_fields = array(
	'_individu_id'	=> 'integer',
	'_alcool'	=> 'boolean',
	'_viande'	=> 'boolean',
	'_hallal'	=> 'boolean',
	'_voiture'	=> 'boolean',
	'_velo'		=> 'boolean',
	'_infos'	=> 'string',
    );

    private $_individu_id;
    private $_alcool;
    private $_viande;
    private $_hallal;
    private $_voiture;
    private $_velo;
    private $_infos;

    public function __construct($args = null){
	global $zdb;
	
	if(is_object($args)) {
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
		    'Something went wrong:\'( | ' . $e->getMessage() . "\n" . $e->getTraceAsString(), Analog\Analog::ERROR
		);
	    }
	}
    }

    private function _loadFromRS($r) {
	$this->_individu_id = $r->individu_id;
	$this->_alcool = $r->alcool;
	$this->_viande = $r->viande;
	$this->_hallal = $r->hallal;
	$this->_voiture = $r->voiture;
	$this->_velo = $r->velo;
	$this->_infos = $r->infos;
    }

    public function store(){
	global $zdb;

	try {
	    $values = array();

	    foreach ($this->_fields as $k => $v) {
		$values[substr($k, 1)] = $this->$k;
	    }

	    $select = new Zend_Db_Select($zdb->db);
	    $select->from(PREFIX_DB . PLUGIN_PREFIX . self::TABLE)
		->where('individu_id = ?', $this->_individu_id);
	    if ($select->query()->rowCount() == 1) {
		$edit = $zdb->db->update(
		    PREFIX_DB . PLUGIN_PREFIX . self::TABLE, $values, self::PK . ' = ' . $this->_individu_id
		);	    
	    } else {
		$add = $zdb->db->insert(PREFIX_DB . PLUGIN_PREFIX . self::TABLE, $values);
	    }
	    return true;
	} catch (Exception $e) {
	    Analog\Analog::log(
		'Something went wrong : \'( | ' . $e->getMessage() . "\n" . $e->getTraceAsString(), Analog\Analog::ERROR
	    );
	    return false;
	}
    }

    public static function get_adh($id) {
	global $zdb;

	try {
	    $select = new Zend_Db_Select($zdb->db);
	    $select->from(array('i' => PREFIX_DB . PLUGIN_PREFIX . self::TABLE))
		->where('i.individu_id = ?', $id)
		->join(array('a' => PREFIX_DB . 'adherents'), 'i.individu_id = a.id_adh')
		;
	    if ($select->query()->rowCount() == 1)
		return $select->query()->fetch();
	    else
		return false;
	}
	catch (Exception $e){
	    Analog\Analog::log(
		'something went wrong:\'( | ' . $e->getMessage() . "\n" .
		$e->getTraceAsString(), Analog\Analog::ERROR
	    );
	    return false;
	}
    }

    public static function exists($id) {
	global $zdb;

	try {
	    $select = new Zend_Db_Select($zdb->db);
	    $select->from(PREFIX_DB . PLUGIN_PREFIX . self::TABLE)
		->where(self::PK . ' = ' . $id);
	    if ($select->query()->rowCount() == 1) { return true; }
	    else { return false; }
	} catch (Exception $e) {
	    Analog\Analog::log(
		'Something went wrong : \'( | ' . $e->getMessage() . "\n" . $e->getTraceAsString(), Analog\Analog::ERROR
	    );
	    return false;
	}
    }

    public function __get($name) {
	$rname = '_' . $name;
	if (substr($rname, 0, 3) == '___') {
	    return null;
	}
	return $this->$rname;
    }

    public function __set($name, $value) {
	$rname = '_' . $name;
	$this->$rname = $value;
    }
}

?>
