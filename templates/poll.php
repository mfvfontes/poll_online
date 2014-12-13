<?
	require_once "db/connection.php";
	
	$dbh = connect( $dbm, $db_name_dir );
	
	/**BEGIN POLLS**/
	
	//MOST ACTIVE
	
	$query = "SELECT Poll.*, Images.url, COUNT(Votes.id_poll) as num_votes 
			  FROM Poll, Votes, Images
			  WHERE Poll.id_poll = Votes.id_poll
			  AND Poll.id_image = Images.id_image
			  AND Poll.public = 0
			  GROUP BY Poll.id_poll
			  ORDER BY num_votes DESC
			  LIMIT 5";
	
	$stmt = $dbh->prepare( $query );
	$result = $stmt->execute();
	
	$most_active_polls = $stmt->fetchAll();
	
	//LATEST POLLS
	
	$query = "SELECT * FROM Poll, Images 
			  WHERE Poll.id_image = Images.id_image
			  AND Poll.public = 0
			  ORDER BY id_poll DESC
			  LIMIT 5";
	
	$stmt = $dbh->prepare( $query );
	$result = $stmt->execute();
	
	$latest_polls = $stmt->fetchAll();
	
	/**END POLLS**/
	
?>

<div id = "poll">
	<div id = "poll_info">
		<div id = "poll_title">
			<h2>Most Active</h2>
		</div>
		<div id = "poll_most_active">
			<?
			foreach($most_active_polls as $most_active_poll){
			?>
			<div class="wrap">
				<img src="<?=$most_active_poll["url"]?>" class = "show" alt = "<?=$most_active_poll["id_poll"]?>"/>
				<h3 class="desc"><?=$most_active_poll["title"]?></h3>
			</div>
			<?
			}
			?>
		</div>
		<div id = "poll_latest_polls">
			<h2>Latest Polls</h2>
			<?
			foreach($latest_polls as $latest_poll){
			?>
			<div class="wrap">
				<img src="<?=$latest_poll["url"]?>" class = "show" alt = "<?=$latest_poll["id_poll"]?>"/>
				<h3 class="desc"><?=$latest_poll["title"]?></h3>
			</div>
			<?
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
				<div id = "sidebar_view_all">
					<a href = "polls.php">View All Polls</a>
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
			var text = $(event.target)[0].alt;
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
</div>