<?
	require_once "db.php";
	
	class Poll{
		
		private $id;
		
		private $title, $question;
		private $public_poll;
		private $id_image, $id_user;
		
		private $db_table;
		
		public function __construct($info = array()){
			$this->id = $info["id"];
			$this->title = $info["title"];
			$this->question = $info["question"];
			$this->public_poll = $info["public_poll"];
			$this->id_image = $info["id_image"];
			$this->id_user = $info["id_user"];
			
			$this->db_table = "Poll";
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
		
		public function getData($dbh, $field){
			
			$query = "SELECT *
					  FROM Poll, Images
					  WHERE Poll.id_image = Images.id_image
					  AND " . $field . " = ?";
		
			$stmt = $dbh->prepare( $query );
			
			if( $field == "id_poll")
				$result = $stmt->execute( array( $this->id ) );
			else if( $field == "title" )
				$result = $stmt->execute( array( $this->title ) );
		
			$poll = $stmt->fetch();
			
			return $poll;
			
		}
		
		public function getAnswers($dbh, $field){
			
			$query = "SELECT Answers.description
					  FROM Poll, Answers
					  WHERE Poll.id_poll = Answers.id_poll
					  AND Poll." . $field . " = ?";
		
			$stmt = $dbh->prepare( $query );
			
			if( $field == "id_poll" )
				$result = $stmt->execute( array( $this->id ) );
			else if( $field == "title" )
				$result = $stmt->execute( array( $this->title ) );
		
			$poll_results = $stmt->fetchAll();
			
			return $poll_results;
			
		}
		
	}
	
	class NEPException extends Exception{ //NonExistingPoll Exception
		
		public function __construct($message = "Unknown NEPException", $code = 0, Exception $previous = null){
			parent::__construct($message, $code, $previous);
		}
		
		public function __toString(){
				
			$string = get_class($this) . " [" . $this->code . "]: " . $this->message;	
			
			return $string;
		}
		
	}
	
	function getAllPolls($dbh){
		
		$query = "SELECT id_poll, title
				  FROM Poll
				  WHERE public = 0";
			
		$stmt = $dbh->prepare( $query );
		$result = $stmt->execute();
			
		$polls = $stmt->fetchAll();
		
		return $polls;
	
	}
	
	function getMyPolls($dbh, $id_user){
	
		$query = "SELECT id_poll, title
				  FROM Poll, User
				  WHERE Poll.id_user = User.id_user
				  AND User.id_user = ?";
			
		$stmt = $dbh->prepare( $query );
		$result = $stmt->execute( array ( $id_user ) );
			
		$polls = $stmt->fetchAll();
		
		return $polls;
	
	}
	
	function getPollVote($dbh, $poll, $id_user, $field){
		
		$query = "SELECT Answers.description
				  FROM Poll, Votes, User, Answers
				  WHERE Poll.id_poll = Votes.id_poll
				  AND User.id_user = Votes.id_user
				  AND Answers.id_answer = Votes.id_answer
				  AND Poll." . $field . " = ? AND User.id_user = ?";
				  
		$stmt = $dbh->prepare( $query );
		$result = $stmt->execute( array( $poll, $id_user ) );
		
		$poll_answer = $stmt->fetch();
		
		return $poll_answer;
		
	}
	
	function getPollNumVotes($dbh, $poll, $id_user, $field){
		$query = "SELECT COUNT(*) AS num
				  FROM Poll, Votes, User
				  WHERE Poll.id_poll = Votes.id_poll
				  AND User.id_user = Votes.id_user
				  AND Poll." . $field . " = ? AND User.id_user = ?";
		
		$stmt = $dbh->prepare( $query );
		$result = $stmt->execute( array( $poll, $id_user ) );
		
		$poll_votes = $stmt->fetch();
		
		return $poll_votes;
	}
	
?>