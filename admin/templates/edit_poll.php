<?
	if(! isset( $_GET["id_poll"] ) )
		header("Location: polls.php");

	require_once "../db/db.php";
	require_once "../db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir_back );
		
	$id_poll = $_GET["id_poll"];
	
	$query = "SELECT Poll.*, Images.url FROM Poll, Images
			  WHERE Poll.id_image = Images.id_image
			  AND Poll.id_poll = " . $id_poll;
			  
	$stmt = $dbh->prepare( $query );
	$stmt->execute();
	
	$row = $stmt->fetch();	
?>

<div id = "poll">
	
	<div id = "poll_info">
		<div id = "poll_title">
			<h2><?=$row["title"]?></h2>
		</div>
		<div id = "poll_most_active">
			
			<form method = "post" id = "edit_reg" action = "db/edit_poll.php" enctype = "multipart/form-data">
				<input type = "hidden" name = "id_poll" value = "<?=$row["id_poll"]?>">
				<label id = "lbl_edit"> Title:
					<input type = "text" name = "title" value = "<?=$row["title"]?>" required="required">
				</label>
				<label id = "lbl_edit"> Question:
					<input type = "text" name = "question" value = "<?=$row["question"]?>" required="required">
				</label>
				<label id = "lbl_edit"> Public:
					<select id = "select" name = "public">
						<option <?if($row["public"] == 0) echo "selected";?> value = "0">Yes</option>
						<option <?if($row["public"] == 1) echo "selected";?> value = "1">No</option>
					</select>
				</label>
				<label id = "lbl_edit"> Image: </label>
					<img src="<?="../" . $row["url"]?>"/>
					<input type = "button" value = "Choose image" onclick ="javascript:document.getElementById('imagefile').click();">
					<input id = "imagefile" type="file" style='visibility: hidden;' name="img"/>        

				
				<input type = "submit" value = "Save" name = "save_bt">
			</form>
		</div>
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
				<form onclick="return searchPoll()">
					<div class="ui-widget">
						<input type = "text" id="tags" placeholder = "Poll Name">
					</div>
					<div id = "sidebar_view_all">
						<input type = "button" name = "search_bt" value = "Search">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>