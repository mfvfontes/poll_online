<?
	require_once "db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir );
	
	/**BEGIN ABOUT_US INFO**/
	
	$query = "SELECT * FROM Faqs";
	
	$stmt = $dbh->prepare( $query ) ;
	$result = $stmt->execute();
	
	$faqs = $stmt->fetchAll();
	
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

<div id = "faqs">
	<div id = "info_list">
		<div id = "info_title">
			<h2>Frequently Asked Questions</h2>
		</div>
		<div id = "faqs_info">
		<?foreach($faqs as $faq){?>
			<h3><?=$faq["question"]?></h3>
			<div id = "info_text">
				<p>
					<?=$faq["answer"]?>
				</p>
			</div>
		<?}?>
		</div>
	</div>
	<div id = "about_sidebar">
		<div id = "info_title">
			<h3>Don't Forget That...</h3>
		</div>
		<div id = "info_sidebar_item">
			<div id = "info_img">
				<img src = "imgs/information.png"/>
			</div>
			<div id = "info_subtitle">
				<h4>Information Always Simple</h4>
			</div>
			<div id = "info_text_sidebar">
				<p>
					Every info provided has only one objective: to make things easier for you.
				</p>
			</div>
		</div>
	</div>
</div>