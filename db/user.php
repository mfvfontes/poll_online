<?
	require_once "db.php";
	require_once "bcrypt.php";
	
	class User{
	
		public static $ID_ADMIN = "1";
		public static $ID_NORMAL_USER = "2";
	
		private $id;
		private $username, $password;
		private $email, $phone;
		private $type_user;
	
		private $db_table;
	
		public function __construct($info = array()){
			$this->id = $info["id"];
			$this->username = $info["username"];
			$this->password = $info["password"];
			$this->email = $info["email"];
			$this->phone = $info["phone"];
			$this->type_user = $info["type_user"];
			
			$this->db_table = "User";
		}
		
		public function get_attr($attr){
			$vars = get_object_vars($this);
			
			if(isset($vars[$attr]))
				eval("return \$this->" . $attr . ";");
			else
				return null;
		}
		
		public function get_attrs($attrs){
			$res = array();
			
			foreach($attrs as $attr)
				array_push($res, get_attr($attr));
				
			return $res;
		}
		
		public function set_attr($attr, $value){
			
			$vars = get_object_vars($this);
			
			if(isset($vars[$attr]))
				eval("\$this->" . $attr . " = \"" . $value . "\";");
			else
				return null;
		}
			
		public function set_attrs($attrs, $values){
			
			if(count($attrs) != count($values))
				return null;
				
			foreach(array_combine($attrs, $values) as $attr => $value)
				$this->set_attr($attr, $value);
		}
		
		public function __toString(){
			$vars = get_object_vars($this);
			
			$vars_keys = implode(",", array_keys($vars));
			$vars_values = implode(",", $vars);
			
			$string_keys = "User(" . $vars_keys . ")";
			$string_values = "User(" . $vars_values . ")";
			
			$string = $string_keys . " = " . $string_values;
			
			return $string;
		}
		
		public function register($dbh){
			
			$bcrypt = new Bcrypt(12);
			
			$hash = $bcrypt->hash($this->password);
			
			$values = array(NULL, $this->username, $hash, $this->email, $this->phone, $this->type_user);
			$fields = array("id_user", "username", "password", "email", "phone", "id_type_user");
			
			$result = insert_to_db($dbh, $this->db_table, $values, $fields);
			
			return $result;
		}
		
		public function login($dbh, $admin = FALSE){
			
			if($admin == TRUE)
				$query = "SELECT COUNT(*) AS num FROM User WHERE username = ? AND id_type_user = 1";
			else
				$query = "SELECT COUNT(*) AS num FROM User WHERE username = ? AND id_type_user = 2";
			
			$values = array( $this->username );
			
			$stmt = $dbh->prepare($query);
			$result = $stmt->execute($values);
			
			if($result == TRUE){
				
				$num_users = $stmt->fetch()["num"]; 
				
				if( $num_users == 1 ){
				
					$query = "SELECT * FROM User WHERE username = ?";
					
					$stmt = $dbh->prepare($query);
					$result = $stmt->execute( array($this->username) );
					
					$user = $stmt->fetch();
					
					$bcrypt = new Bcrypt(12);

					$isCorrect = $bcrypt->verify($this->password, $user["password"]);
					
					if($isCorrect){
					
						$attrs = array( "id", "email", "phone", "type_user" ); //Attributes that were missing before logging in
								
						$values = array( "id" => $user["id_user"], 
										 "email" => $user["email"], 
										 "phone" => $user["phone"], 
										 "type_user" => $user["id_type_user"] ); //Populate the data
						
						$this->set_attrs( $attrs, $values );
						
						return $user["id_user"];
					} else
						throw new NEUException();
					
				} else
					throw new NEUException();
			
			} else
				return FALSE;
			
		}
		
		
		
		
		/*public function login($dbh, $admin = FALSE){
			
			if($admin == TRUE)
				$query = "SELECT COUNT(*) AS num FROM User WHERE username = ? AND password = ? AND id_type_user = 1";
			else
				$query = "SELECT COUNT(*) AS num FROM User WHERE username = ? AND password = ? AND id_type_user = 2";
			
			$values = array( $this->username, $this->password );
			
			$stmt = $dbh->prepare($query);
			$result = $stmt->execute($values);
			
			if($result == TRUE){
				$num_users = $stmt->fetch()["num"]; 
				
				if( $num_users == 1 ){
					$query = "SELECT * FROM User WHERE username = ? AND password = ?";
					
					$stmt = $dbh->prepare($query);
					$result = $stmt->execute($values);
					
					$user = $stmt->fetch();
					
					$attrs = array( "id", "email", "phone", "type_user" ); //Attributes that were missing before logging in
							
					$values = array( "id" => $user["id_user"], 
									 "email" => $user["email"], 
									 "phone" => $user["phone"], 
									 "type_user" => $user["id_type_user"] ); //Populate the data
					
					$this->set_attrs( $attrs, $values );
					
					return $user["id_user"];
					
				}
				else
					throw new NEUException();
			}
			else
				return FALSE;
			
		}*/
		
	}

	class NEUException extends Exception{ //NonExistingUser Exception
		
		public function __construct($message = "Unknown NEUException", $code = 0, Exception $previous = null){
			parent::__construct($message, $code, $previous);
		}
		
		public function __toString(){
				
			$string = get_class($this) . " [" . $this->code . "]: " . $this->message;	
			
			return $string;
		}
		
	}
	
	
?>
