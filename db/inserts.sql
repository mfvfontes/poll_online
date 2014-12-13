INSERT INTO Type_User VALUES ( NULL, "Administrator" ),
							 ( NULL, "User" );

INSERT INTO Subject VALUES( NULL, "Politics" ),
						  ( NULL, "Sports" ),
						  ( NULL, "Education" ),
						  ( NULL, "Health" ),
						  ( NULL, "Economics" );
						  
INSERT INTO User VALUES ( NULL, "root", "$2a$12$Ro/6/PChXkz5knptMUzMg.24luEDkUTqlXU97lmLvJ7w1ckguSfVC", "", 999999999, 1 ),
						( NULL, "mfvfontes", "$2a$12$Ro/6/PChXkz5knptMUzMg.24luEDkUTqlXU97lmLvJ7w1ckguSfVC", "", 999999999, 2 ),
						( NULL, "tiago", "$2a$12$Ro/6/PChXkz5knptMUzMg.24luEDkUTqlXU97lmLvJ7w1ckguSfVC", "", 999999999, 2 ),
						( NULL, "rui", "$2a$12$Ro/6/PChXkz5knptMUzMg.24luEDkUTqlXU97lmLvJ7w1ckguSfVC", "", 999999999, 2 ),
						( NULL, "tiago_melo", "$2a$12$Ro/6/PChXkz5knptMUzMg.24luEDkUTqlXU97lmLvJ7w1ckguSfVC", "", 999999999, 2 ),
						( NULL, "rui_carvalho", "$2a$12$Ro/6/PChXkz5knptMUzMg.24luEDkUTqlXU97lmLvJ7w1ckguSfVC", "", 999999999, 2 );

INSERT INTO Images VALUES /*POLLS*/
						  ( NULL, "imgs/new_app.png" ),
						  ( NULL, "imgs/world_cup.png" ),
						  ( NULL, "imgs/wifi.png" ),
						  ( NULL, "imgs/money.png" ),
						  ( NULL, "imgs/government.png" ),
						  ( NULL, "imgs/water_supply.png" ),
						  ( NULL, "imgs/new_pc.png" ),
						  ( NULL, "imgs/christmas.png" ),
						  ( NULL, "imgs/car_polution.png" ),
						  ( NULL, "imgs/doctor.png" ),
						  /*ABOUT_US*/
						  ( NULL, "imgs/information.png" ),
						  ( NULL, "imgs/smartphone.png" ),
						  ( NULL, "imgs/growth.png" ),
						  /*SEND_US_YOUR_OPINION*/
						  ( NULL, "imgs/help.png" ),
						  /*LOGIN*/
						  ( NULL, "imgs/username.png" ),
						  ( NULL, "imgs/password.png" ),
						  /*REGISTER*/
						  ( NULL, "imgs/email.png" ),
						  ( NULL, "imgs/phone.png" ),
						  /*INFO_LIST*/
						  ( NULL, "imgs/private.png" ),
						  ( NULL, "imgs/bar_chart.png" ),
						  ( NULL, "imgs/share.png" ),
						  /*INFO_SIDEBAR*/
						  ( NULL, "imgs/active.png" ),
						  ( NULL, "imgs/mail.png" ),
						  ( NULL, "imgs/friends.png" );

INSERT INTO About_Us VALUES ( NULL,
							  "After searching the Web in order to find a suitable website that meets the personal needs, we've decided to implement a website that offers all the user could think of. Based on many studies, it was concluded that many users dont't make polls online because of the lack of professional websites they found on the Web",
							  "We think that with the development of this website, it will enable users to make more polls online and share them in social networks. Also, users will be free to colaborate with new ideas to make the use of polls more constant.",
							  "Feel free to contact us and send your opinion. You can contact us <a href = 'contact.php'>here</a>.");

INSERT INTO About_Us_Sidebar VALUES ( NULL, 1, "Academic Project", "This website was first developed in an university course.", 11 ),
									( NULL, 1, "Mobile Application", "More polls are made on our mobile application than in our website.", 12 ),
									( NULL, 1, "Exponential Growth", "Since our website has been lauched, polls online growth has gone up 75%.", 13 );

INSERT INTO Opinions_Sidebar VALUES ( NULL, "Be Helpful", "Don't just criticize something, but encourage modifications and new functionalities.", 14 ), 
									( NULL, "Be Respectful", "Please be respectul when commenting the website's structure or bugs that may occur.", 14 );

