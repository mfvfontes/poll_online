<?

	require_once "../db/db.php";
	require_once "../db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir_back );
	
	/**BEGIN POLLS**/
	
	if(! isset( $_GET["search_opinion"] ) ){
	
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
		
		$NUM_ITEMS = 6;
		
		$start_from = ($page-1)*$NUM_ITEMS; 
		
		$query = "SELECT *
				  FROM Opinions
				  LIMIT " . $start_from . ", " . $NUM_ITEMS;
		
		$stmt = $dbh->prepare( $query );
		$stmt->execute();
	
	} else{
		$query = "SELECT *
				  FROM Opinions
				  WHERE name LIKE '%" . $_GET["search_opinion"] . "%'";
				  
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
				<h3><?=$row["name"]?> | <?=$row["email"]?></h3>
				<a id = "poll_edit" href = "show_opinion.php?id_opinion=<?=$row["id_opinion"]?>">Show</a>
			</p>
			<?
			}
			?>
		</div>
		<?
			if( !isset( $_GET["search_opinion"] ) ){
		?>
		<div id = "pagination_faq">
		<?
				
				$result = $dbh->prepare("SELECT COUNT(*) AS num
										 FROM Opinions");
				$result->execute(); 
				$row = $result->fetch(); 
				$total_records = $row["num"]; 
				$total_pages = ceil($total_records / $NUM_ITEMS); 
					
				echo "Move to Page:   ";
					
				for ($i=1; $i<=$total_pages; $i++) { 
					echo "<a href='sent_opinions.php?page=".$i."'";
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
		
		function searchOpinions(){
					
			var tag = document.getElementById("tags").value;
			
			if(tag == "")
				return false;
			
			window.location.replace("sent_opinions.php?search_opinion=" + tag);
			
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
				<h2>Search an Opinion</h2>
				<form onclick="return searchOpinions()" onsubmit="searchOpinions()">
					<div class="ui-widget">
						<input type = "text" id="tags" placeholder = "Person Name">
					</div>
					<div id = "sidebar_view_all">
						<input type = "button" name = "search_bt" value = "Search">
					</div>
				</form>
			</div>
		</div>
	</div>
	

	
</div>