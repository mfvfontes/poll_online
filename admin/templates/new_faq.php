<div id = "faqs">
	
	<div id = "poll_info">
		<div id = "poll_title">
			<h2>New FAQ</h2>
		</div>
		<div id = "poll_most_active">
			
			<form method = "post" id = "edit_reg" action = "db/new_faq.php" enctype = "multipart/form-data">
				<label id = "lbl_edit"> Question:
					<input type = "text" name = "question" required="required">
				</label>
				<label id = "lbl_edit"> Answer: </label>
				<textarea id = "contact_form" name = "answer" cols = "70" rows = "5" required="required"></textarea>
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