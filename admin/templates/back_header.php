<body>
	<div id = "wrapper">
		<div id = "header">				
			<div id = "logo">
				<div id = "title">		
					<h1><a href = "index.php" id = "logo_img">Poll Online BackOffice</a></h1>
					<h2>The Best Voting Website.</h2>			
				</div>
			</div>
						
			<div id = "wrapper_login">
				<div id = "login">
					<nav role = "navigation">
						<ul>
						<? if( !isset( $_SESSION["username"] ) ){ ?>
							
						<? } else { ?>
							<li class = "button">
								<a href = "polls.php">Polls</a>
							</li>
							<li class = "button">
								<a href = "users.php">Users</a>
							</li>
							<li class = "button">
								<a href = "faqs.php">FAQ</a>
							</li>
							
						
						</ul>
						<ul>
							<li class = "button">
								<a href = "about_us.php">About</a>
							</li>
							<li class = "button" style = "width: 200px">
								<a href = "sent_opinions.php">Sent Opinions</a>
							</li>
						</ul>
						<ul style = "margin-left: 185px">
							<li class = "button">
								<a href = "db/logout.php">Logout</a>
							</li>
						</ul>
						<? }?>
					</nav>
				</div>
			</div>
		</div>