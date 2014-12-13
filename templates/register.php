<?
	require_once "db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir );
	
	/**BEGIN REGISTER SIDEBAR**/
	
	$query = "SELECT Register_Sidebar.*, Images.url 
			  FROM Register_Sidebar, Images
			  WHERE Register_Sidebar.id_image = Images.id_image";
	
	$stmt = $dbh->prepare( $query ) ;
	$result = $stmt->execute();
	
	$register_sidebar_items = $stmt->fetchAll();
	
	/**END REGISTER SIDEBAR**/
?>

<div id = "register">
	<div id = "register_form">
		<div id = "register_form_title">
			<h2>Registration Form</h2>
		</div>
		
		<form method = "post" action = "db/register.php" id = "reg_form" onsubmit = "return validateRegister()">
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
			<label>
				Retype Password
				<input type = "password" name = "rpassword" id = "txt_rpassword" maxlength = "25">
				<span id = "lbl_rpassword"></span>
			</label>
			<label>
				Email
				<input type = "text" name = "email" id = "txt_email" maxlength = "40">
				<span id = "lbl_email"></span>
			</label>
			<label>
				Phone
				<input type = "text" name = "phone" id = "txt_phone" maxlength = "9">
				<span id = "lbl_phone"></span>
			</label>
			<label>
				Security Code<br>
				<img src="captcha.php" width="250px" height="50px">
				<input type = "text" name = "security_code" id = "txt_sec_code" maxlength = "9">
				<span id = "lbl_sec_code"></span>
			</label>
			<input type = "submit" name = "send_register" value = "Register">
			
		</form>
	</div>
	<div id = "register_sidebar">
		<div id = "register_sidebar_title">
			<h3>Registration Rules</h3>
		</div>
		<div id = "register_sidebar_rules">
		<? foreach($register_sidebar_items as $item) { ?>
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