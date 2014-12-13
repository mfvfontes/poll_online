<div id = "poll">
	
	<div id = "poll_info">
		<div id = "poll_title">
			<h2>New Poll</h2>
		</div>
		<div id = "poll_most_active">
			
			<form method = "post" id = "edit_reg" action = "db/edit_poll.php" enctype = "multipart/form-data">
				<input type = "hidden" name = "id_poll">
				<label id = "lbl_edit"> Title:
					<input type = "text" name = "title" required="required">
				</label>
				<label id = "lbl_edit"> Question:
					<input type = "text" name = "question" required="required">
				</label>
				<label id = "lbl_edit"> Public:
					<select id = "select" name = "public">
						<option value = "0">Yes</option>
						<option value = "1">No</option>
					</select>
				</label>
				<label id = "lbl_edit"> Image: </label>
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