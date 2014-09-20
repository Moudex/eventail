<?php 

class DateHeure {

    private function __construct() {}

    public static function nowSQL() {
	return date('Y-m-d H:i:s');
    }

    public static function nowIHM() {
	return date('d/m/Y H:i:s');
    }

    public static function IHMToSQL($ihm) {
	list($j, $m, $x) = split('/', $ihm);
	list($a, $h) = split(' ', $x);
	return $a.'-'.$m.'-'.$j.' '.$h;
    }

    public static function SQLToIHM($sql) {
	list($a, $m, $x) = split('-', $sql);
	list($j, $h) = split(' ', $x);
	return $j.'/'.$m.'/'.$a.' '.$h;
    }

}

?>
