<?php

require_once('/home/bassam/Desktop/FSW/php_project/config.php');


class mysql_connection
{

	public $conn;

	public function __construct(){

		global $hn ;
		global $db ;
		global $un ;
		global $pw ;

		$con2= new mysqli($hn, $un, $pw, $db);
		if ($con2->connect_error){
		 	die("Fatal Error");
			echo "error";
		}
		$this->conn = $con2;
	}
}
?>
