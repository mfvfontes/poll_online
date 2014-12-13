<?
	require_once "db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir );
	
	/**BEGIN INFO LIST**/
	
	$query = "SELECT Info_List.*, Images.url 
			 FROM Info_List, Images
			 WHERE Info_List.id_image = Images.id_image";
	
	$stmt = $dbh->prepare( $query ) ;
	$result = $stmt->execute();
	
	$info_list_items = $stmt->fetchAll();
	
	/**END INFO LIST**/
	
	/**BEGIN INFO SIDEBAR**/
	
	$query = "SELECT Info_Sidebar.*, Images.url 
			  FROM Info_Sidebar, Images
			  WHERE Info_Sidebar.id_image = Images.id_image";
	
	$stmt = $dbh->prepare( $query ) ;
	$result = $stmt->execute();
	
	$info_sidebar_items = $stmt->fetchAll();
	
	/**END INFO SIDEBAR**/
	
?>

<div id = "info">
	<div id = "info_list">
		<div id = "info_title">
			<h2>What You Can Do</h3>
		</div>
		<? foreach ($info_list_items as $item) { ?>
		<div id = "info_item">
			<div id = "info_img">
				<img src = "<?=$item["url"]?>"/>
			</div>
			<div id = "info_title">
				<h3><?=$item["title"]?></h3>
			</div>
			<div id = "info_text">
				<p>
					<?=$item["description"]?>
				</p>
			</div>
		</div>
		<?  } ?>
	</div>
				
	<div id = "sidebar_info">
		<div id = "info_title">
			<h3>Take It To The Next Level</h3>
		</div>
		<? foreach ($info_sidebar_items as $item) { ?>
		<div id = "info_sidebar_item">
			<div id = "info_img">
				<img src = "<?=$item["url"]?>"/>
			</div>
			<div id = "info_subtitle">
				<h4><?=$item["title"]?></h4>
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