INSERT INTO Login_Sidebar VALUES ( NULL, "Username", "Please type your username according to your to registration.", 15 ),
								 ( NULL, "Password", "Please type your password according to your to registration.", 16 );

INSERT INTO Register_Sidebar VALUES ( NULL, "Username", "Username must have at least 6 characters and start by a letter.", 15 ),
									( NULL, "Password", "Password must have at least an uppercase and lowercase letter, 1 digit and 1 symbol.", 16 ),
									( NULL, "Email", "Use a valid email.", 17 ),
									( NULL, "Phone", "Use a valid phone number with 9 digits.", 18 );

INSERT INTO Info_List VALUES ( NULL, "Public and Private Polls", "Polls owners can decide if the poll is public or private.", 19 ),
							 ( NULL, "Poll Results With Charts", "Check your polls' results more accurately.", 20 ),
							 ( NULL, "Share A Poll With Your Friends", "Possibility to share a poll using email.", 21 );

INSERT INTO Info_Sidebar VALUES ( NULL, "Be At Our Most Active Polls", "Share your poll by <i>email</i> and let others know about it, to be able to appear on our <a href = 'index.php#poll_title'>Most Active</a>.", 22 ),
								( NULL, "Invite a Friend To Participate", "If you're already a member, then login in and send a poll as an invitation using our website.If you're not a member, then you can register right <a href = 'register.php'>here</a>.", 23 ),
								( NULL, "Let Your Friends Know", "You can choose to let your friends know about your polls and activity. Therefore, the probability of being successful is greater.", 24 );
							 
INSERT INTO Poll VALUES ( NULL, "Poll Online App", "What's the best poll maker website?", 0, 1, 2 ),
						( NULL, "World Cup", "Who's gonna win the World Cup?", 0, 2, 2 ),
						( NULL, "FEUP Wifi", "Is the Wifi working correctly?", 0, 3, 2 ),
						( NULL, "Earn Money Online", "Which site makes you earn more money online?", 0, 4, 2 ),
						( NULL, "Elections", "Who's gonna win the elections this year?", 0, 5, 2 ),
						( NULL, "Water Supply", "Should we sue the Watter Supply company?", 0, 6, 2 ),
						( NULL, "New Asus Desktop", "Is the new Asus Desktop a good computer?", 0, 7, 2 ),
						( NULL, "Christmas Presents", "What do you most desire for Christmas?", 0, 8, 2 ),
						( NULL, "Car Polution", "How can we can solve this problem?", 0, 9, 2 ),
						( NULL, "Doctor", "Should doctors be more careful in surgeries?", 0, 10, 2 );

INSERT INTO Answers VALUES ( NULL, "Poll Online", 1 ),
						   ( NULL, "Poll-Maker", 1 ),
						   ( NULL, "Polly", 1 ),
						   ( NULL, "Poll Today", 1 ),
						   ( NULL, "Poll Everyday", 1 ),
						   ( NULL, "Poll Tomorrow", 1 ),
						   ( NULL, "Poll Yesterday", 1 ),
						   ( NULL, "Portugal", 2 ),
						   ( NULL, "Germany", 2 ),
						   ( NULL, "Spain", 2 ),
						   ( NULL, "Not quite.", 3 ),
						   ( NULL, "Bet365", 4 ),
						   ( NULL, "PSD", 5 ),
						   ( NULL, "Yes", 6 ),
						   ( NULL, "Yes, it is.", 7 ),
						   ( NULL, "IMac", 8 ),
						   ( NULL, "Start driving electrical cars", 9 ),
						   ( NULL, "Yes, they should", 10 );
						 
/*POLL | USER | ANSWER*/
						 
INSERT INTO Votes VALUES ( 1, 2, 1 ),
						 ( 1, 5, 1 ),
						 ( 1, 3, 1 ),
						 ( 1, 2, 2 ),
						 ( 1, 4, 3 ),
						 ( 5, 2, 13 ),
						 ( 6, 1, 14 );

INSERT INTO Faqs VALUES (NULL, "How do I vote?", "Something goes here..."),
						(NULL, "Are the search results the real results?", "Something goes here too..."),
						(NULL, "How can I login?", "Still yet to be done...");