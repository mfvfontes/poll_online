<?
	if(! isset( $_GET["id_opinion"] ) )
		header("Location: sent_opinions.php");

	require_once "../db/db.php";
	require_once "../db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir_back );
		
	$id_opinion = $_GET["id_opinion"];
	
	$query = "SELECT * FROM Opinions
			  WHERE Opinions.id_opinion = " . $id_opinion;
			  
	$stmt = $dbh->prepare( $query );
	$stmt->execute();
	
	$row = $stmt->fetch();	
?>

<div id = "poll">
	
	<div id = "poll_info">
		<div id = "poll_title">
			<h2><?=$row["name"]?></h2>
		</div>
		<div id = "poll_most_active">
		<div id = "edit_reg">
			<label id = "lbl_edit"> Name:
				<input type = "text" name = "username" id = "info_text" value = "<?=$row["name"]?>" disabled>
			</label>
			<label id = "lbl_edit"> Email:
				<input type = "text" name = "email" id = "info_text" value = "<?=$row["email"]?>" disabled>
			</label>
			<div>
				Comments:
				<textarea id = "info_text" name = "comments" cols = "70" rows = "3" disabled><?=$row["comments"]?></textarea>
			</div>
		</div>
		</div>
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