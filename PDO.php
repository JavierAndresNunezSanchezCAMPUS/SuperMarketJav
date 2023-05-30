<?php 

abstract class AbstractPdo {

    protected $dbPDO;

    public function __construct($dbPDO){
        $this->dbPDO = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }
}

?>