<?
	require_once "db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir );
	
	/**BEGIN ABOUT_US INFO**/
	
	$query = "SELECT * FROM About_Us";
	
	$stmt = $dbh->prepare( $query ) ;
	$result = $stmt->execute();
	
	$about_us = $stmt->fetch();
	
	/**END ABOUT_US INFO**/
	
	/**BEGIN ABOUT_US SIDEBAR**/
	
	$query = "SELECT About_Us_Sidebar.*, Images.url 
			  FROM About_Us_Sidebar, Images
			  WHERE About_Us_Sidebar.id_image = Images.id_image";
	
	$stmt = $dbh->prepare( $query ) ;
	$result = $stmt->execute();
	
	$about_us_sidebar_items = $stmt->fetchAll();
	
	/**END ABOUT_US SIDEBAR**/
	
?>

<div id = "about_us">
	<div id = "info_list">
		<div id = "info_title">
			<h2>About Us</h2>
		</div>
		<div id = "about_info">
			<h3>Motivation</h3>
			<div id = "info_text">
				<p>
					<?=$about_us["motivation"]?>
				</p>
			</div>
			<h3>Objective</h3>
			<div id = "info_text">
				<p>
					<?=$about_us["objective"]?>
				</p>
			</div>
			<h3>Help Us Get Better</h3>
			<div id = "info_text">
				<p>
					<?=$about_us["help_us"]?>
				</p>
			</div>
		</div>
	</div>
	<div id = "about_sidebar">
		<div id = "info_title">
			<h3>Did You Know That...</h3>
		</div>
		<? foreach( $about_us_sidebar_items as $item ) { ?>
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