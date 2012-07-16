<?php

Class MySQLDatebase{
	
	private $conn;
	private $db_name;
	public $sql_list;

	public function MySQLDatebase($host, $port, $user, $pswd, $db){
		$_host = "$host:$port";
		$conn = mysql_connect($_host, $user, $pswd);
		if(!$conn){
			die('Can not connect : '.mysql_error());
		}
		$dbconn = mysql_select_db($db);
		if(!$dbconn){
			die('Can not select this database : '.mysql_error($conn));
		}
		mysql_query('set names utf8');
		$this->db_name = $db;
		$this->conn = $conn;
		$this->sql_list = array();
	}
	
	public function get_database_name(){
		return $this->db_name;
	}
	
	public function get_row($sql){
		//echo $sql.'<br>';
		$this->sql_list[] = $sql;
		$result = mysql_query($sql);
		return mysql_fetch_object($result);
	}
	
	public function get_list($sql){
//		echo $sql.'<br>';
		$this->sql_list[] = $sql;
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		$list = array();
		for($i = 0;$i < $num;$i++){
			mysql_data_seek($result, $i);
			$data = mysql_fetch_object($result);
			$list[] = $data;
		}
		return $list;
	}
	
	public function insert($sql){
//		echo $sql.'<br>';
		$this->sql_list[] = $sql;
		mysql_query($sql);
		return mysql_insert_id($this->conn);
	}
	
	public function query($sql){
//		echo $sql.'<br>';
		$this->sql_list[] = $sql;
		mysql_query($sql);
		return mysql_affected_rows($this->conn);
	}
	
	public function sql_dump(){
		return $this->sql_list;
	}

}