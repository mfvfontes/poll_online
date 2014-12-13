<?
	if(! isset( $_GET["id_user"] ) )
		header("Location: users.php");

	require_once "../db/db.php";
	require_once "../db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir_back );
		
	$id_poll = $_GET["id_user"];
	
	$query = "SELECT User.*, Type_User.description
			  FROM User, Type_User
			  WHERE User.id_type_user = Type_User.id_type_user
			  AND User.id_user = " . $id_poll;
			  
	$stmt = $dbh->prepare( $query );
	$stmt->execute();
	
	$row = $stmt->fetch();	
?>

<div id = "poll">
	
	<div id = "poll_info">
		<div id = "poll_title">
			<h2><?=$row["username"]?></h2>
		</div>
		<div id = "poll_most_active">
			
			<form method = "post" id = "edit_reg" action = "db/edit_user.php" enctype = "multipart/form-data">
				<input type = "hidden" name = "id_user" value = "<?=$row["id_user"]?>">
				<label id = "lbl_edit"> Username:
					<input type = "text" name = "username" value = "<?=$row["username"]?>" required="required">
				</label>
				<label id = "lbl_edit"> New Password (leave this field blank if you don't want to change):
					<input type = "password" name = "new_password">
				</label>
				<label id = "lbl_edit"> User Type:
					<select id = "select" name = "type_user">
						<option <?if($row["description"] == "Administrator") echo "selected";?> value = "1">Administrator</option>
						<option <?if($row["description"] == "User") echo "selected";?> value = "2">User</option>
					</select>
				</label>
				<label id = "lbl_edit"> Email:
					<input type = "text" name = "email" value = "<?=$row["email"]?>" required="required">
				</label>
				<label id = "lbl_edit"> Phone:
					<input type = "text" name = "phone" value = "<?=$row["phone"]?>" required="required">
				</label>
				<input type = "submit" value = "Save" name = "save_bt">
			</form>
		</div>
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