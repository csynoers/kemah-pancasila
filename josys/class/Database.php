<?php
/*==============================================================================
*	CLASS DATABASE UNTUK PROSES SELECT, INSERT , UPDATE, DELETE , COUNT_ROWS
*							2016 (c) By NFY Nautilus
*							LAST UPDATE 2016/02/29
*==============================================================================*/
class Database {
	private $db;
	public function __construct($database) {
        $this->db = $database;
    }

	public function insert($table, $array) {
		$fields 	= array_keys($array);
		$values		= array_values($array);
		$fieldlist	= implode(',', $fields);
		$valueslist	= str_repeat("?,",count($fields)-1);

		$sql	= "INSERT INTO `".$table."` (".$fieldlist.") VALUES (${valueslist}?)";
		$query 	= $this->db->prepare($sql);
		return $query->execute($values);
	}

	public function update($table, $array, $fields_key, $id) {
		$fields		= array_keys($array);
		$values		= array_values($array);
		$fieldlist	= implode(',', $fields);
		$qs			= str_repeat("?,",count($fields)-1);
		$firstfield = true;

		$sql = "UPDATE `".$table."` SET";
		for ($i = 0; $i < count($fields); $i++) {
			if(!$firstfield) {
				$sql .= ", ";
			}
			$sql .= " ".$fields[$i]."=?";
			$firstfield = false;
		}
		$sql .= " WHERE `$fields_key` =?";

		$query 		= $this->db->prepare($sql);
		$values[] 	= $id;
		return $query->execute($values);
	}

	public function select($fields, $table, $where_clause='', $fetch='') {
	    // start the actual SQL statement
	    $sql = "SELECT $fields FROM `$table`";

		// check for optional where clause
		if(!empty($where_clause) === TRUE) {
			$sql .= " $where_clause";
		}

		$query = $this->db->prepare($sql);
		// check for optional fetch
		if($fetch == 'all'){ //if get data by all
			try {
				$query->execute();
			} catch(PDOException $e) {
				die($e->getMessage());
			}
			return $query->fetchAll();
		}else { //if get data by one
			//$query->bindValue(1, $id);
			try{
				$query->execute();
				return $query->fetch();
			} catch(PDOException $e){
				die($e->getMessage());
			}
		}
	}

	public function delete($table, $fields_key, $id) {
		$sql= "DELETE FROM `$table` WHERE `$fields_key` = ?";
		$query = $this->db->prepare($sql);
		$query->bindValue(1, $id);
		try{
			$query->execute();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public function count_rows($table, $where_clause='') {
		$sql 	= "SELECT count(*) FROM `$table` $where_clause";
		$result = $this->db->prepare($sql);
		try {
			$result->execute();
			$number_of_rows = $result->fetchColumn();
			return $number_of_rows;
			
		} catch (PDOException $e) {
			return FALSE;
		}
	}

	public function get_enum($table, $fields) {
	   $sql 	= "desc {$table} {$fields}";
	   $query 	= $this->db->prepare($sql);

	   if ($query->execute())
	   {
		   $row = $query->fetch(PDO::FETCH_OBJ);
		   if ($row === FALSE)
			   return FALSE;

		   $type_dec = $row->Type;
		   if (substr($type_dec, 0, 5) !== 'enum(')
			   return FALSE;

		   $values = array();
		   foreach(explode(',', substr($type_dec, 5, (strlen($type_dec) - 6))) AS $v)
		   {
			   array_push($values, trim($v, "'"));
		   }

		   return $values;
	   }
	   return FALSE;
	}

	public function last_id($table) {
		if(!empty($table)) {
			$lastID = $this->db->lastInsertId("$table");
			return $lastID;
		} else {
			echo "Failed to get last insert id";
		}
	}
/*
	public function selecxt($fields, $table, $where_clause='', $fetch='') {
		// check for optional where clause
	    $whereSQL = '';
	    if(!empty($where_clause))
	    {
	        // check to see if the 'where' keyword exists
	        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE') {
	            // not found, add key word
	            $whereSQL = " WHERE ".$where_clause;
	        }
			else {
	            $whereSQL = " ".trim($where_clause);
	        }
	    }
	    // start the actual SQL statement
	    $sql = "SELECT $fields FROM `$table`";

		if(!empty($whereSQL) === TRUE) {
			$sql .= "$whereSQL";
		}

		echo $sql;exit();
		$query = $this->db->prepare($sql);
		if($fetch == 'all'){ //if get data by all
			try {
				$query->execute();
			} catch(PDOException $e) {
				die($e->getMessage());
			}
			return $query->fetchAll();
		}else { //if get data by one
			//$query->bindValue(1, $id);
			try{
				$query->execute();
				return $query->fetch();
			} catch(PDOException $e){
				die($e->getMessage());
			}
		}
	}
*/
}


 function hp($nohp) {
     // kadang ada penulisan no hp 0811 239 345
     $nohp = str_replace(" ","",$nohp);
     // kadang ada penulisan no hp (0274) 778787
     $nohp = str_replace("(","",$nohp);
     // kadang ada penulisan no hp (0274) 778787
     $nohp = str_replace(")","",$nohp);
     // kadang ada penulisan no hp 0811.239.345
     $nohp = str_replace(".","",$nohp);
     // kadang ada penulisan no hp 0811-239-345
     $nohp = str_replace("-","",$nohp);

 
     // cek apakah no hp mengandung karakter + dan 0-9
     if(!preg_match('/[^+0-9]/',trim($nohp))){
         // cek apakah no hp karakter 1-2 adalah +62
         if(substr(trim($nohp), 0, 2)=='62'){
             $hp = trim($nohp);
         }
         // cek apakah no hp karakter 1 adalah 0
         elseif(substr(trim($nohp), 0, 1)=='0'){
             $hp = '62'.substr(trim($nohp), 1);
         }
     }
     return $hp;
 }
?>
