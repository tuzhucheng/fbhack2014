<?
class mysql {
	
	public $connection;
	public $dconnection;
	private $mysql_host 	;//= "localhost";
	private $mysql_database ;//= "hackathon2014";
	private $mysql_user 	;//= "jamesshin92";
	private $mysql_password ;//= "******";

	public function __construct($host, $db, $usr, $pass) {
		$this->mysql_host = $host;
		$this->mysql_database = $db;
		$this->mysql_user = $usr;
		$this->mysql_password = $pass;
	}
	
	public function connect() {
		$this->connection = mysql_connect($this->mysql_host,$this->mysql_user,$this->mysql_password); 
		$this->dconnection = mysql_select_db($this->mysql_database, $this->connection);
	}
	
	public function __destruct() {
		mysql_close($this->connection );
	}
}
?>