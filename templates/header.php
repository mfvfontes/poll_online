<body>
	<div id = "wrapper">
		<div id = "header">				
			<div id = "logo">
				<div id = "title">		
					<h1><a href = "index.php" id = "logo_img">Poll Online</a></h1>
					<h2>The Best Voting Website.</h2>			
				</div>
			</div>
						
			<div id = "wrapper_login">
				<div id = "login">
					<nav role = "navigation">
						<ul>
						<? if( !isset( $_SESSION["id_username"] ) ){ ?>
							<li class = "button">
								<a href = "login.php">Login</a>
							</li>
							<li class = "button">
								<a href = "register.php">Register</a>
							</li>
						<? } else { ?>
							<li class = "button">
								<a href = "my_polls.php">My Polls</a>
							</li>
							<li class = "button">
								<a href = "db/logout.php">Logout</a>
							</li>
						<? }?>
						</ul>
					</nav>
					<div id = "languages">
						<div id = "languages_item">
							<a href = "index.php?lang=pt">
								<img src = 'imgs/portugal_flag.png' />
							</a>
						</div>
						<div id = "languages_item">
							<a href = "index.php?lang=en">
								<img src = 'imgs/english_flag.png' />
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>