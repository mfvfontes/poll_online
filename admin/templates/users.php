<?

	require_once "../db/db.php";
	require_once "../db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir_back );
	
	/**BEGIN POLLS**/
	
	if(! isset( $_GET["search_user"] ) ){
	
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
		
		$NUM_ITEMS = 6;
		
		$start_from = ($page-1)*$NUM_ITEMS; 
		
		$query = "SELECT User.*, Type_User.description 
				  FROM User, Type_User
				  WHERE User.id_type_user = Type_user.id_type_user
				  LIMIT " . $start_from . ", " . $NUM_ITEMS;
		
		$stmt = $dbh->prepare( $query );
		$stmt->execute();
	
	} else{
		$query = "SELECT User.*, Type_User.description 
				  FROM User, Type_User
				  WHERE User.id_type_user = Type_user.id_type_user
				  AND User.username LIKE '%" . $_GET["search_user"] . "%'";
				  
		$stmt = $dbh->prepare( $query );
		$stmt->execute();
	}
	
	
?>

<div id = "users">
	
	<div id = "poll_info">
		<div id = "poll_title">
			<h2>Users</h2>
		</div>
		<div id = "poll_most_active">
			<?
			for($i = 0; $row = $stmt->fetch(); $i++){
			?>
			<p>
				<h3><?=$row["username"]?> | <?=$row["description"]?></h3>
				<a id = "poll_edit" href = "edit_user.php?id_user=<?=$row["id_user"]?>">Edit</a>
				<?if($row['id_user'] != $_SESSION["id_username_root"] ) { ?>
					<a id = "poll_remove" href = "db/remove_user.php?id_user=<?=$row["id_user"]?>">Remove</a>
				<?}?>
			</p>
			<?
			}
			?>
		</div>
		<?
			if( !isset( $_GET["search_user"] ) ){
		?>
		<div id = "pagination_faq">
		<?
				
				$result = $dbh->prepare("SELECT COUNT(*) AS num
										 FROM User");
				$result->execute(); 
				$row = $result->fetch(); 
				$total_records = $row["num"]; 
				$total_pages = ceil($total_records / $NUM_ITEMS); 
					
				echo "Move to Page:   ";
					
				for ($i=1; $i<=$total_pages; $i++) { 
					echo "<a href='users.php?page=".$i."'";
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
		
		function searchUsers(){
					
			var tag = document.getElementById("tags").value;
			
			if(tag == "")
				return false;
			
			window.location.replace("users.php?search_user=" + tag);
			
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
				<h2>Search a User</h2>
				<form onclick="return searchUsers()" onsubmit="searchUsers()">
					<div class="ui-widget">
						<input type = "text" id="tags" placeholder = "Username">
					</div>
					<div id = "sidebar_view_all">
						<input type = "button" name = "search_bt" value = "Search">
					</div>
				</form>
			</div>
		</div>
	</div>
	

	
</div>