<?php

/*

class PDOConnectionFactory {
	
	public $con = null;

	public $persistent = false; 	

    public function getConnection($mode)  {
    	
    	try {
    		switch($mode) {
    			case MODE_TEST:
					$this->con = new PDO("mysql:host=". MYSQL_TEST_HOST .";dbname=". MYSQL_TEST_DATABASE, MYSQL_TEST_USERNAME, MYSQL_TEST_PASSWORD, array(PDO::ATTR_PERSISTENT => $this->persistent));
					$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					break;
    			case MODE_PRODUCTION:
					$this->con = new PDO("mysql:host=". MYSQL_PRODUCTION_HOST .";dbname=". MYSQL_PRODUCTION_DATABASE, MYSQL_PRODUCTION_USERNAME, MYSQL_PRODUCTION_PASSWORD, array(PDO::ATTR_PERSISTENT => $this->persistent) );
					$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    				break;
    		}

   		}
		catch ( PDOException $ex ) {  
			echo "Erro: ".$ex->getMessage(); 
		}
		
		return $this->con;			
	}
	
	public function close() {		
		if($this->con != null )			
			$this->con = null;
	}
}
*/

@require("../constants/consdaofactory.php");
@require("../constants/consmysql.php");

class PDOConnectionFactory {
	
	public $con = null;

	public $persistent = false; 	

    public function getConnection($mode)  {
    	
    	try {
    		switch($mode) {
    			case MODE_TEST:
					$this->con = new PDO("mysql:host=". MYSQL_TEST_HOST .";port=". MYSQL_TEST_PORT.";dbname=". MYSQL_TEST_DATABASE, MYSQL_TEST_USERNAME, MYSQL_TEST_PASSWORD, array(PDO::ATTR_PERSISTENT => $this->persistent));
					$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					break;
    			case MODE_PRODUCTION:
					$this->con = new PDO("mysql:host=". MYSQL_PRODUCTION_HOST .";port=". MYSQL_PRODUCTION_PORT.";dbname=". MYSQL_PRODUCTION_DATABASE, MYSQL_PRODUCTION_USERNAME, MYSQL_PRODUCTION_PASSWORD, array(PDO::ATTR_PERSISTENT => $this->persistent) );
					$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    				break;
    		}

   		}
		catch ( PDOException $ex ) {  
			echo "Erro: ".$ex->getMessage(); 
		}
		
		return $this->con;			
	}
	
	public function close() {		
		if($this->con != null )			
			$this->con = null;
	}
}
?>