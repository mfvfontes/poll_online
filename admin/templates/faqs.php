<?

	require_once "../db/db.php";
	require_once "../db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir_back );
	
	/**BEGIN FAQS**/
	
	if(! isset( $_GET["search_faq"] ) ){
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
			
		$NUM_ITEMS = 6;
			
		$start_from = ($page-1)*$NUM_ITEMS; 
			
		$query = "SELECT * 
				  FROM Faqs";
			
		$stmt = $dbh->prepare( $query );
		$stmt->execute();
	} else{
		$query = "SELECT * 
				  FROM Faqs
				  WHERE Faqs.question LIKE '%" . $_GET["search_faq"] . "%'";
				  
		$stmt = $dbh->prepare( $query );
		$stmt->execute();
	}
?>

<div id = "faqs">
	
	<div id = "poll_info">
		<div id = "poll_title">
			<h2>Frequently Asked Questions</h2>
		</div>
		<div id = "poll_most_active">
			<?
			for($i = 0; $row = $stmt->fetch(); $i++){
			?>
			<p>
				<h3><?=$row["question"]?></h3>
				<a id = "poll_edit" href = "edit_faq.php?id_faq=<?=$row["id_faq"]?>">Edit</a>
				<a id = "poll_remove" href = "db/remove_faq.php?id_faq=<?=$row["id_faq"]?>">Remove</a>
			</p>
			<?
			}
			?>
		</div>
		<?
			if( !isset( $_GET["search_faq"] ) ){
		?>
		<div id = "pagination_faq">
		<?
				
				$result = $dbh->prepare("SELECT COUNT(*) AS num
										 FROM Faqs");
				$result->execute(); 
				$row = $result->fetch(); 
				$total_records = $row["num"]; 
				$total_pages = ceil($total_records / $NUM_ITEMS); 
					
				echo "Move to Page:   ";
					
				for ($i=1; $i<=$total_pages; $i++) { 
					echo "<a href='faqs.php?page=".$i."'";
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
		
		function searchFaqs(){
					
			var tag = document.getElementById("tags").value;
			
			if(tag == "")
				return false;
			
			window.location.replace("faqs.php?search_faq=" + tag);
			
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
				<h2>Search A FAQ</h2>
				<form onclick="return searchFaqs()" onsubmit="searchFaqs()">
					<div class="ui-widget">
						<input type = "text" id="tags" placeholder = "FAQ Question">
					</div>
					<div id = "sidebar_view_all">
						<input type = "button" name = "search_bt" value = "Search">
					</div>
				</form>
				<h2>Create A FAQ</h2>
				<div id = "sidebar_view_all">
					<a href = "new_faq.php">New FAQ</a>
				</div>
			</div>
		</div>
	</div>
	

	
</div>