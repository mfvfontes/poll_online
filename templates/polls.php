<?

	require_once "db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir );
	
	/**BEGIN POLLS**/
	
	if( !isset( $_GET["id_poll"] ) ){
	
		if (isset($_GET["page"])) { 
			$page  = $_GET["page"]; 
		} else { 
			$page=1; 
		}
		
		$NUM_ITEMS = 10;
		
		$start_from = ($page-1)*$NUM_ITEMS; 
		
		$query = "SELECT Poll.*, Images.url 
				  FROM Poll, Images
				  WHERE Poll.id_image = Images.id_image
				  AND Poll.public = 0
				  LIMIT " . $start_from . ", " . $NUM_ITEMS;
		
		$stmt = $dbh->prepare( $query );
		$stmt->execute();
	
	} else{
		$query = "SELECT Poll.*, Images.url 
				  FROM Poll, Images
				  WHERE Poll.id_image = Images.id_image
				  AND Poll.id_poll = " . $_GET["id_poll"];
				  
		$stmt = $dbh->prepare( $query );
		$stmt->execute();
	}
	
	
?>

<div id = "poll">
	
	<div id = "poll_info">
		<div id = "poll_title">
			<h2>Polls</h2>
		</div>
		<div id = "poll_most_active">
			<?
			for($i = 0; $row = $stmt->fetch(); $i++){
			?>
			<div class="wrap">
				<img src="<?=$row["url"]?>" class = "show" alt="<?=$row["id_poll"]?>"/>
				<h3 class="desc"><?=$row["title"]?></h3>
			</div>
			<?
			}
			?>
		</div>
		<?
			if( !isset( $_GET["search_poll"] ) ){
		?>
		<div id = "pagination">
		<?
				if( isset($NUM_ITEMS) ){
					$result = $dbh->prepare("SELECT COUNT(*) AS num
											FROM Poll, Images
											WHERE Poll.id_image = Images.id_image
											AND Poll.public = 0");
					$result->execute(); 
					$row = $result->fetch(); 
					$total_records = $row["num"]; 
					$total_pages = ceil($total_records / $NUM_ITEMS); 
				
				
				
					echo "Move to Page:   ";
						
					for ($i=1; $i<=$total_pages; $i++) { 
						echo "<a href='polls.php?page=".$i."'";
						if($page==$i)
							echo "id=active";
						echo ">";
						echo "".$i."</a> "; 
					};
				}
		?>
		</div>
		<?
			}
		?>
	</div>
	<script>
		
		var inner_html;
		
		function loadScript(script_url){    
			var head= document.getElementsByTagName('head')[0];
			var script= document.createElement('script');
			script.type= 'text/javascript';
			script.src= script_url;
			head.appendChild(script);
			return true;
		}
		
		$('.show').click( function(event){
			var text = $(event.target)[0].alt;
			//location.replace("index.php?img=1");
			//window.history.replaceState("", "", "index.php?poll=" + text);
			inner_html = $.ajax({
					type: "GET",
					url: "db/poll.php?poll=" + text,
					cache: false,
					async: false,
					dataType: "json",
					success: function(data){
								
						if(data){
							
						}
						
					}
				});
				loadScript("js/jquery.avgrund.js");
				loadScript("js/vote.js");
		} );
		

		
	</script>
	
	<div id = "sidebar_poll">
		<div id = "sidebar_filters">
			<div id = "sidebar_search_poll">
				<h2>Search A Poll</h2>
				<div class="ui-widget">
					<input type = "text" id="tags" placeholder = "Search A Poll">
				</div>		
			</div>
		</div>
	</div>

</div>