<?
	// From frontpage.html ---------------------------------------
	$roomid 	= $_POST['roomnumber'];
	$username	= $_POST['username'];
	
	// MYSQL CONNECT ---------------------------------------------
	
	$mysql_host 	= ; 
	$mysql_user 	= ;
	$mysql_password = ;
	
	// -----------------------------------------------------------
	$db = mysql_connect($mysql_host, $mysql_user, $mysql_password ) or die("<meta http-equiv=\"Refresh\" content=\"10\">");
    mysql_select_db($mysql_database, $db) or die("<meta http-equiv=\"Refresh\" content=\"10\">");
	// -----------------------------------------------------------
	
	include('mysql_commands.php');
	$userid = SELECTONCE("Table_User","Userid","Username", $username);
	
	// Wrong Username Bad Authentication
	if ($username != $outputusername) {
		header('Location: frontpage.html');
		exit;
	} 
	
	$roomidlist = SELECTLIST("Table_Room","Roomid","Roomid", $roomid);
	
	// Room exists
	if (count($roomidlist) == 1) {
		include('join.php');
		exit;
	} 
	
	$room_key = sha1($username.$rand()."hackathonsalt");
	$temp_val_array = array($room_key, $userid, "", "", "", "open");
	INSERT("Table_Room",array("Roomid","Userid","User2","User3","User4","Status"), $temp_val_array);
	include("index.html");
?>