You'll need to download, install and run the WampServer2 freely downloadable from the web: http://www.wampserver.com/en/

Also Notepad++ (http://notepad-plus-plus.org/) is a good way to view PHP files, and is free for download as well.

The directions to get your seed database up and running:
1) Create the tables for the database using the '4 Tables for SeeedDB.txt' file  (it's a SQL script)
   1.5) I use phpmyadmin and the SQL table and just paste the text from the file above
   1.8) phpmyadmin can be started by clicking the icon for WampServer in the icon tray at the bottom of the screen near the clock.
2) Put all files in a folder you'll create called 'seeddb' in the directory C:\wamp\www which is created when you install WAMPServer
3) Change the 'WelcomeMessage.inc' file to your specific location
3.5) Change email for the webmaster in the Login.php file in two places near the bottom of the file.
4) Find the link to the program on your computer by starting localhost on your browser, and scrolling down to "My Projects" where the seeddb project should be located.
4.5) localhost should be in the same place as phpmyadmin 
5) test out the code by registering and entering seed info

To give yourself and others you select Administrative status:
1) Go into phpmyadmin, and find your record in the ‘userseedreg’ table
2) Click on the edit icon that looks like a pencil located next to that record 
3) Scroll down to the last field (called ‘admin’) and change the value from 0 to 1
4) Click ‘Go’ button
5) Now when you get to the TransType page on the website you should see a link that says “For Admin Eyes Only” if you are logged in as yourself.
6) Use this link to see a list of emails and names of folks who have taken out seeds.
 

