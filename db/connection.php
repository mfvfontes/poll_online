<?
	$dbm = "sqlite"; //database management system
	$db_name = "poll.db";
	$db_name_dir = "db/poll.db";
	$db_name_dir_back = "../db/poll.db";
	
	//$poll = "gsfgfgfsgfgfg";
	
	function insert_to_db($dbh, $table, $values, $fields){
		try{
			$undf_values_str = implode(", ", array_fill(0, count($values), "?"));
			
			$query = 'INSERT INTO ' . $table;
				
			$fields_str = implode(', ', $fields);
			$query = $query . '(' .  $fields_str . ')';
						
			$query = $query . ' VALUES (' . $undf_values_str . ');';
				
			$stmt = $dbh->prepare($query);
			
			$result = $stmt->execute($values);
				
			return $result;
			
		} catch(PDOException $e){
			echo $e->getMessage();
			return null;
		}
	}
	
	function connect($dbm, $db_name){
		try{
			
			$dbh = new PDO($dbm . ":" . $db_name);
			$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			return $dbh;
			
		} catch(PDOException $pdoe){
			
			echo $pdoe->getMessage();
			die();
			
		}
	}
	
	function disconnect(&$dbh){
		$dbh = null;
	}
	
	//$dbh = connect($dbm, $db_name);
	
	//insert_to_db($dbh, 'user', array(NULL, "marcio", "12345678", "mfvfontes@gmail.com"), array("id", "username", "password", "email"));
	
	//disconnect($dbh);
?>
