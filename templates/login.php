<?
	require_once "db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir );
	
	/**BEGIN LOGIN SIDEBAR**/
	
	$query = "SELECT Login_Sidebar.*, Images.url 
			  FROM Login_Sidebar, Images
			  WHERE Login_Sidebar.id_image = Images.id_image";
	
	$stmt = $dbh->prepare( $query ) ;
	$result = $stmt->execute();
	
	$login_sidebar_items = $stmt->fetchAll();
	
	/**END LOGIN SIDEBAR**/
?>

<div id = "login_page">
	<div id = "login_form">
		<div id = "info_title">
			<h2>Login</h2>
		</div>
		
		<form method = "post" id = "reg_form">
			<label>
				Username
				<input type = "text" name = "username" id = "txt_username">
				<span id = "lbl_username"></span>
			</label>
			<label>
				Password
				<input type = "password" name = "password" id = "txt_password" maxlength = "25">
				<span id = "lbl_password"></span>
			</label>
			<input type = "submit" name = "login_button" id = "login_bt" value = "Login">
			<span id = "lbl_login"></span>
			
		</form>
	</div>
	<div id = "login_sidebar">
		<div id = "info_title">
			<h3>Login Rules</h3>
		</div>
		<div id = "register_sidebar_rules">
			<? foreach($login_sidebar_items as $item) { ?>
			<div id = "info_sidebar_item">
				<div id = "info_img">
					<img src = "<?=$item["url"]?>"/>
				</div>
				<div id = "info_title">
					<h3 id = "diff_img_dim"><?=$item["title"]?></h3>
				</div>
				<div id = "info_text_sidebar">
					<p>
						<?=$item["description"]?>
					</p>
				</div>
			</div>
			<?  } ?>
		</div>
	</div>
</div>