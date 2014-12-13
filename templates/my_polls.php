<?

	require_once "db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir );
	
	/**BEGIN POLLS**/
	
	if (isset($_GET["page"])) { 
		$page  = $_GET["page"]; 
	} else { 
		$page=1; 
	}
	
	$NUM_ITEMS = 10;
		
	$start_from = ($page-1)*$NUM_ITEMS; 
	
	$query = "SELECT Poll.*, Images.url 
			  FROM Poll, Images, User
			  WHERE Poll.id_user = User.id_user
			  AND Poll.id_image = Images.id_image
			  AND User.id_user = " . $_SESSION["id_username"] .
			  " LIMIT " . $start_from . ", " . $NUM_ITEMS;
	
	$stmt = $dbh->prepare( $query );
	$result = $stmt->execute();
	
	$my_polls = $stmt->fetchAll();
	
	/**END POLLS**/

	$query = "SELECT COUNT(*) as num 
			  FROM Poll, Images, User
			  WHERE Poll.id_user = User.id_user
			  AND Poll.id_image = Images.id_image
			  AND User.id_user = " . $_SESSION["id_username"];
			  
	$stmt = $dbh->prepare( $query );
	$result = $stmt->execute();
	
	$num_polls = $stmt->fetch();
		
?>

<div id = "my_polls">
	
	<div id = "poll_info">
		<div id = "poll_title">
			<h2>My Polls</h2>
			<h3>To share, edit or remove a poll, just click on an image and the options will be displayed.</h3>
			<h3 id = "warning" >WARNING: If you remove a poll, all the votes are also removed.</h3>
		</div>
		<div id = "poll_most_active">
			<?
			foreach($my_polls as $my_poll){
			?>
			<div class="wrap">
				<img src="<?=$my_poll["url"]?>" class = "show" alt = "<?=$my_poll["id_poll"]?>"/>
				<h3 class="desc"><?=$my_poll["title"]?></h3>
			</div>
			<?
			}
			?>
			<?
				if($num_polls["num"] == 0){
			?>
				<h3>You have no polls at the moment. You can create one by clicking <a id = "simple_button" href = "#" class = "show" >here</a>.</h3>
			<?
				}
			?>
		</div>
		<div id = "pagination">
		<?
				
				$result = $dbh->prepare("SELECT COUNT(*) AS num
										 FROM Poll, Images, User
										 WHERE Poll.id_user = User.id_user
										 AND Poll.id_image = Images.id_image
										 AND User.id_user = " . $_SESSION["id_username"]);
				$result->execute(); 
				$row = $result->fetch(); 
				$total_records = $row["num"]; 
				$total_pages = ceil($total_records / $NUM_ITEMS); 
				
				if($total_pages != 0){
				
				echo "Move to Page:   ";
					
					for ($i=1; $i<=$total_pages; $i++) { 
						echo "<a href='my_polls.php?page=".$i."'";
						if($page==$i)
							echo "id=active";
						echo ">";
						echo "".$i."</a> "; 
					};
				}
		?>
		</div>
	</div>		 
	<div id = "sidebar_poll">
		<div id = "sidebar_filters">
			<div id = "sidebar_search_poll">
				<h2>Search A Poll</h2>
				<div class="ui-widget">
					<input type = "text" id="tags" placeholder = "Search A Poll">
				</div>
				<h2>Create A Poll</h2>
				<div id = "sidebar_view_all">
					<a href = "#" class = "show">Create Poll</a>
				</div>
			</div>
		</div>
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
			
			if(typeof $(event.target)[0].alt !== "undefined"){ //EDIT OR REMOVE POLL
				var text = $(event.target)[0].alt;
							
			inner_html = $.ajax({
					type: "GET",
					url: "db/edit_poll.php?poll=" + text,
					cache: false,
					async: false,
					dataType: "json",
					success: function(data){
								
						if(data){
							
						}
						
					}
				});
				loadScript("js/jquery.avgrund.js");
				loadScript("js/my_polls.js");
			} else{ //CREATE A POLL
			
				inner_html = $.ajax({
					type: "GET",
					url: "db/create_poll.php",
					cache: false,
					async: false,
					dataType: "json",
					success: function(data){
								
						if(data){
							
						}
						
					}
				});
				loadScript("js/jquery.avgrund.js");
				loadScript("js/answers.js");
				loadScript("js/create_poll.js");
			}
			return false;
		} );
		

		
	</script>
	
</div>