<?
	if( isset( $_POST["save_bt"] ) ){
	
		require_once "../../db/db.php";
		require_once "../../db/connection.php";
		
		$dbh = connect( $dbm, "../" . $db_name_dir_back );
	
		$id_poll = $_POST["id_poll"];
		$title = $_POST["title"];
		$question = $_POST["question"];
		$public = $_POST["public"];
		
		if( $_FILES["img"]["name"] != ""  ){
			$url = "imgs/" . $_FILES["img"]["name"];
			move_uploaded_file($_FILES["img"]["tmp_name"], "../../imgs/" . $_FILES["img"]["name"]);
			
			$result = $dbh->prepare("SELECT Poll.id_image
									 FROM Poll
									 WHERE Poll.id_poll = ?");
			
			$result->execute( array( $id_poll ) );
			
			$poll = $result->fetch();
			
			$result = $dbh->prepare("UPDATE Images
									 SET url = ?
									 WHERE id_image = ?");
			
			$result->execute( array ( $url, $poll["id_image"] ) );
			
			//echo $id_poll . "," . $title . "," . $question . "," . $public . "," . $location_img;
		}
		
		$result = $dbh->prepare("UPDATE Poll 
								 SET title = ?,
								 question = ?,
								 public = ?
								 WHERE id_poll = ?");
									 
		$result->execute( array( $title, $question, $public, $id_poll ) );

		header("Location: ../polls.php");
		
	}
	else
		header("Location: ../polls.php");
?>