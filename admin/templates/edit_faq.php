<?
	if(! isset( $_GET["id_faq"] ) )
		header("Location: faqs.php");

	require_once "../db/db.php";
	require_once "../db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir_back );
		
	$id_poll = $_GET["id_faq"];
	
	$query = "SELECT * FROM Faqs
			  WHERE id_faq = ?";
			  
	$stmt = $dbh->prepare( $query );
	$stmt->execute( array ( $_GET["id_faq"] ) );
	
	$row = $stmt->fetch();	
?>

<div id = "faqs">
	
	<div id = "poll_info">
		<div id = "poll_title">
			<h2><?=$row["question"]?></h2>
		</div>
		<div id = "poll_most_active">
			
			<form method = "post" id = "edit_reg" action = "db/edit_faq.php" enctype = "multipart/form-data">
				<input type = "hidden" name = "id_faq" value = "<?=$row["id_faq"]?>">
				<label id = "lbl_edit"> Question:
					<input type = "text" name = "question" required="required" value="<?=$row["question"]?>">
				</label>
				<label id = "lbl_edit"> Answer: </label>
				<textarea id = "contact_form" name = "answer" cols = "70" rows = "5" required="required"><?=$row["answer"]?></textarea>
				<div style = "margin-top:125px">
					<input type = "submit" value = "Save" name = "save_bt">
				</div>
			</form>
		</div>
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
			</div>
		</div>
	</div>
</div>