<?

	require_once "../db/db.php";
	require_once "../db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir_back );
	
	/**BEGIN POLLS**/
	
	if(! isset( $_GET["search_poll"] ) ){
	
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
		
		$NUM_ITEMS = 6;
		
		$start_from = ($page-1)*$NUM_ITEMS; 
		
		$query = "SELECT Poll.*, Images.url 
				  FROM Poll, Images
				  WHERE Poll.id_image = Images.id_image
				  LIMIT " . $start_from . ", " . $NUM_ITEMS;
		
		$stmt = $dbh->prepare( $query );
		$stmt->execute();
	
	} else{
		$query = "SELECT Poll.*, Images.url 
				  FROM Poll, Images
				  WHERE Poll.id_image = Images.id_image
				  AND Poll.title LIKE '%" . $_GET["search_poll"] . "%'";
				  
		$stmt = $dbh->prepare( $query );
		$stmt->execute();
	}
	
	
?>

<div id = "poll">
	
	<div id = "poll_info">
		<div id = "poll_title">
			<h2>Polls</h2>
		</div>
		<div id = "poll_most_active">
			<?
			for($i = 0; $row = $stmt->fetch(); $i++){
			?>
			<div class="wrap">
				<img src="<?="../" . $row["url"]?>"/>
				<h3 class="desc"><?=$row["title"]?></h3>
			</div>
			<div id = "poll_options">
				<div id = "poll_option">
					<a id = "poll_edit" href = "edit_poll.php?id_poll=<?=$row["id_poll"]?>">Edit</a>
				</div>
				<div id = "poll_option">
					<a id = "poll_remove" href = "db/remove_poll.php?id_poll=<?=$row["id_poll"]?>">Remove</a>
				</div>
			</div>
			<?
			}
			?>
		</div>
		<?
			if( !isset( $_GET["search_poll"] ) ){
		?>
		<div id = "pagination">
		<?
				
				$result = $dbh->prepare("SELECT COUNT(*) AS num
										FROM Poll, Images
										WHERE Poll.id_image = Images.id_image");
				$result->execute(); 
				$row = $result->fetch(); 
				$total_records = $row["num"]; 
				$total_pages = ceil($total_records / $NUM_ITEMS); 
					
				echo "Move to Page:   ";
					
				for ($i=1; $i<=$total_pages; $i++) { 
					echo "<a href='polls.php?page=".$i."'";
					if($page==$i)
						echo "id=active";
					echo ">";
					echo "".$i."</a> "; 
				};
		?>
		</div>
		<?
			}
		?>
	</div>
	<script>
		
		function searchPoll(){
					
			var tag = document.getElementById("tags").value;
			
			if(tag == "")
				return false;
			
			window.location.replace("polls.php?search_poll=" + tag);
			
		}
		
		document.onkeypress = stopRKey;
		
		function stopRKey(evt) {
			var evt = (evt) ? evt : ((event) ? event : null);
			var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
			if (evt.keyCode == 13)  {
				//disable form submission
				return false;
			}
		}
		
	</script>
	
	<div id = "sidebar_poll">
		<div id = "sidebar_filters">
			<div id = "sidebar_search_poll">
				<h2>Search A Poll</h2>
				<form onclick="return searchPoll()" onsubmit="searchPoll()">
					<div class="ui-widget">
						<input type = "text" id="tags" placeholder = "Poll Name">
					</div>
					<div id = "sidebar_view_all">
						<input type = "button" name = "search_bt" value = "Search">
					</div>
				</form>
				<!--<h2>Create A Poll</h2>
				<div id = "sidebar_view_all">
					<a href = "new_poll.php">New Poll</a>
				</div>-->
			</div>
		</div>
	</div>
	

	
</div>